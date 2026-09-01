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
    public function index()
    {
        $carts = Cart::with('donut.category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        foreach ($carts as $cart) {
            if (!$cart->donut->is_active) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', "Donat {$cart->donut->name} sudah tidak tersedia.");
            }

            if ($cart->quantity > $cart->donut->stock) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', "Stok {$cart->donut->name} tidak mencukupi.");
            }
        }

        $subtotal = $carts->sum('subtotal');

        return view('checkout', compact('carts', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $carts = Cart::with('donut')
            ->where('user_id', Auth::id())
            ->lockForUpdate()
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $order = DB::transaction(function () use ($carts, $request) {
            $total = 0;

            foreach ($carts as $cart) {
                $donut = $cart->donut;

                if (!$donut->is_active) {
                    throw new \RuntimeException("Donat {$donut->name} sudah tidak tersedia.");
                }

                if ($cart->quantity > $donut->stock) {
                    throw new \RuntimeException("Stok {$donut->name} tidak mencukupi.");
                }

                $price = $donut->price;
                $subtotal = $price * $cart->quantity;

                $total += $subtotal;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_code' => 'ND-' . strtoupper(Str::random(10)),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($carts as $cart) {
                $price = $cart->donut->price;
                $subtotal = $price * $cart->quantity;

                $order->items()->create([
                    'donut_id' => $cart->donut_id,
                    'quantity' => $cart->quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $cart->delete();
            }

            return $order;
        });

        return redirect()
            ->route('order.show', $order)
            ->with('success', 'Pesanan berhasil dibuat.');
    }
}
