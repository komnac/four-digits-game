<?php

namespace My\App\Controller;

use My\App\Helpers\StrongAccessor as StrongRequestData;

abstract class Controller {
    public function __construct(StrongRequestData $requestData)
    {
        $this->request = $requestData;
    }

    abstract function exec();
}
