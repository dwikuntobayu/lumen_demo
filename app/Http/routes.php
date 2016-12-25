<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', ['uses' => 'ArticlesController@index']);
resource('articles', 'ArticlesController');

##function for handle resource routes
function resource($uri, $controller, $only = [])
{
  global $app;
  $crud_routes = [
    'index' => ['GET', ''],
    'create' => ['GET', '/create'],
    'store' => ['POST', ''],
    'show' => ['GET', '/{id}'],
    'edit' => ['GET', '/{id}/edit'],
    'update' => ['PUT', '/{id}'],
    'update_' => ['PATCH', '/{id}'],
    'destroy' => ['DELETE', '/{id}']
  ];

  foreach($crud_routes as $action => $params) {
    $action = trim($action, '_');
    if (!in_array($action, $only)) {
      list($method, $path) = $params;
      $app->$method($action . $path, [
        'as' => $uri . '.' . $action, 'uses' => $controller . '@' . $action
      ]);
    }
  }
}