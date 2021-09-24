<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Subhead extends Component
{
    public $id;

    public string $subhead;

    public string $description;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($subhead, $description = '', $id = '')
    {
        $this->subhead      = $subhead;
        $this->description  = $description;
        $this->id           = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.subhead');
    }
}
