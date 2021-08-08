<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class CatSideBar extends Component
{
    public $categories;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Category $categories)
    {
        //
        $this->categories = $categories->getAll();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.site.cat-side-bar');
    }
}
