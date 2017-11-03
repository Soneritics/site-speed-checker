<?php
namespace Models;

use Database\DatabaseConnectionFactory;
use Database\Table;

class Measurement extends Table
{
    private static $installed = false;

    public function __construct()
    {
        parent::__construct();

        if (self::$installed === false) {
            $this->install();
        }
    }

    private function install()
    {
        self::$installed = true;
        DatabaseConnectionFactory::get()->query('
            CREATE TABLE `measurements` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `site` VARCHAR(255) NOT NULL,
                `seconds` DECIMAL(7,4) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ');
    }
}
