<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Devio\Eavquent\Attribute\Attribute;
use App\Category;

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
        return view('admin.attributes.create', compact('avaliable_models'));
    }

    public function store(Requests\Admin\AttributeRequest $request)
    {
        $attribute = new Attribute($request->all());
        $attribute->save();

        return redirect(route('admin.attributes.index'))->with([
            'message' => 'Attribute has been created successfully!'
        ]);
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        $avaliable_models = Attribute::getAvaliableEavModels();
        return view('admin.attributes.edit', compact('attribute','avaliable_models'));
    }


    public function update(Requests\Admin\AttributeRequest $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->fill($request->only('label', 'code', 'collection', 'optionable'));
        $attribute->save();

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
