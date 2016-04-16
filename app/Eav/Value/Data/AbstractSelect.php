<?php
namespace App\Eav\Value\Data;

use App\Eav\Attribute\Option as AttributeOption;

use Collective\Html\FormFacade as Form;

abstract class AbstractSelect extends AbstractValue
{
    public static $isSelectable = true;

    protected function getAttributeTableName()
    {
        return eav_value_table('select');
    }

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
}
