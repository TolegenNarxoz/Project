<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function buy(){
        $ids = Auth::user()->productsWithStatus("in_cart")->allRelatedIds();
        foreach ($ids as $id){
            Auth::user()->productsWithStatus("in_cart")->updateExistingPivot($id, ['status' => 'ordered']);
        }
        return back();
    }

    public function index(){
        $productInCart = Auth::user()->productsWithStatus("in_cart")->get();
        return view('cart.index', ['productsInCart' => $productInCart]);
    }


    public function putToCart(Request $request, Product $product){
        $productInCart = Auth::user()->productsWithStatus("in_cart")->where('product_id', $product->id)->first();

        if ($productInCart != null)
            Auth::user()->productsWithStatus("in_cart")->updateExistingPivot($product->id,
                ['color' => $request->input('color'),
                    'number' => $productInCart->pivot->number+$request->input('number')]);
        else
            Auth::user()->productsWithStatus("in_cart")->attach($product->id,
                ['color' => $request->input('color'),
                    'number' => $request->input('number')]);
    }

    public function deleteFromCart(Product $product){
        $productBought = Auth::user()->productsWithStatus("in_cart")->where('product_id', $product->id)->first();

        if ($productBought != null)
            Auth::user()->productsWithStatus("in_cart")->detach($product->id);
    }
}
