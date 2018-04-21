<?php


Route::group([
    'middleware' => ['auth.api', 'roles'],
    'roles' => ['Admin']
], function (){

    Route::resources([
        'teams' => 'TeamsController',
        'events' => 'EventsController'
    ]);
    
    Route::post('teams/join-to-event/{teamid}', 'TeamsController@joinToEvent');
    Route::post('teams/left-event/{teamid}', 'TeamsController@leftEvent');
    Route::post('teams/update-members/{teamid}', 'TeamsController@updateMembers');
    Route::post('events/switch-joinable/{eventid}', 'EventsController@switchJoinableValue');
    Route::post('matches/set-score/{matchid}', 'MatchesController@setScore');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([
    'middleware' => ['auth.api', 'roles'],
    'roles' => ['Admin', 'User']
], function (){

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('teams', 'TeamsController@index');
    Route::get('events', 'EventsController@index');

});



Route::post('login', 'AuthController@login')->name('login');
Route::post('register', 'AuthController@register');
Route::post('recover-password', 'AuthController@recoverPassword');

