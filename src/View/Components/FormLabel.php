<?php

namespace Jiny\Css\View\Components;

use Illuminate\View\Component;

class FormLabel extends Component
{

    public function __construct()
    {
    }

    public function render()
    {
        return view('jiny-css::components.forms.label');
    }
}
