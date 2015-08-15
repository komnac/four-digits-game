<?php

namespace My\App;

use My\App\Database\Connection as DBConnection;
use My\App\View\Factory as ViewFactory;

/**
 * Main Application
 */
class Application {
    private $config;

    /**
     * @param $configPath a path where config file located.
     */
    public function __construct($configPath)
    {
        if (!file_exists($configPath)) {
            throw new \Exception('Не удается найти файл конфигурации');
        }

        require_once $configPath;

        $this->config = new Config();
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
            $this->setupPhp();
            $this->setupDatabaseConnection();

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

    /**
     * Setup valid database connection
     */
    protected function setupDatabaseConnection()
    {
        $db = DBConnection::getInstance($this->config);

        $db->query(
            sprintf('SET NAMES "%s"', $this->config->dbEncoding)
        );

        $db->query(
            sprintf('SET time_zone = "%s"', $this->config->dbTimezone)
        );
    }

    protected function setupPhp()
    {
        $timezone = property_exists($this->config, 'timezone') ? $this->config->timezone : 'UTC';
        $debug = property_exists($this->config, 'debug') ? $this->config->debug : false;

        ini_set('date.timezone', $timezone);

        if ($debug) {
            error_reporting(E_ALL);
        } else {
            error_reporting(E_ERROR | E_PARSE);
        }
    }
}
