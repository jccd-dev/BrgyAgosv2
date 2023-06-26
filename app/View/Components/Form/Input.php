<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{

    public string $name;
    public string $label;
    public string $type;
    public ?string $inputClass;
    public null|string $inputId;
    public ?string $placeholder;
    public ?bool $required;
    /**
     * Create a new component instance.
     */
    public function __construct( $name, $label, $type, $inputClass = null, $inputId = null, $placeholder =null, $required=null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->inputClass = $inputClass;
        $this->inputId = $inputId;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
