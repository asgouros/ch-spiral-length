<?php
/**
 * App "bootstrapping":
 *  - locates autoload files
 *  - creates the DI container
 *  - instantiates and returns the app
 */

use DI\ContainerBuilder;
use Silly\Application;

//
// Locate autoload files
//
require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/config.php';

//
// Create DI container to be used by the App
//
$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions($config['phpDi']);
$container = $containerBuilder->build();

//
// Instantiate the App
//
define('APP_VERSION', 'v0.1.0');
$app = new Application('Challenge Spiral Length', APP_VERSION);

// Silly will use PHP-DI for dependency injection based on type-hints
$app->useContainer($container, $injectWithTypeHint = true);

return $app;