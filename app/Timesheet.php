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
        'jam_mulai',
        'jam_selesai',
        'keterangan_timesheet',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

}
