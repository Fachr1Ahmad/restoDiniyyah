<?php
namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index(Request $request) {
        $user = $request->user()->id;
        $cart = Cart::where('user_id', $user)->get();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user
            ]);
        }
        // dd($cart);
        return $cart;
    }

    public function store(Request $request) {
        dd($request);
    }
}
