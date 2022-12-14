<?php

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

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

Route::get('orders',function(){

   /*  $mname = Order::find(3);

    echo $mname->migration; */

    foreach (Order::all() as $order) {
        echo $order->migration.'<br />';
    }
});

/* Route::get('about-us/{}',function (){
    return view('about',[
        'name' => 'Umer'
    ]);
}); */

#Required Parameters
Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
});

#Parameters & Dependency Injection
Route::get('/user/{id}', function (Request $request, $id) {
    return 'User '.$id;
});

// OPtional Parameters
Route::get('/user-new/{name?}/{age?}', function ($name = null,$age = null) {
    return 'Name: '.$name. ' Age: '.$age;
});

Route::get("about-us", [SiteController::class, "index"])->name('about');
Route::get("about-us/{name}", [SiteController::class, "about_us"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(SiteController::class)->group(function(){

    Route::get("user-add",  "user_add");
    Route::post("user-add", "store_user");
    Route::get("user-edit-{id}", "user_edit");
    Route::post("user-edit-{id}", "update_user");
    Route::get("list-users", "list_users");
    Route::get("user-delete-{id}", "user_delete");

});
