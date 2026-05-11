<?php

namespace App\View\Components;

use Illuminate\View\Component;

class QueryDetails extends Component
{
    public $queryData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($queryData)
    {
        $this->queryData = $queryData;
    }
      
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.query-details');
    }
}
