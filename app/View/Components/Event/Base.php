<?php

namespace App\View\Components\Event;

use Illuminate\View\Component;

class Base extends Component
{

    public $event;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    public function render()
    {

        $view = str((new \ReflectionClass($this))->getShortName())->lower();
        
        return view("components.event.{$view}");

    }
    
}
