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

        // loop all filters
        $category_attributes = $category->attributes_prepared();
        foreach ($filters as $attribute_code => $attribute_filters) {
            // if filter code is valid attribute code
            if (isset($category_attributes[$attribute_code])) {
                // take attribute model
                $attribute = $category_attributes[$attribute_code];
                // and filter query by this attribute

                /**
                 * the thing is whereHas method, besides filtering attribute content ('where content <some condition>'),
                 *   limits product query to only those products which have values of current attribute set
                 *     => products which does NOT have any value of this attribute will be NOT included to results

                 * example query:
                 *   select * from `products` where exists (select * from `eav_values_integer` where `eav_values_integer`.`entity_id` = `products`.`id` and `attribute_id` = 9)
                 * here, all products which does NOT have values of attribute #9 will be ignored

                 * why this is important: if admin creates new attribute, products don't have values for it
                 *   so, UNTIL JS on client side will allow send empty filters like ?size[from]=&size[to]=, server will ignore all products here size is not set
                 *
                 * TODO NEXT:
                 *  - make JS on client side to not send empty filters like ?size[from]=&size[to]=
                 *  - it will allow to remove willApplyFilterQuery hook
                 */
                // temporarily hook for problem with filters like ?size[from]=&size[to]=
                if ($attribute->willApplyFilterQuery($attribute_filters)) {
                    $productQuery->whereHas($attribute_code, function ($query) use ($attribute, $attribute_filters)  {
                        // attribute incapsulates filtering logic (it depends on attribute value models)
                        $attribute->filterQuery($query, $attribute_filters);
                    });
                }
            }
        }

        // echo $productQuery->toSql();
        // echo "<br>";
        // print_r($productQuery->getBindings());
        // echo "<hr>";

        return $productQuery;
    }
}
