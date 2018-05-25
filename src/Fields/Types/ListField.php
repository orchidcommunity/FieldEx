<?php
declare(strict_types=1);
namespace Orchids\FieldEx\Fields\Types;
use Orchid\Platform\Fields\Field;
/**
 * Class ListField.
 * @method $this name($value = true)
 */
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