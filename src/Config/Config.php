<?php
namespace App\Config;

class Config {
    private static Config $instance;
    private array|false $settings = [];

    private function __construct()
    {
        $this->settings = parse_ini_file(__DIR__ . '/config.ini');
    }

    public static function getInstance(): Config
    {
        if (!isset(self::$instance)) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    public function get($key) {
        return $this->settings[$key] ?? null;
    }
}
