<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::ordered()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', ['categories' => Category::lists('name', 'id')]);
    }

    public function store(Requests\ProductRequest $request)
    {
        Product::create($request->all());

        return redirect(route('admin.products.index'))->with([
            'message' => 'Product has been created successfully!'
        ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // eager load product attributes
        $product->with('eav');

        return view('admin.products.edit', compact('product'));
    }


    public function update(Requests\ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect(route('admin.products.index'))->with([
            'message' => 'Product has been updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect(route('admin.products.index'))->with([
            'message' => 'Product has been deleted successfully!',
        ]);
    }
}
