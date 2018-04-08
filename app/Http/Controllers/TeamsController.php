<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Event;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Team::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $team = Team::create($request->all());

        return response()->json([
            'message' => 'Team created',
            'data' => $team
        ], 200);
    }

    public function joinToEvent($id, Request $request){
        $team = Team::find($id);
        $eventId = $request->get('event_id');
        if($eventId){
            $team->events()->attach($eventId);
            $event = Event::find($eventId);
            return response()->json([
                'message' => 'Sucesfuly joined to '. $event->name,
            ], 200);
        } else {
            return response()->json([
                'message' => 'No event id',
            ], 400);
        }
    }

    public function leftEvent($id, Request $request){
        //return $request->get('event_id');
        $team = Team::find($id);
        $eventId;
        if($team->events()->where('event_id', $request->get('event_id'))->get()){
            $eventId = $request->get('event_id');
        }

        if($eventId){
            $team->events()->detach($eventId);
            return response()->json([
                'message' => 'Succesfully left event',
            ], 200);
        } else {
            return response()->json([
                'message' => 'You are not in this event',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);
        $relatedEvents = $team->events()->get();
        if($team){
            return response()->json([
                'message' => 'Team found',
                'data' => $team,
                'relatedEvents' => $relatedEvents
            ], 200);
        } else {
            return response()->json([
                'message' => 'Team not found'
            ], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        if($team->update($request->all())){
            return response()->json([
                'message' => 'Team updated',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Cant update',
            ], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Team::destroy($id)){
            return response()->json([
                'message' => 'Deleted.',
            ], 200);
        } else{
            return response()->json([
                'message' => 'Cant delete',
            ], 400);
        }
    }
}
