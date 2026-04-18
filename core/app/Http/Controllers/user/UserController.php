<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;

class UserController extends Controller
{
    // Show Cart Page
    public function cart()
    {
        $settings = Setting::first();
        $delivery = $settings?->delivery_charge ?? 0;
        $discount = $settings?->discount_percentage ?? 0;
        $taxPercent = $settings?->tax_percentage ?? 0;
        $currency = $settings?->currency ?? '৳';
        $subtotal = 0;
        return view('frontend.user.cart', compact('subtotal', 'discount', 'delivery', 'currency','taxPercent'));
    }

    // Manage cart item quantity or delete
    public function manage($type, $id)
    {
        $cart = Cart::findOrFail($id);

        if($type === 'plus') {
            $product = Product::findOrFail($cart->product_id);
            if($cart->quantity < $product->stock){
                $cart->increment('quantity');
            } else {
                return redirect()->back()->with('error', 'Stock limit reached!');
            }
        } elseif($type === 'minus') {
            if($cart->quantity > 1){
                $cart->decrement('quantity');
            } else {
                $cart->delete();
            }
        } elseif($type === 'destroy') {
            $cart->delete();
        } else {
            abort(404);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    // Add product to cart
    public function addcart($product_id)
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', 'Please login to add to cart!');
        }

        $user_id = Auth::id();

        // Check if already in cart
        $cart = Cart::where('user_id', $user_id)
                    ->where('product_id', $product_id)
                    ->first();

        if($cart){
            return redirect()->back()->with('error', 'Item already in cart!');
        }

        // Check stock
        $product = Product::findOrFail($product_id);
        if($product->stock <= 0){
            return redirect()->back()->with('error', 'Item is out of stock!');
        }

        // Create cart entry
        Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => 1,
        ]);

        // Redirect to product page
        return redirect()->route('item.show', $product_id)
                         ->with('success', 'Added to cart successfully!');
    }

    // Billing page
    public function billing()
    {
        $settings   = Setting::first();
        $delivery   = $settings?->delivery_charge ?? 0;
        $taxPercent = $settings?->tax_percentage ?? 0;
        $currency   = $settings?->currency ?? '৳';
        $subtotal   = 0;
        $user       = auth()->user();
        $carts      = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('frontend.user.billing', compact('delivery', 'taxPercent', 'currency', 'subtotal', 'user', 'carts'));
    }

    // Show user orders
    public function orders()
    {
        $settings = Setting::first();
        $order = Order::where('user_id', Auth::id())->first();
        $currency = $settings?->currency ?? '৳';
        $delivery = $order?->delivery_charge ?? 0;
        $orders = Order::where('user_id', Auth::id())
                       ->with('orderDetails')
                       ->latest()
                       ->get();

        return view('frontend.user.orders', compact('orders', 'currency', 'delivery'));
    }

    // Contact us form
    public function contactus(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email',
            'message'=> 'required|string',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Message sent successfully!');
    }
}