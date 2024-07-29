<?php

require_once 'application/config/config.php';

// Load core classes
foreach (glob(__DIR__ . './system/core/*.php') as $core) {
    require_once $core;
}

// Load libs
foreach (glob(__DIR__ . './system/libraries/*.php') as $libraries) {
    require_once $libraries;
}
