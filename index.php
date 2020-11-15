<?php
ini_set('display_errors',1);
session_start();
require_once __DIR__.'/vendor/autoload.php';

Flight::set('flight.views.path', 'app/Views');

Flight::route('/', ['App\Controllers\UserController', 'registration']);

Flight::route('/async_reg/', ['App\Controllers\UserController', 'asyncReg']);

Flight::route('/activation/', ['App\Controllers\UserController', 'activation']);

Flight::route('/user_listing/', ['App\Controllers\UserController', 'listing']);

Flight::route('/key_gen/', ['App\Controllers\ApiKeyController', 'generate']);

Flight::route('/api/users/', ['App\Controllers\APIController', 'userlist']);

Flight::route('/api/test/', ['App\Controllers\APIController', 'test']);

Flight::route('/captcha/', ['App\Controllers\CaptchaController', 'index']);

Flight::start();