<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    //
    protected $table = 'timeline';

    public $primaryKey = 'id_timeline';

    public $timestamps = true;

    protected $fillable = [
        'nama_timeline',
        'tgl_mulai',
        'deadline',
        'tgl_user',
    ];

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
