<?php

namespace App\View\Components;

use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class TopNavBar extends Component
{
    public $menuList;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Category $cat)
    {
        //
        $this->menuList = $cat->getTopNavBar(8);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.site.top-nav-bar');
    }
}
