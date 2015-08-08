<?php

namespace GintonicCMS\Test\App\Config;

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Routing\Router;

//Router::scope('/', ['plugin' => 'GintonicCMS'], function ($routes) {
//
//});

Router::plugin('Payments', function ($routes) {

    $routes->prefix('admin', function ($routes) {
        $routes->fallbacks('InflectedRoute');
    });

    $routes->extensions(['json']);
    $routes->fallbacks('InflectedRoute');

});
