<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use \App\Repositories\MatchesService;

class MatchesController extends Controller
{

    protected $matchesService;

    public function __construct(MatchesService $matchesService){
        $this->matchesService = $matchesService;
    } 
    public function setScore($id, Request $request){
        $match = Match::find($id);
        $match->team1_score = $request->get('team1_score');
        $match->team2_score = $request->get('team2_score');
        $match->save();
        $this->matchesService->setWinner($match, $match->team1_score, $match->team2_score);

        return response()->json([
            'message' => 'Scores set.',
            'data' => $match
        ], 200);
    }
}
