<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextArea extends Component
{
    public string $fieldName;

    public string $value;

    public string|null $note;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldName, $value = '', $note = null)
    {
        $this->fieldName = $fieldName;
        $this->value = $value;
        $this->note = $note;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.text-area');
    }
}
