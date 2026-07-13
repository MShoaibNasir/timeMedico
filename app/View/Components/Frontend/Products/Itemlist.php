<?php

namespace App\View\Components\Frontend\Products;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Itemlist extends Component
{
    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('components.frontend.products.itemlist');
    }
}
