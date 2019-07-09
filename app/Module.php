<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    protected $table = 'module';

    public $primaryKey = 'id_module';

    public $timestamps = true;

    protected $fillable = [
        'nama_module',
        'waktu',
        'status',
        'project_id',
        'keterangan',
    ];

    public function projects(){
        return $this->belongsTo('App\Project','project_id','id_project');
    }

    public function jobs(){
        return $this->belongsToMany('App\Job','id_module','module_id');
    }
}
