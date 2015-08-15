<?php

namespace My\App;

use My\App\View\Factory as ViewFactory;

/**
 * Main Application
 */
class Application {
    private $config;

    /**
     * @param $configDir a path where configs located.
     */
    public function __construct($configDir)
    {
        $CONFIG = [];
        $configs = glob($configDir . DIRECTORY_SEPARATOR . '*.php');
        foreach ($configs as $config) {
            require_once $config;
        }

        $this->config = $CONFIG;
    }

    /**
     * Check if current application run in Command Line Interface.
     *
     * @return bool TRUE if in CLI mode; FALSE otherwise
     */
    public function isCli()
    {
        return defined('STDIN');
    }

    /**
     * Start application.
     *
     * @return void
     */
    public function run()
    {
        $viewFactory = new ViewFactory();
        $viewFactory->setType($this->isCli() ? 'cli' : 'html');

        try {
            throw new \Exception('Hello world');
        } catch (\Exception $e) {
            $viewFactory
                ->getView('error')
                ->setData(
                    [
                        'errorMessage' => $e->getMessage()
                    ])
                ->show();
        }
    }
}
