<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Events extends Component
{
    public $component;
    public $events;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($component, $events)
    {
        $this->component    = $component;
        $this->events       = $events;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.events');
    }
}
