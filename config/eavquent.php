<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table Prefixes
    |--------------------------------------------------------------------------
    */
    'prefix'    => [
        'package_tables' => 'eav_',
        'value_tables'   => 'values_',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key
    |--------------------------------------------------------------------------
    */
    'cache_key' => 'eav',

    'avaliable_eav_models' => [
        'Integer'     => 'App\Eav\Value\Data\Integer',
        'Dropdown'    => 'App\Eav\Value\Data\Select',
        'Multiselect' => 'App\Eav\Value\Data\Multiselect',
    ],
];
