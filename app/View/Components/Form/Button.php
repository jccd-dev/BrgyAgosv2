<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $type,
        public string $divClass,
        public string $btnClass
    )
    {
        $this->title = $title;
        $this->type = $type;
        $this->divClass = $divClass;
        $this->btnClass = $btnClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.button');
    }
}
