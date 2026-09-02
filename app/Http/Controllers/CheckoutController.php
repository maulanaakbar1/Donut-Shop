<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cartIds = $request->input('cart_ids', []);

        if (!is_array($cartIds) || empty($cartIds)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Pilih minimal satu item untuk checkout.');
        }

        $carts = Cart::with('donut.category')
            ->where('user_id', Auth::id())
            ->whereIn('id', $cartIds)
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Item yang dipilih tidak ditemukan.');
        }

        if ($carts->count() !== count(array_unique($cartIds))) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Sebagian item yang dipilih tidak valid.');
        }

        foreach ($carts as $cart) {
            if (!$cart->donut || !$cart->donut->is_active) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Ada donat yang sudah tidak tersedia.');
            }

            if ($cart->quantity > $cart->donut->stock) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Jumlah salah satu donat melebihi stok yang tersedia.');
            }
        }

        $subtotal = $carts->sum(function ($cart) {
            return $cart->subtotal;
        });

        return view('checkout', compact('carts', 'subtotal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cart_ids' => ['required', 'array', 'min:1'],
            'cart_ids.*' => ['required', 'integer', 'exists:carts,id'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $cartIds = array_unique($validated['cart_ids']);

        $carts = Cart::with('donut')
            ->where('user_id', Auth::id())
            ->whereIn('id', $cartIds)
            ->get();

        if ($carts->count() !== count($cartIds)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Ada item checkout yang tidak valid.');
        }

        foreach ($carts as $cart) {
            if (!$cart->donut || !$cart->donut->is_active) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Ada donat yang sudah tidak tersedia.');
            }

            if ($cart->quantity > $cart->donut->stock) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', "Stok {$cart->donut->name} tidak mencukupi.");
            }
        }

        $totalAmount = $carts->sum(function ($cart) {
            return $cart->subtotal;
        });

        $order = DB::transaction(function () use ($carts, $totalAmount, $validated) {

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_code' => 'ND-' . strtoupper(Str::random(10)),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($carts as $cart) {
                $order->items()->create([
                    'donut_id' => $cart->donut_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price,
                    'subtotal' => $cart->subtotal,
                ]);
            }

            Cart::where('user_id', Auth::id())
                ->whereIn('id', $carts->pluck('id'))
                ->delete();

            return $order;
        });

        return redirect()
            ->route('order.show', $order)
            ->with('success', 'Pesanan berhasil dibuat.');
    }
}