<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    //
    protected $table = 'module';

    public $primaryKey = 'id_module';

    public $timestamps = true;

    protected $fillable = [
        'nama_module',
        'user',
        'tgl_mulai',
        'deadline',
        'tgl_user',
        'status',
        'color',
        'project_id',
        'keterangan',
    ];

    public function projects(){
        return $this->belongsTo('App\Project','project_id','id_project');
    }

    public function jobs(){
        return $this->belongsToMany('App\Job','id_module','module_id');
    }

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
