<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $filters = $request->all();

        $products = $this->_getCategoryProductsQuery($category, $filters)->get();
        /* TODO: sort products after filtering */

        return view('categories.show', compact('category', 'products', 'filters'));
    }

    protected function _getCategoryProductsQuery($category, $filters) {
        $productQuery = $category->products();

        // some preparation: form array [<code> => <entity>]) of all category-related attributes
        $category_attributes = [];
        foreach ($category->attributes as $attribute) {
            $category_attributes[$attribute->code] = $attribute;
        }

        // loop all filters
        foreach ($filters as $attribute_code => $filters) {
            // if filter code is valid attribute code
            if (isset($category_attributes[$attribute_code])) {
                // take attribute model
                $attribute = $category_attributes[$attribute_code];
                // and filter query by this attribute
                $productQuery->whereHas($attribute_code, function ($query) use ($attribute, $filters)  {
                    // attribute incapsulates filtering logic (it depends on attribute value models)
                    $attribute->filterQuery($query, $filters);
                });
            }
        }

        // echo $productQuery->toSql();
        // echo "<br>";
        // print_r($productQuery->getBindings());
        // echo "<hr>";

        return $productQuery;
    }
}
