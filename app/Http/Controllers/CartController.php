<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->Цена;
        });
        return view('cart', compact('cartItems', 'total'));
    }
    

    public function add(Request $request, Products $product)
    {
        $cart = Cart::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            ['quantity' => 0] 
        );
    
        $cart->increment('quantity');
    
        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }
    
    

    public function remove(Cart $cart)
    {
        $cart->decrement('quantity');
        if ($cart->quantity == 0) {
        $cart->delete();
        }
        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины');
    }
}
