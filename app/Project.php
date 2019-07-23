<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    //

    protected $table = 'project';

    public $primaryKey = 'id_project';

    public $timestamps = true;

    protected $fillable = [
        'kode_project',
        'nama_project',
        'tgl_mulai',
        'tgl_selesai',
        'status',
        'ket'
    ];

    public function team_project(){
        return $this->hasOne('App\TeamProject','project_id', 'id_project');
    }
//    public function objeks(){
//        return $this->hasMany('App\Objek');
//    }

    public function getId() {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }
}

