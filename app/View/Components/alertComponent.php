<?php

namespace App\View\Components;

use Illuminate\View\Component;

class alertComponent extends Component
{
    /**
     * @var
     */
    public $type;
    /**
     * @var
     */
    public $message;

    /**
     * alertComponent constructor.
     * @param $type
     * @param $message
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
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
        return view('components.alert-component');
    }
}
