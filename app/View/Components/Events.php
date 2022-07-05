<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Events extends Component
{
    public $args;
    public $component;
    public $events;
    public $grouped;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($args, $events, $grouped, $component)
    {
        $this->args         = $args;
        $this->events       = $events;
        $this->grouped      = $grouped;
        $this->component    = $component;
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
