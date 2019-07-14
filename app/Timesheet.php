<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    //
    protected $table = 'timesheets';

    public $primaryKey = 'id_timesheets';

    public $timestamps = true;

    protected $fillable = [
        'tgl_timesheet',
        'project',
        'jam_mulai',
        'jam_selesai',
        'keterangan_timesheet',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function duration()
    {
        $start = Carbon::parse($this->jam_mulai);
        $end = Carbon::parse($this->jam_selesai);
        $hours = $end->diffInHours($start);
        $seconds = $end->diffInSeconds($start);

    return $hours . ':' . $seconds;
    }

}
