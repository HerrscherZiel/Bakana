<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    //
    protected $table = 'jobs';

    public $primaryKey = 'id_job';

    public $timestamps = true;

    protected $fillable = [
        'nama_job',
        'user',
        'tgl_mulai',
        'deadline',
        'tgl_user',
        'status',
        'module_id',
        'keterangan',
    ];

    public function modules(){
        return $this->belongsTo('App\Module','module_id','id_module');
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
