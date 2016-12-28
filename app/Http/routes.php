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
$app->post('/auth/login', ['uses' => 'AuthController@loginPost']);

// resource('articles', 'ArticlesController');
$app->get('articles/', ['as'=>'articles.index', 'uses' => 'ArticlesController@index']);
$app->post('articles/', ['as'=>'articles.store', 'uses'=> 'ArticlesController@store']);
$app->get('articles/{id}', ['as'=>'articles.show', 'uses' => 'ArticlesController@show']);
$app->put('articles/{id}', ['as'=>'articles.update', 'uses' => 'ArticlesController@update']);
$app->patch('articles/{id}', ['as'=>'articles.update', 'uses' => 'ArticlesController@update']);
$app->delete('articles/{id}', ['as'=>'articles.delete', 'uses' => 'ArticlesController@destroy']);

##below function will not compatible with tdd
##function for handle resource routes
// function resource($uri, $controller, $only = [])
// {
  // global $app;

  // $crud_routes = [
    // 'index' => ['GET', ''],
    // 'store' => ['POST', ''],
    // 'show' => ['GET', '/{id}'],
    // 'update' => ['PUT', '/{id}'],
    // 'update_' => ['PATCH', '/{id}'],
    // 'destroy' => ['DELETE', '/{id}']
  // ];
// 
  // foreach($crud_routes as $action => $params) {
    // $action = trim($action, '_');
    // if (!in_array($action, $only)) {
      // list($method, $path) = $params;
      // $app->$method($uri.$path, [
        // 'as' => $uri . '.' . $action, 'uses' => $controller . '@' . $action
      // ]);
    // }
  // }
// }