<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarContoller;

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

Route::get('/injest', [EventController::class, 'injest']);
Route::get('/injest/{connection_id}', [EventController::class, 'injest'])->whereNumber('connection_id');

Route::get('/api/events', [CalendarContoller::class, 'index']);
Route::get('/api/event/{event}', [EventController::class, 'show'])->whereNumber('event');

Route::get('/api/{template}', [CalendarContoller::class, 'index']);
Route::get('/{template}', [CalendarContoller::class, 'index']);
Route::get('/', [CalendarContoller::class, 'index']);