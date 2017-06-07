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

use \App\Models\Category;

//REST API

Route::group(['prefix' => 'api/v1'], function() {
    Route::group(['prefix' => 'products'], function(){
        Route::get('bestProduct', ['uses' => 'RestProductController@bestProduct']);
        Route::get('bestSellers', ['uses' => 'RestProductController@getBestSellers']);
        Route::get('featured', ['uses' => 'RestProductController@getFeatured']);
        Route::get('bestOffers', ['uses' => 'RestProductController@getBestOffers']);
        Route::get('image/{name}', ['uses' => 'RestProductController@getImage']);
        Route::get('icon/{name}', ['uses' => 'RestProductController@getIcon']);
    });
    Route::group(['prefix' => 'users'], function(){
        Route::post('signUp', ['uses' => 'RestUserController@signUp']);
        Route::post('login', ['uses' => 'RestUserController@login']);
        Route::post('checkout', ['uses' => 'RestUserController@checkout']);
    });
    Route::resource('users', 'RestUserController', [
        'only' => ['update']
    ]);
    Route::resource('products', 'RestProductController', [
        'only' => ['index']
    ]);
    Route::get('categories', ['uses' => 'RestCategoryController@index']);
});

//////////////////////////////////////////////////////

Route::name('admin_root_path')->get('/admin',
    [
        'middleware' => 'admin',
        function (){
            return view('admin');
        }
    ]
);
Route::group(['prefix' => 'admin/'], function(){
    Route::resource('categories', 'CategoryController', [
        'except' => ['show']
    ]);

    Route::resource('products', 'ProductController', [
        'except' => ['show']
    ]);
});

Route::name('login')->get('admin/login', function(){
    return view('login');
});

Route::post('admin/login', [
    'uses' => 'LoginController@login'
]);

Route::name('logout')->get('admin/logout', [
    'uses' => 'LoginController@logout'
]);

Route::name('root_path')->get('/', function () {
    return view('index');
});