<?php

    use Illuminate\Support\Facades\Route;

    Route::get('rename' , 'FilemanagerToolController@rename')->name('rename');
    Route::get('data' , 'FilemanagerToolController@getData')->name('getData');
    Route::get('getFilemanager' , 'FilemanagerToolController@getFilemanager')->name('getFilemanager');
    Route::get('actions/create-folder' ,'FilemanagerToolController@createFolder')->name('createFolder');
//    Route::post('actions/delete-folder' , 'FilemanagerToolController@deleteFolder');
    Route::get('actions/get-info' , 'FilemanagerToolController@getInfo')->name('getInfo');
    Route::get('actions/remove-file' , 'FilemanagerToolController@removeFile')->name('removeFile');

//    Route::post('uploads/add' , 'FilemanagerToolController@upload');
    Route::post('uploads/update' , 'FilemanagerToolController@upload')->name('updateFile');


    Route::get('/' , 'FilemanagerToolController@index')->name('index');


