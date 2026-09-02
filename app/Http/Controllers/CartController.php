<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Donut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('donut.category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $subtotal = $carts->sum(function ($cart) {
            return $cart->subtotal;
        });

        return view('cart', compact('carts', 'subtotal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donut_id' => ['required', 'exists:donuts,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $donut = Donut::where('id', $validated['donut_id'])
            ->where('is_active', true)
            ->firstOrFail();

        $cart = Cart::where('user_id', Auth::id())
            ->where('donut_id', $donut->id)
            ->first();

        $newQuantity = ($cart?->quantity ?? 0) + $validated['quantity'];

        if ($newQuantity > $donut->stock) {
            return back()->with('error', 'Jumlah pesanan melebihi stok yang tersedia.');
        }

        if ($cart) {
            $cart->update([
                'quantity' => $newQuantity,
                'price' => $donut->price,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'donut_id' => $donut->id,
                'quantity' => $validated['quantity'],
                'price' => $donut->price,
            ]);
        }

        return back()->with('success', 'Donat berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Cart $cart)
    {
        abort_unless($cart->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($validated['quantity'] > $cart->donut->stock) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jumlah melebihi stok yang tersedia.',
                ], 422);
            }

            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart->update([
            'quantity' => $validated['quantity'],
            'price' => $cart->donut->price,
        ]);

        $cart->refresh();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jumlah pesanan berhasil diperbarui.',
                'quantity' => $cart->quantity,
                'price' => $cart->price,
                'subtotal' => $cart->subtotal,
            ]);
        }

        return back()->with('success', 'Jumlah pesanan berhasil diperbarui.');

    }


    public function destroy(Cart $cart)
    {
        abort_unless($cart->user_id === Auth::id(), 403);

        $cart->delete();

        return back()->with('success', 'Donat berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function destroySelected(Request $request)
    {
        $validated = $request->validate([
        'cart_ids' => ['required', 'array', 'min:1'],
        'cart_ids.*' => ['required', 'integer'],
        ]);

        $deleted = Cart::where('user_id', Auth::id())
            ->whereIn('id', $validated['cart_ids'])
            ->delete();

        if ($deleted === 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Tidak ada item yang berhasil dihapus.');
        }

        return redirect()
            ->route('cart.index')
            ->with('success', "{$deleted} item berhasil dihapus dari keranjang.");

    }

}