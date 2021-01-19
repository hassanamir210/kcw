<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/has1', function () {
    $users = App\User::all();
    foreach($users as $user){
        $user['tttttttttdepositAmount'] = $user->totalDepositedAmount();
    }
    
    return $users;
    // return App\Models\PaymentRequest::groupBy('user_id')->paginate(10);
});
Route::get('/has2', function () {
    $users = App\User::all();
    foreach($users as $user){
        $user['ttttttttttwithdrawAmount'] = $user->totalWithdraw();
        
    }
    
    return $users;
    // return App\Models\PaymentRequest::groupBy('user_id')->paginate(10);
});