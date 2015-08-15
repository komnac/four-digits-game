<?php

namespace My\App\View;

class CliErrorView extends View
{
    public function show()
    {
        printf('Error: %s', $this->data["errorMessage"]);
    }
}
