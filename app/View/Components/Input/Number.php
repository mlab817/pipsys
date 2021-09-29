<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Number extends Component
{
    public string $fieldName;

    public float|int $value;

    public string $xRef;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, $value)
    {
        $this->fieldName    = $fieldName;
        $this->value        = !in_array(gettype($value),['float','int']) ? 0 : $value;
        $this->xRef         = slugify($fieldName);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.number');
    }
}
