<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class RadioGroup extends Component
{
    public string $fieldName;

    public Collection $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, Collection $options)
    {
        $this->fieldName    = $fieldName;
        $this->options      = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.radio-group');
    }
}
