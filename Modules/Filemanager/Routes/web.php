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

Route::prefix('filemanager')->group(function() {
    Route::get('/', 'FilemanagerController@index')->name('filemanager.index');
    Route::get('/field', 'FilemanagerController@field')->name('filemanager.field');
    Route::post('/upload', 'FilemanagerController@upload')->name('filemanager.upload');
});


/*---------------------------------- files ----------------------------------*/
Route::prefix('admin/files')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'FilesController@index')->name('filemanager.files.index');
        Route::get('/create', 'FilesController@create')->name('filemanager.files.create');
        Route::post('/', 'FilesController@store')->name('filemanager.files.store');
        Route::get('/{id}/edit', 'FilesController@edit')->name('filemanager.files.edit');
        Route::post('/{id}', 'FilesController@update')->name('filemanager.files.update');
        Route::delete('/{id}', 'FilesController@destroy')->name('filemanager.files.destroy');
    });
});

/*---------------------------------- folders ----------------------------------*/
Route::prefix('admin/folders')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'FolderController@index')->name('filemanager.folder.index');
        Route::get('/create', 'FolderController@create')->name('filemanager.folder.create');
        Route::post('/', 'FolderController@store')->name('filemanager.folder.store');
        Route::get('/{id}/edit', 'FolderController@edit')->name('filemanager.folder.edit');
        Route::post('/{id}', 'FolderController@update')->name('filemanager.folder.update');
        Route::delete('/{id}', 'FolderController@destroy')->name('filemanager.folder.destroy');
    });
});
