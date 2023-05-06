<?php

namespace Hnassr\NovaKeyValue;

use Laravel\Nova\Fields\Field;

class KeyValue extends Field
{
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
