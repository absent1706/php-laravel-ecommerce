<?php
namespace App\Eav\Value\Data;

use Devio\Eavquent\Value\Value;

use App\Eav\Attribute\Option as AttributeOption;

class Option extends Value
{
    public function setContent($content)
    {
        return $this->setAttribute('content', $content);
    }

    /**
     * Get the content.
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->belongsTo(AttributeOption::class, 'content')->first();
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
