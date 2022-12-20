<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function basketAll(Request $request, Product $product){
        $request->validate([
            'color' => 'required',
            'number' => 'required|min:1|max:100|numeric'

        ]);
//        dd($product);
        Auth::user()->basketProduct()->attach($product->id,['color' => $request->input('color'),'number' => $request->input('number')]);
        return back()->with('message', (__('message.Added to basket')));
    }

    public function unbasketAll(Product $product){
        $basketProduct = Auth::user()->basketProduct()->where('product_id', $product->id)->get();
        if ($basketProduct != null) {
            Auth::user()->basketProduct()->detach($product->id);
        }
        return back()->withErrors((__('message.Removed from basket')));
    }

    public function basket(){
        $productAll = Basket::where('status','in_cart')->with('user','product')->get();

        return view('products.basket',['products' => $productAll]);
    }

    public function editbasket(Basket $basket){
        $basket->update([
            'status'=> 'ordered',
        ]);

        return back();
    }


    public function postsByCategory(Category $category){
        return view('products.index', ['products' => $category->products, 'categories' => Category::all()]);

    }

    public function index(Request $request){
        $allProducts = null;
        if ($request->search){
            $allProducts = Product::where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('price', 'LIKE', '%'.$request->search.'%')
                ->with('category')->get();;
        }
        else{
            $allProducts = Product::all();
        }

        $categories = Category::all();
        return view('products.index', ['products' => $allProducts, 'categories' => $categories]);
    }


    public function create(){
        $this->authorize('create', Product::class);
        return view('products.create', ['categories' => Category::all()]);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required|max:500',
            'content_en' => 'required|max:500',
            'content_ru' => 'required|max:500',
            'content_kz' => 'required|max:500',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $fileName = time().$request->file('img')->getClientOriginalName();
        $image_path = $request->file('img')->storeAs('products', $fileName, 'public');
        $validated['img'] = '/storage/'.$image_path;

        Auth::user()->products()->create($validated);
        return redirect()->route('products.index')->with('message', 'Product added');
    }


    public function show(Product $product){
        return view('products.show', ['product' => $product]);
    }


    public function edit(Product $product){
        $this->authorize('edit',$product);
        return view('products.edit', ['product' => $product, 'categories' => Category::all()]);
    }


    public function update(Request $request, Product $product){

        $UpValidated = $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
            'content_en' => 'required|max:500',
            'content_ru' => 'required|max:500',
            'content_kz' => 'required|max:500',
            'price' => 'required|numeric',
            'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
        ]);

        $product->update($UpValidated);
        return redirect()->route('products.index')->with('upmessage', 'Product update');
    }


    public function destroy(Product $product){
        $this->authorize('delete',$product);
        $product->delete();
        return redirect()->route('products.index')->with('destroy', 'Destroy');
    }

    public function search(Request $request){
        $products = null;
        if($request->search){
            $products = Product::where('name', 'LIKE', '%'.$request->search.'%');
        }
        return view('products.index',['products' => $products]);
    }

}
