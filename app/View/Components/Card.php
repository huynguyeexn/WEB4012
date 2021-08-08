<?php

namespace App\View\Components;

use Illuminate\View\Component;

use Illuminate\Support\Carbon;

class Card extends Component
{
    public $props;
    public $type;
    public $hasDesc;
    public $hasImage;
    public $imageSize;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($props, $type = null, $hasDesc = false, $hasImage = false, $imageSize = "600x400")
    {
        //
        $this->props = $props;
        $this->type = $type;
        $this->hasDesc = $hasDesc;
        $this->hasImage = $hasImage;
        $this->imageSize = $imageSize;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.site.card');
    }
}
