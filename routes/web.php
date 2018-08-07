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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/members', 'MembersController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/clientes', 'CustomerController@getClientes');
Route::post('/cadastrar/cliente', 'CustomerController@insert');
Route::post('/cadastrar/excluir', 'CustomerController@delete');
Route::post('/cadastrar/editar', 'CustomerController@edit');
