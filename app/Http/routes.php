<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('test', function(){
    $this->app->make('App\Libs\Cookie')->get();}
        );
//Route::get('products/add', 'BaseController@addProducts');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'adminka/orders' => 'Adminka\OrdersController',
    'adminka' => 'Adminka\MainController',
    'cart' => 'CartController',
    '/{id?}' => 'BaseController' //дефолтный роут который будет перехватывать все, что не указано в других роутах
]);
// если auth/login/ то в контроллере должен быть экшн getLogin или postLogin