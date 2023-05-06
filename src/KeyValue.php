<?php

namespace Hnassr\NovaKeyValue;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\SupportsDependentFields;

class KeyValue extends Field
{

    use SupportsDependentFields;
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-key-value';

    public function withSelectableKeys($selectableKeys)
    {
        $this->withMeta(['selectableKeys' => $selectableKeys]);
        return $this;
    }

    public function withSelectableValues($selectableValues)
    {
        $this->withMeta(['selectableValues' => $selectableValues]);
        return $this;
    }
}
