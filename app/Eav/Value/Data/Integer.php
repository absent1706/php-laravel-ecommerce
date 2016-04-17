<?php

namespace App\Eav\Value\Data;

use Collective\Html\FormFacade as Form;

class Integer extends AbstractValue
{
    protected static function prepareFilters($filters)
    {
        $from = isset($filters['from']) ? $filters['from'] : null;
        $to = isset($filters['to']) ? $filters['to'] : null;

        return [$from, $to];
    }

    public static function getFilterHtml($attribute, $filters = [])
    {
        list($from, $to) = self::prepareFilters($filters);

        $result = "
        <div class='form-group'>
            From
            <input type='number' class='form-control'
                   name='{$attribute->code}[from]'
                   value='$from'>

            To
            <input type='number' class='form-control'
                   name='{$attribute->code}[to]'
                   value='$to'>
        </div>
        ";
        return $result;
    }

    public static function willApplyFilterQuery($filters)
    {
        list($from, $to) = self::prepareFilters($filters);
        return (!empty($from) && !empty($to));
    }

    public static function filterQuery($query, $filters)
    {
        list($from, $to) = self::prepareFilters($filters);
        if ($from) {
            $query->where('content', '>=', $from);
        }
        if ($to) {
            $query->where('content', '<=', $to);
        }

        return $query;
    }

    public static function getInputHtml($attribute, $content)
    {
        // TODO: display multiple input fields (with KnockoutJS) for collection attributes
        return Form::number($attribute->code, $content, ['class' => 'form-control']);
    }
}
