<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function create_select_category()
    {
        return view('admin.products.create.select_category', ['categories' => Category::lists('name', 'id')]);
    }

    public function create(Request $request)
    {
        return view('admin.products.create', ['category' => Category::findOrFail($request['category_id'])]);
    }

    protected function setEavAttributes($product, $request)
    {
        $category_attributes = Category::findOrFail($request['category_id'])->attributes_prepared();
        foreach ($request->all() as $attribute_code => $value) {
            if (isset($category_attributes[$attribute_code])) {
                $product->{$attribute_code} = $value;
            }
        }
    }

    public function store(Requests\Admin\ProductRequest $request)
    {
        $product = new Product($request->all());

        $this->setEavAttributes($product, $request);

        $product->save();

        return redirect(route('admin.products.index'))->with([
            'message' => 'Product has been created successfully!'
        ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // eager load product attributes
        $product->with('eav');

        return view('admin.products.edit', ['product' => $product, 'category' => $product->category]);
    }


    public function update(Requests\Admin\ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->all());

        $this->setEavAttributes($product, $request);

        $product->save();

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
