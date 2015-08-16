<?php

namespace My\App\View;

class Factory {
    public static function factory($name, $type = 'html')
    {
        $viewName = __NAMESPACE__ . '\\' . ucfirst($type) . ucfirst($name) . 'View';

        return new $viewName();
    }
}
