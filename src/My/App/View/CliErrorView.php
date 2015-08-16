<?php

namespace My\App\View;

class CliErrorView extends View
{
    private function usage()
    {
        printf(
            "Usage:\n\t%s tel msg\n",
            $_SERVER['argv'][0]
        );
    }

    public function show()
    {
        $this->usage();
        printf("Error: %s\n" . PHP_EOL, $this->data["errorMessage"]);
    }
}
