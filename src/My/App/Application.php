<?php

namespace My\App;

use My\App\Database\Connection as DBConnection;
use My\App\View\Factory as ViewFactory;
use My\App\Controller\FourdigitsController;
use My\App\Input\FourdigitsInput;

/**
 * Main Application
 */
class Application {
    private $config;

    /**
     * @param $configPath path to config file
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
    public static function isCli()
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
        try {
            $this->setupPhp();
            $this->setupDatabaseConnection();
            $this->getController()->exec();
        } catch (\Exception $e) {
            ViewFactory::factory(
                    'error',
                    self::isCli() ? 'cli' : 'html'
                )
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

    /**
     * Return contoller.
     *
     * @return My\App\Controller\Controller
     *
     * @todo add dynamic logic by (like mapping path to controller via config)
     */
    protected function getController()
    {
        $requestData = $this->getRequestData();

        return new FourdigitsController($requestData);
    }

    /**
     * Return setuped StrongAccessor input data.
     *  Now only 1 FourdigitsInput supported.
     *
     * @return My\App\Model\FourdigitsInput
     *
     * @todo add dynamic logic (for example via config route file)
     */
    protected function getRequestData()
    {
        if (self::isCli()) {
            $phone   = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : null;
            $message = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : '';
        } else {
            $phone   = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : null;
            $message = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
        }

        if (is_null($phone)) {
            throw new \RuntimeException("Не задан телефонный номер!");
        }

        $input = new FourdigitsInput();
        $input->phone = $phone;
        $input->message = $message;

        return $input;
    }
}
