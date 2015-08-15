<?php

namespace My\App\View;

class Factory {
    private $type = 'html';

    public function setType($type = 'html')
    {
        $this->type = (strtolower($type) === 'cli') ? 'cli' : 'html';

        return $this;
    }

    public function getType()
    {
        return strtoupper($this->type);
    }

    public function getView($name)
    {
        $viewName = __NAMESPACE__ . '\\' . ucfirst($this->type) . ucfirst($name) . 'View';

        return new $viewName();
    }
}
