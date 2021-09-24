<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckboxTrigger extends Component
{
    public string $fieldName;

    public string|int| bool $value;

    public string $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, $value, $label)
    {
        $this->fieldName    = $fieldName;
        $this->value        = $value;
        $this->label        = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox-trigger');
    }
}
