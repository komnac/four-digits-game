<?php

namespace My\App\Database;

/**
 * Singleton realization for database connection.
 */
class Connection
{
    private static $instance = null;
    private static $conf = null;

    private function __clone() {}
    private function __wakeup() {}
    private function __construct() {}

    /**
     * Return an instance of Database connection by specified configuration.
     *   If connection established, and $conf not specified return previous connection.
     *   Default object properties for connection:
     *      dbHost = 'localhost,
     *      dbUser = 'root',
     *      dbPass = '',
     *      dbName = 'fdg'
     *
     * @return MysqliExtended
     *
     * @throws Exception    When can't connect
     */
    public static function getInstance($config = null)
    {
        self::setConf($config);

        if ((self::$instance === null) || (!self::$instance->ping())) {
            self::$instance = self::createDbo();
        }

        return self::$instance;
    }

    /**
     *
     * @return MysqliExtended
     *
     * @throws Exception        When can not connect
     */
    private static function createDbo()
    {
        $db = new MysqliExtended(
            self::$conf->dbHost,
            self::$conf->dbUser,
            self::$conf->dbPass,
            self::$conf->dbName
        );

        if ($db->connect_error) {
            throw new Exception(
                sprintf(
                    Exception::NO_DB_CONNECTION,
                    self::$conf->dbName,
                    $db->connect_error
                )
            );
        }

        return $db;
    }

    /**
     * Setup configuration.
     *
     * @param null $config
     */
    private static function setConf($config = null)
    {
        if (!$config && !is_null(self::$conf)) {
            return ;
        }

        if (!is_object($config)) {
            $config = new \stdClass();
        }
        $conf = new \stdClass();

        $conf->dbHost = property_exists($config, 'dbHost') ? $config->dbHost : 'localhost';
        $conf->dbUser = property_exists($config, 'dbUser') ? $config->dbUser : 'root';
        $conf->dbPass = property_exists($config, 'dbPass') ? $config->dbPass : '';
        $conf->dbName = property_exists($config, 'dbName') ? $config->dbName : 'fdg';

        if ($conf != self::$conf) {
            self::$conf = $conf;
        }
    }
}
