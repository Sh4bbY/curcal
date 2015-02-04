<?php

class DB
{
    private static $PDO = NULL;

    private static function initialize()
    {
        try {
            if (self::$PDO === NULL) {
                self::$PDO = new PDO(Config::GET('db_driver') . ':dbname=' . Config::GET('db_database') . ';host=' . Config::GET('db_host') . ';charset=' . Config::GET('db_charset'), Config::GET('db_username'), Config::GET('db_password'));
                self::$PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (Exception $err)
        {
            echo "Error while setting up database Connection";
            exit(1);
        }
    }

    public static function PDO()
    {
        self::initialize();
        return self::$PDO;
    }
}