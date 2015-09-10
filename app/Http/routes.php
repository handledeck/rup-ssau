<?php

//Route::get('/', 'IntakeController@GetRupIntake');



Route::get('/', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('rup', 'IntakeController@GetRupIntake');
Route::get('orsha', 'IntakeController@GetOrshaIntake');
Route::get('vitebsk', 'IntakeController@GetVitebskIntake');
Route::get('glubokoe', 'IntakeController@GetGlubokoeIntake');
Route::get('polotsk', 'IntakeController@GetPolotskIntake');
Route::get('intake/{obj}/{date}',['uses'=>'IntakeController@intake']);
Route::get('region',['uses'=>'RegionController@region']);
Route::get('regstat',['uses'=>'RegionController@GetStationData']);
Route::get('station-lines',['uses'=>'RegionController@GetStationLines']);
Route::get('statdata',['uses'=>'RegionController@GetArchive']);
Route::post('settings',['uses'=>'RegionController@Settings']);
Route::get('gas-novopolotsk',['uses'=>'GasController@GetNovopolotsk']);
Route::get('equip',['uses'=>'EquipmentController@index']);
Route::get('test',['uses'=>'RegionController@test']);




