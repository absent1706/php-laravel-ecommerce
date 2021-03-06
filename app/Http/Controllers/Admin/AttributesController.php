<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Devio\Eavquent\Attribute\Attribute;
use App\Eav\Attribute\Option as AttributeOption;
use App\Category;
use App\Product;

use Config;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::all();
        $avaliable_models = Attribute::getAvaliableEavModels();
        return view('admin.attributes.index', compact('attributes', 'avaliable_models'));
    }

    public function create(Request $request)
    {
        $avaliable_models = Attribute::getAvaliableEavModels();
        $all_categories = Category::lists('name', 'id');

        return view('admin.attributes.create', compact('avaliable_models', 'all_categories'));
    }

    public function store(Requests\Admin\AttributeCreateRequest $request)
    {
        $attribute = new Attribute($request->all());
        $attribute->entity = Product::class;
        $class = $attribute->model;
        if ($class::$isCollectionable) {
            $attribute->collection = true;
        }
        $attribute->save();
        $attribute->categories()->sync($request->get('category_ids',[]));

        // TODO: add possibility to add options just when creating attribute

        /* !!! After creating/deleting attributes something can brake because EAV module keeps all EAV attributes in cache
         *     TODO: if it will brake often, refresh this cache after creation (Devio\Eavquent\Attribute\Manager->refresh())
         *     for now, if you have problems, type 'php artisan cache:clear' or restart server
         */
        return redirect(route('admin.attributes.index'))->with([
            'message' => 'Attribute has been created successfully!'
        ]);
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        $avaliable_models = Attribute::getAvaliableEavModels();
        $all_categories = Category::lists('name', 'id');

        return view('admin.attributes.edit', compact('attribute','avaliable_models', 'all_categories'));
    }


    public function update(Requests\Admin\AttributeUpdateRequest $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->fill($request->except('model'));
        // TODO: add ability to edit attributes order in category (on CategoryController)
        $attribute->categories()->sync($request->get('category_ids',[]));

        $attribute->save();
        if ($attribute->isSelectable()) {
            // update existing options
            $existingOptions = $request->get('options',[]);
            foreach ($existingOptions as $id => $label) {
                $attribute->options()->where('id', $id)->update(['label' => $label]);
            }

            // delete removed options
            /* TODO NEXT: add foreign keys to eav_values_select so attribute values will be deleted from products after options deleting */
            $attribute->options()->whereNotIn('id', array_keys($existingOptions))->delete();

            // add new options
            foreach ($request->get('new_options',[]) as $label) {
                $attribute->options()->save(new AttributeOption(['label' => $label]));
            }
        }


        return redirect(route('admin.attributes.index'))->with([
            'message' => 'Attribute has been updated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        return redirect(route('admin.attributes.index'))->with([
            'message' => 'Attribute has been deleted successfully!',
        ]);
    }
}
