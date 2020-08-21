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

// Search with autosuggestion
Route::post('/users/getUsers/','UsersController@getUsers')->name('search-users');
Route::post('ticket/attachment', 'TicketsController@fileUpload')->name('tickets.upload');

// Ticket Manual Routes
Route::get('tickets/{project}', 'TicketsController@index')->name('tickets');
Route::get('status-next/{ticket}', 'TicketsController@nextStatus')->name('status-next');
Route::get('status-previous/{ticket}', 'TicketsController@prevStatus')->name('status-previous');
Route::get('my-tickets/{project}', 'TicketsController@indexOnlySelectedTickets')->name('my-tickets');
Route::get('users-tickets', 'TicketsController@indexAllUsersTickets')->name('users-tickets');

// Todo Manual Routes
Route::post('store-item/{list}', 'TodoItemsController@store')->name('todo-item.store');
Route::post('complete-item/{item}', 'TodoItemsController@completed')->name('todo-item.completed');
Route::delete('delete-item/{item}', 'TodoItemsController@destroy')->name('todo-item.delete');

Route::post('{ticket}/store-todo', 'TodosController@store')->name('todo.store');
Route::delete('delete-todo/{list}', 'TodosController@destroy')->name('todo.delete');
Route::post('complete-todo/{list}', 'TodosController@completed')->name('todo.completed');

// Reports manual route
Route::get('report-tickets', 'ReportsController@index')->name('report-tickets');
Route::get('get-tickets', 'ReportsController@getData')->name('report-getData');

// Tickets Resource
Route::resource('ticket', 'TicketsController')->names([
    'create' => 'create-ticket',
    'edit' => 'edit-ticket',
    // 'index' => 'tickets',
])->except('index');

// Project Resource
Route::resource('project', 'ProjectBoardController');

// Users resource
Route::resource('user', 'UsersController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
