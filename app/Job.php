<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $table = 'jobs';

    public $primaryKey = 'id_job';

    public $timestamps = true;

    protected $fillable = [
        'nama_job',
        'keterangan',
    ];

    public function modules(){
        return $this->belongsTo('App\Module','module_id','id_module');
    }
}
