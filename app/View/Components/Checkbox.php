<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public string $fieldName;

    public mixed $value;

    public string $type;

    public string $label;

    public string $description;

    public bool $checked;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $fieldName,
        $label,
        $value,
        $checked = null,
        $description = '',
        $type = 'checkbox',
    )
    {
        $this->fieldName = $fieldName;
        $this->label = $label;
        $this->value = $value;
        $this->checked = !is_null($checked) && gettype($checked) == 'array' ? in_array($value, $checked) : $value == $checked;
        $this->description = $description;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
