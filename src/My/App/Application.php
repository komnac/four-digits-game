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
     * @param $configPath path where config file located
     *
     * @throws \Exception when configuration file path not specified
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
     * Setup valid database connection.
     */
    protected function setupDatabaseConnection()
    {
        $db = DBConnection::getInstance($this->config);

        $enc = property_exists($this->config, 'dbEncoding') ? $this->config->dbEncoding : 'utf8';
        $tz  = property_exists($this->config,  'dbTimezone') ? $this->config->dbTimezone : '00:00';

        $db->query(
            sprintf('SET NAMES "%s"', $enc)
        );

        $db->query(
            sprintf('SET time_zone = "%s"', $tz)
        );
    }

    /**
     * Setup php inner values.
     */
    protected function setupPhp()
    {
        $debug    = property_exists($this->config, 'debug') ? $this->config->debug : false;
        $timezone = property_exists($this->config, 'timezone') ? $this->config->timezone : 'UTC';

        if ($debug) {
            error_reporting(E_ALL);
        } else {
            error_reporting(E_ERROR | E_PARSE);
        }

        ini_set('date.timezone', $timezone);
    }
}
