<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'TicketsController@test')->name('test');

// Search with autosuggestion
Route::post('/users/getUsers/','UsersController@getUsers')->name('search-users');
Route::post('ticket/attachment', 'TicketsController@fileUpload')->name('tickets.upload');

// Ticket Manual Routes
Route::get('status-next/{ticket}', 'TicketsController@nextStatus')->name('status-next');
Route::get('status-previous/{ticket}', 'TicketsController@prevStatus')->name('status-previous');
Route::get('my-tickets', 'TicketsController@indexOnlySelectedTickets')->name('my-tickets');

// Tickets Resource
Route::resource('ticket', 'TicketsController')->names([
    'create' => 'create-ticket',
    'edit' => 'edit-ticket',
    'index' => 'tickets',
]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
