<?php

namespace App\View\Components\Event\Part;

use Illuminate\View\Component;

class Wrap extends Component
{

    public $url;
    public $tag;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $tag = "div")
    {
        $this->url      = $url;
        $this->tag      = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.event.part.wrap');
    }
}
