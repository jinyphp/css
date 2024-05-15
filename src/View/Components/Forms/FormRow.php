<?php

namespace Jiny\Css\View\Components\Forms;

use Illuminate\View\Component;

class FormRow extends Component
{

    public function __construct()
    {
    }

    public function render()
    {
        return view('jiny-css::components.forms.row');
    }
}
