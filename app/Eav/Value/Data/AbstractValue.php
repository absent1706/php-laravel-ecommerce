<?php
namespace App\Eav\Value\Data;

use Devio\Eavquent\Value\Value;

abstract class AbstractValue extends Value
{
    public static $isSelectable = false;

    public function getDisplayContent()
    {
        return $this->getContent();
    }

    public static function getFilterHtml($attribute, $filters = [])
    {
        return Form::text($attribute->code, $filters, ['class' => 'form-control']);
    }

    public static function filterQuery($query, $filter)
    {
        $query->where('content', $filter);
        return $query;
    }

    public static function getInputHtml($attribute, $content)
    {
        return Form::text($attribute->code, $content, ['class' => 'form-control']);
    }
}
