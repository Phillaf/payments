<?php
use Cake\Routing\Router;

Router::plugin('Payments', function ($routes) {
    $routes->fallbacks('DashedRoute');
});