<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamProject extends Model
{
    //
    protected $table = 'team_projects';

    public $primaryKey = 'id_team_projects';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'project_id',
    ];

    public function user(){
        return $this->belongsToMany('App\User','user_id');
    }

    public function project(){
        return $this->belongsTo('App\Project','project_id');
    }
}
