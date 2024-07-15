<?php

namespace App\Config;

class Config {
    private static ?Config $instance = null;
    private array|false $settings = [];

    private function __construct()
    {
        $this->settings = parse_ini_file('config.ini');
    }

    public static function getInstance(): ?Config
    {
        if (self::$instance == null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function get($key)
    {
        return $this->settings[$key] ?? null;
    }
}
