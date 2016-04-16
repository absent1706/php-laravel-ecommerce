<?php

namespace App\Eav\Value\Data;

use Collective\Html\FormFacade as Form;

class Multiselect extends AbstractSelect
{
    public static function getInputHtml($attribute, $content)
    {
        $input_options = ['class' => 'form-control', 'multiple' => true];
        $values = $attribute->options()->lists('label', 'id')->all();
        $input_name = $attribute->code.'[]';
        $selected = ($content instanceof \Illuminate\Support\Collection) ? $content->all() : $content;

        return Form::select($input_name, $values, $selected, $input_options);
    }
}
