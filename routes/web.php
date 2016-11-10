<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->get('/', 'HomeController@getIndex');

Auth::routes();

$router->get('/home', 'HomeController@index')
    ->name('home');


$router->post('add-person', 'AdminController@createPerson')
    ->name('add-person');

$router->post('new-round', 'AdminController@createRound')
    ->name('new-round');