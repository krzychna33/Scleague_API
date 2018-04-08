<?php


namespace App\Repositories;
use App\TeamMembers;

class TeamMembersService{

    public function setUp(){
        $teamMembers = TeamMembers::create();
        return $teamMembers->id;
    }

    public function updateMembers($id, $members_urls){
        $teamMembers = TeamMembers::find($id);
        for($i=1; $i<=count($members_urls); $i++){
            $teamMembers["member{$i}_steamurl"] = $members_urls["member{$i}"];
        }
        if($teamMembers->save()){
            return true;
        } else {
            return false;
        }
    }
}