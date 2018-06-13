<?php

declare(strict_types=1);

namespace Orchids\FieldEx\Fields\Types;

use Orchid\Screen\Fields\Field;

/**
 * Class RelationshipField.
 *
 * @method $this accesskey($value = true)
 * @method $this autofocus($value = true)
 * @method $this disabled($value = true)
 * @method $this form($value = true)
 * @method $this multiple($value = true)
 * @method $this name($value = true)
 * @method $this required($value = true)
 * @method $this size($value = true)
 * @method $this tabindex($value = true)
 * @method $this help($value = true)
 */
class RelationshipField2 extends Field
{
    /**
     * @var string
     */
    public $view = 'orchids/fieldex::fields.relationship2';

    /**
     * Required Attributes.
     *
     * @var array
     */
    public $required = [
        'name',
        'handler',
    ];

    /**
     * Default attributes value.
     *
     * @var array
     */
    public $attributes = [
        'class' => 'form-control',
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    public $inlineAttributes = [
        'accesskey',
        'autofocus',
        'disabled',
        'form',
        'multiple',
        'name',
        'required',
        'size',
        'tabindex',
        'value',
    ];
    
    
    	 /**
     * @param $name
     *
     * @return string
     */
    public function modifyName($name)
    {
        $prefix = $this->get('prefix');
        $lang = $this->get('lang');
        $name .='[]';

        $this->attributes['name'] = $name;

        if (!is_null($prefix)) {
            $this->attributes['name'] = $prefix.$name;
        }

        if (is_null($prefix) && !is_null($lang)) {
            $this->attributes['name'] = $lang.$name;
        }

        if (!is_null($prefix) && !is_null($lang)) {
            $this->attributes['name'] = $prefix . '[' . $lang . ']' . $name;
        }

        if ($name instanceof \Closure) {
            $this->attributes['name'] =  $name($this->attributes);
        }
		
        return $this;
    }
	
	 /**
     * @param $value
     *
     * @return mixed
     */
     
    public function modifyValue($value)
    {
        //dd($value);
        $old = $this->getOldValue();
		
        $this->attributes['value'] = $value;
		
        if (is_array($value)) {
            $this->attributes['value'] = implode(",", $value);
        }
		
        if (! is_null($old)) {
            $this->attributes['value'] = $old;
        }

        if ($value instanceof \Closure) {
            $this->attributes['value'] =  $value($this->attributes);
        }

        return $this;
    }
	
}
