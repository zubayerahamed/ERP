<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentHeading extends Component
{

    public $pageHeading;
    public $showBredCrumb;

    /**
     * Create a new component instance.
     */
    public function __construct($pageHeading, $showBredCrumb)
    {
        $this->pageHeading = $pageHeading;
        $this->showBredCrumb = $showBredCrumb;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-heading');
    }
}
