<?php
declare(strict_types=1);

/**
 * Class ListField.
 * @method $this name($value = true)
 */

namespace Orchids\FieldEx\Fields\Types;

use Orchid\Screen\Fields\Field;

class ListField extends Field
{
    /**
     * @var string
     */
    public $view = 'orchids/fieldex::fields.list';
    /**
     * Required Attributes.
     *
     * @var array
     */
    public $required = [
        'name',
    ];
    public $inlineAttributes = [
        'name',
        'value',
    ];
}