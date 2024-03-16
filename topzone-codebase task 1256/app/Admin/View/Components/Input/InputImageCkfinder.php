<?php

namespace App\Admin\View\Components\Input;
use App\Admin\Traits\GetConfig;

class InputImageCkfinder extends Input
{
    use GetConfig;

    public $value;

    public $showImage;

    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($showImage, $name, $type = 'text', $value = '', $required = false)
    {
        //
        parent::__construct($type, $required);
        $this->showImage = $showImage;
        $this->name = $name;
        $this->value = $value ?? $this->traitGetConfigImageDefault();
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.image');
    }
}
