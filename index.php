<?php

define('APP_PATH', __DIR__ . '/');

require (APP_PATH . 'XCPhp/XCPhp.php');

$config = require (APP_PATH . 'config/config.php');

(new \XCPhp\XCPhp($config))->run();
