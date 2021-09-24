<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormGroup extends Component
{
    public string $fieldName;

    public string $label;

    public bool $error;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, $label, $error = false)
    {
        $this->fieldName = $fieldName;
        $this->label = $label;
        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-group');
    }
}
