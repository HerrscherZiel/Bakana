<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    protected $table = 'project';

    public $primaryKey = 'id_project';

    public $timestamps = true;

    protected $fillable = ['kode_project', 'nama_project', 'tgl_mulai', 'tgl_selesai', 'status', 'ket'];

    public function team_project(){
        return $this->hasOne('App\TeamProject','project_id', 'id_project');
    }
//    public function objeks(){
//        return $this->hasMany('App\Objek');
//    }
}

