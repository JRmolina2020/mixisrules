<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('login', 'AuthController@login');
//auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'UserController@countuser');
    Route::get('usuarios', function () {
        return view('users.index');
    });
    Route::get('perfil', function () {
        return view('users.profile');
    });

    Route::get('roles', function () {
        return view('roles.index');
    });
    Route::get('permisos', function () {
        return view('permissions.index');
    });
    Route::get('categorias', function () {
        return view('categories.index');
    });
    Route::get('productos', function () {
        return view('products.index');
    });
    Route::get('clientes', function () {
        return view('clients.index');
    });

    Route::prefix('api')->group(function () {
        Route::resource('users', 'UserController')->except([
            'show', 'create', 'edit'
        ]);
        Route::put('users/available/{id}', 'UserController@available')->where('id', '[0-9]+');
        Route::put('users/locked/{id}', 'UserController@locked')->where('id', '[0-9]+');
        Route::put('users/password/{id}', 'UserController@updatepassword')->where('id', '[0-9]+');;
        Route::post('logout', 'AuthController@logout')->name('logout');
        //roles
        Route::resource('roles', 'RoleController')->except([
            'show', 'create', 'edit'
        ]);
        //permissions
        Route::resource('permissions', 'PermissionController')->except([
            'show', 'create', 'edit'
        ]);
        //categories
        Route::resource('categories', 'CategorieController')->except([
            'show', 'create', 'edit',
        ]);
        Route::put('categories/available/{id}', 'CategorieController@available')->where('id', '[0-9]+');;
        Route::put('categories/locked/{id}', 'CategorieController@locked')->where('id', '[0-9]+');;
        //products
        Route::resource('products', 'ProductController')->except([
            'show', 'create', 'edit'
        ]);
        Route::put('products/available/{id}', 'ProductController@available')->where('id', '[0-9]+');;
        Route::put('products/locked/{id}', 'ProductController@locked')->where('id', '[0-9]+');;
        //person client
        Route::post('persons', 'PersonController@store');
        Route::get('persons',  'PersonController@index');
        Route::put('persons/{id}', 'PersonController@update')->where('id', '[0-9]+');

        //departaments and cities
        Route::get('departaments/', 'DepartamentController@index');
        Route::get('cities/{id}', 'CityController@index')->where('id', '[0-9]+');;
    });
});