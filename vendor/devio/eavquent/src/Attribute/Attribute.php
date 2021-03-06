<?php

namespace Devio\Eavquent\Attribute;

use Devio\Eavquent\Events\AttributeWasSaved;
use Illuminate\Database\Eloquent\Model;

use App\Eav\Attribute\Option as AttributeOption;

use Config;

class Attribute extends Model
{
    /**
     * Model timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'label', 'model', 'entity', 'default_value', 'collection',
    ];

    /**
     * Attribute constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(eav_table('attributes'));

        parent::__construct($attributes);
    }

    /**
     * Registering events.
     */
    public static function boot()
    {
        parent::boot();

        static::saved(AttributeWasSaved::class . '@handle');
    }

    /**
     * Get the attribute code name.
     *
     * @return mixed
     */
    public function getCode()
    {
        return $this->getAttribute('code');
    }

    /**
     * Get the model class name.
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->getAttribute('model');
    }

    /**
     * Return the model class.
     *
     * @return mixed
     */
    public function getModelInstance()
    {
        $class = $this->getAttribute('model');

        return new $class;
    }

    /**
     * Check if attribute is multivalued.
     *
     * @return bool
     */
    public function isCollection()
    {
        return (bool) $this->getAttribute('collection');
    }

    /* TODO: remove this code from vendor dir */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_attribute');
    }

    public function category_ids()
    {
        return $this->categories->lists('id')->all();
    }

    // !!! options method should NOT be called for attributes with model != '...\Option' !!!
    public function isSelectable()
    {
        $class = $this->getAttribute('model');
        return $class::$isSelectable;
    }

    public function options()
    {
        if (!$this->isSelectable()) {
            throw new Exception('Cannot get options of {$this->code} because this attribute is not selectable');
        }
        return $this->hasMany(AttributeOption::class);
    }

    public function getFilterHtml($filters)
    {
        $class = $this->getAttribute('model');
        return $class::getFilterHtml($this, $filters);
    }

    public function willApplyFilterQuery($filters)
    {
        $class = $this->getAttribute('model');
        return $class::willApplyFilterQuery($filters);
    }

    public function filterQuery($query, $filters)
    {
        $class = $this->getAttribute('model');
        return $class::filterQuery($query, $filters);
    }

    public function getInputHtml($content = null)
    {
        $class = $this->getAttribute('model');
        return $class::getInputHtml($this, $content);
    }

    public static function getAvaliableEavModels()
    {
        return Config::get('eavquent.avaliable_eav_models');
    }
}
