<?php
namespace App\Helper;

class Logger {
    public static function log($message) {
        $logfile = __DIR__ . '/../../logs/app.log';
        file_put_contents($logfile, date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL, FILE_APPEND);
    }
}