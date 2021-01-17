<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StateCompnenet extends Component
{
    public $name;
    public $active;
    public $disabled;
    public $total;

    /**
     * StateCompnenet constructor.
     * @param $name
     * @param $active
     * @param $disabled
     * @param $total
     */
    public function __construct($name, $active, $disabled, $total)
    {
        $this->name = $name;
        $this->active = $active;
        $this->disabled = $disabled;
        $this->total = $total;
    }
    /**
     * Create a new component instance.
     *
     * @return void
     */


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.state-compnenet');
    }
}
