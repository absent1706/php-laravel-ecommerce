<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Devio\Eavquent\Attribute\Attribute;

class AttributeRequest extends Request
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

        /* TODO: validate EAV attributes */
        return [
            // 'category_id'   => 'required|exists:categories,id',
            'code'  => 'required|alpha_dash',
            'label' => 'required',
            'model' => 'required|in:'.join(',',Attribute::getAvaliableEavModels())
        ];
    }
}
