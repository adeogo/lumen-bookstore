<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function() use($router){
    
    $router->group(['prefix' => 'book-categories'], function() use($router){
        $router->get('/', 'BookCategoriesController@index');
        $router->get('{id}', 'BookCategoriesController@show');
        $router->post('/', 'BookCategoriesController@store');
        $router->put('{id}', 'BookCategoriesController@update');
        $router->delete('{id}', 'BookCategoriesController@delete');
    
    });
    
    $router->group(['prefix' => 'book-tags'], function() use($router){
        $router->get('/', 'BookTagsController@index');
        $router->get('{id}', 'BookTagsController@show');
        $router->post('/', 'BookTagsController@store');
        $router->put('{id}', 'BookTagsController@update');
        $router->delete('{id}', 'BookTagsController@delete');
    
    });
    
    $router->group(['prefix' => 'books'], function() use($router){
        $router->get('/', 'BooksController@index');
        $router->get('{id}', 'BooksController@show');
        $router->post('/', 'BooksController@store');
        $router->put('{id}', 'BooksController@update');
        $router->delete('{id}', 'BooksController@delete');
    
    });

});

