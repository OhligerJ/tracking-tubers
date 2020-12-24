<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChannelController;

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
Route::get('/all_channel_info/{url}', [ChannelController::class, 'allChannelInfo']);
Route::get('/post_channel_url/{url}', [ChannelController::class, 'postNewChannel']);

Route::get('/home', [ChannelController::class, 'index']);
// Route::get('/home', function () {
//     return 'hello';
// });

