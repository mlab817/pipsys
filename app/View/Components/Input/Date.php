<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Date extends Component
{
    public string $fieldName;

    public mixed $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, $value = '')
    {
        $this->fieldName    = $fieldName;
        $this->value        = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.date');
    }
}
