<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends Component
{
    public string $fieldName;

    public Collection $options;

    public mixed $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, Collection $options, $selected = null)
    {
        $this->fieldName    = $fieldName;
        $this->options      = $options;
        $this->selected     = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
