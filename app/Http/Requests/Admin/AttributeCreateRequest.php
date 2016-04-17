<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Devio\Eavquent\Attribute\Attribute;

class AttributeCreateRequest extends AttributeUpdateRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            'model' => 'required|in:'.join(',',Attribute::getAvaliableEavModels())
        ]);
    }
}
