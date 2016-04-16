<?php
namespace App\Eav\Value\Data;

use Collective\Html\FormFacade as Form;

class Select extends AbstractSelect
{
    public static function getInputHtml($attribute, $content)
    {
        $input_options = ['class' => 'form-control'];
        $values = $attribute->options()->lists('label', 'id')->all();
        $input_name = $attribute->code;
        $selected = $content;

        return Form::select($input_name, $values, $selected, $input_options);
    }
}
