<?php

namespace My\App\Controller;

use My\App\Helpers\StrongAccessor as StrongRequestData;

abstract class Controller {
    private $request;

    public function __construct(StrongRequestData $requestData)
    {
        $this->request = $requestData;
    }

    public function getRequest()
    {
        return $this->request;
    }

    abstract function exec();
}
