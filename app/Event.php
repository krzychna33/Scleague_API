<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Team;

class Event extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'description', 'prize', 'slots', 'start_at'];

    public function teams(){
        return $this->belongsToMany(Team::class)->withTimestamps();
    }
}
