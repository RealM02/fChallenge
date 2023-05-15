<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();

// Order routes
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/create', [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{id}/edit', [App\Http\Controllers\OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');

// User routes
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/orders', 'OrdersController@index')->name('orders.index');

Route::get('/orders/create', 'OrdersController@create')->name('orders.create');

Route::post('/orders', 'OrdersController@store')->name('orders.store');

Route::get('/orders/{id}', 'OrdersController@show')->name('orders.show');

Route::get('/orders/{id}/edit', 'OrdersController@edit')->name('orders.edit');

Route::put('/orders/{id}', 'OrdersController@update')->name('orders.update');

Route::delete('/orders/{id}', 'OrdersController@destroy')->name('orders.destroy');

Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');

Route::get('orders/deleted', [OrdersController::class, 'deleted'])->name('orders.deleted');

Route::patch('orders/{order}/restore', [OrdersController::class, 'restore'])->name('orders.restore');


//Routes for orders

Route::get('/orders/create', 'OrdersController@create')->name('orders.create');
Route::post('/orders', 'OrdersController@store')->name('orders.store');
Route::get('/orders/{order}/edit', 'OrdersController@edit')->name('orders.edit');
Route::put('/orders/{order}', 'OrdersController@update')->name('orders.update');
Route::delete('/orders/{order}', 'OrdersController@destroy')->name('orders.destroy');

//Routes for users

Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::post('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
Route::put('/users/{user}', 'UsersController@update')->name('users.update');
Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

//Protect routes

Route::group(['middleware' => ['auth']], function () {
    Route::get('/orders', 'OrdersController@index')->name('orders.index');
    Route::get('/orders/create', 'OrdersController@create')->name('orders.create');
    Route::post('/orders', 'OrdersController@store')->name('orders.store');
    Route::get('/orders/{order}/edit', 'OrdersController@edit')->name('orders.edit');
    Route::put('/orders/{order}', 'OrdersController@update')->name('orders.update');
    Route::delete('/orders/{order}', 'OrdersController@destroy')->name('orders.destroy');

//Routes for OrderEvidence
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::prefix('customer')->group(function () {
        Route::get('/', 'OrderController@index')->name('order.index');
        Route::post('/', 'OrderController@show')->name('order.show');
    });
    
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        Route::resource('orders', 'Admin\OrderController');
        Route::get('orders/{order}/restore', 'Admin\OrderController@restore')->name('orders.restore');
        Route::get('users', 'Admin\UserController@index')->name('users.index');
        Route::post('users', 'Admin\UserController@store')->name('users.store');
        Route::delete('users/{user}', 'Admin\UserController@destroy')->name('users.destroy');
    });

    
        // Order routes
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/orders/{order}/photo', [OrderController::class, 'showPhoto'])->name('orders.photo.show');
        Route::post('/orders/{order}/photo', [OrderController::class, 'storePhoto'])->name('orders.photo.store');
    
        // User routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
        // Admin routes
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');


        Route::group(['middleware' => ['auth']], function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
            Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
            Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
            Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
            Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
            Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
            Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
        });
        
        Route::group(['middleware' => ['auth', 'role:sales|purchasing|warehouse|route']], function () {
            Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
            Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
            Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
            Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        });
        
        Route::group(['middleware' => ['auth', 'role:sales|purchasing|warehouse']], function () {
            Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
            Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        });
        
        Route::group(['middleware' => ['auth', 'role:warehouse']], function () {
            Route::put('/orders/{order}/process', [OrderController::class, 'process'])->name('orders.process');
        });
        
        Route::group(['middleware' => ['auth', 'role:route']], function () {
            Route::put('/orders/{order}/route', [OrderController::class, 'route'])->name('orders.route');
            Route::put('/orders/{order}/delivered', [OrderController::class, 'delivered'])->name('orders.delivered');
        });
        
    });
    
