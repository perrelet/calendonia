<?php

namespace App\View\Components\Events\Part\Filter;

use Illuminate\View\Component;
use Spatie\Tags\Tag;

class Tags extends Component
{

    public $tags;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tags = null)
    {
        
        if (is_null($tags)) $tags = Tag::all()->pluck("name");

        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.events.part.filter.tags');
    }
}
