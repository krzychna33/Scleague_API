<?php

Route::resources([
    'teams' => 'TeamsController',
    'events' => 'EventsController'
]);

Route::post('teams/join-to-event/{teamid}', 'TeamsController@joinToEvent');
Route::post('teams/left-event/{teamid}', 'TeamsController@leftEvent');

Route::post('teams/add-members/{teamid}', 'TeamsController@updateMembers');