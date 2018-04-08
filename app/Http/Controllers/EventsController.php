<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create($request->all());

        return response()->json([
            'message' => 'Event created',
            'data' => $event
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $relatedTeams = $event->teams()->get();

        if($event){
            return response()->json([
                'message' => 'Event found',
                'data' => $event,
                'teams' => $relatedTeams
            ], 200);
        } else {
            return response()->json([
                'message' => 'Event not found',
            ], 400);
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
    public function update(Request $request, Event $event)
    {
        if($team->update($request->all())){
            return response()->json([
                'message' => 'Event updated',
                'data' => $event
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
        if(Event::destroy($id)){
            return response()->json([
                'message' => 'Event deleted',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Cant delete event',
            ], 200);
        }
    }
}
