<?php
namespace App\Eav\Value\Data;

use Devio\Eavquent\Value\Value;

use App\Eav\Attribute\Option as AttributeOption;

use Collective\Html\FormFacade as Form;

class Option extends Value
{
    public function getDisplayContent()
    {
        // TODO: add this standard behaviour to abstract Value class
        return $this->belongsTo(AttributeOption::class, 'content')->first()->label;
    }

    public static function getFilterHtml($attribute, $filters = [])
    {
        $result = '<div class="form-group">';

        foreach ($attribute->options as $option) {
            $checked = (in_array((string)$option->id, $filters)) ? 'checked' : '';
            $result .= "
                <div class='checkbox'>
                    <label>
                        <input type='checkbox' name='{$attribute->code}[]' value='{$option->id}' $checked />
                        $option->label
                    </label>
                </div>";
        }
        $result .= '</div>';

        return $result;
    }

    public static function filterQuery($query, $filters)
    {
        $query->whereIn('content', $filters);
        return $query;
    }

    public static function getInputHtml($attribute, $content)
    {
        $input_options = ['class' => 'form-control'];
        $values = $attribute->options()->lists('label', 'id')->all();
        $selected = $content;
        $input_name = $attribute->code;

        if ($attribute->isCollection()) {
            $input_options['multiple'] = true;
            $input_name .= '[]';
            if ($content instanceof \Illuminate\Support\Collection) {
                $selected = $content->all();
            }
        }
        return Form::select($input_name, $values, $selected, $input_options);
    }
}
