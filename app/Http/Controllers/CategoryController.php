<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
        $categories = Category::all();
        return view('adm.category', ['categories' => $categories]);
    }


    public function create(){
        $this->authorize('create', Category::class);
        return view('adm.create');
    }

    public function store(Request $request){
        Category::create([
            'name' => $request->input('name'),
            'name_en' => $request->input('name_en'),
            'name_ru' => $request->input('name_ru'),
            'name_kz' => $request->input('name_kz'),
            'code' => $request->input('code'),
        ]);

        return redirect()->route('adm.users.index')->with('crmessage', 'Category create');
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        //
    }


    public function update(Request $request, Category $category)
    {
        //
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }
}
