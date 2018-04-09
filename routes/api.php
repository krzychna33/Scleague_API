<?php

Route::resources([
    'teams' => 'TeamsController',
    'events' => 'EventsController'
]);

Route::post('teams/join-to-event/{teamid}', 'TeamsController@joinToEvent');
Route::post('teams/left-event/{teamid}', 'TeamsController@leftEvent');
Route::post('teams/update-members/{teamid}', 'TeamsController@updateMembers');


Route::post('events/switch-joinable/{eventid}', 'EventsController@switchJoinableValue');