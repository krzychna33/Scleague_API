<?php


namespace App\Repositories;
use App\Match;
use App\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MatchesService{

    public function generateMatches(Event $event){
        $relatedTeams = $event->teams()->get();
        $relatedTeams = $relatedTeams->shuffle();
        $n = 0;
        $prevMatchDate = null;
        for($i=1; $i<=$event->slots/2; $i++){
            $match = new Match;
            $match->inner_id = $i;
            $match->match_index = $event->event_index;
            $match_date = null;
            if($i==1){
                $match_date = $this->generateMatchDate(Carbon::createFromFormat("Y-m-d H:i:s", $event->start_at));
                $prevMatchDate = $match_date;
            } else {
                $match_date = $this->generateMatchDate($prevMatchDate);
                $prevMatchDate = $match_date;
            }
            $match->match_date = $match_date;
            $match->team1_id = $relatedTeams[$n]->id;
            $n++;
            $match->team2_id = $relatedTeams[$n]->id;
            $n++;
            $match->event_id = $event->id;
            $match->save();
        }
    }

    public function generateMatchDate($baseDate){
        return $baseDate->addMinutes(120);  
    }

    public function setWinner(Match $match, $team1Score, $team2Score){
        $winnerId;
        if($team1Score>$team2Score){
            $winnerId = $match->team1_id;
        } else if($team1Score<$team2Score){
            $winnerId = $match->team2_id;
        }
        $match->winner_id = $winnerId;
        $match->save();
        $event = Event::find($match->event_id);
        $matchesWithoutWinner =  DB::table('matches')->where([
            ['event_id', '=', $event->id],
            ['winner_id', '=', NULL]
        ])->count();
        if($matchesWithoutWinner==0){
            $event->event_index += 1;
            $this->generateNextMatches($event);
        }
    }

    public function generateNextMatches(Event $event){
        $winners = DB::table('matches')->where([
            ['event_id', '=', $event->id],
            ['match_index', '=', $event->event_index - 1]
        ])->get();

        $baseForInnerid = DB::table('matches')->where('event_id', '=', $event->id)->max('inner_id');
        Carbon::createFromFormat("Y-m-d H:i:s", $event->start_at);
        print_r($winners);
        
        for($i=0; $i<$winners->count(); $i+=2){
            $match = new Match;
            $baseForInnerid++;
            $match->inner_id = $baseForInnerid;
            $match->match_index = $event->event_index;
            $match->match_date = Carbon::createFromFormat("Y-m-d H:i:s", '2019-04-10 20:00:00');
            $match->team1_id = $winners[$i]->winner_id;
            $match->team2_id = $winners[$i+1]->winner_id;
            $match->event_id = $event->id;
            $match->save();
        }
    }
}