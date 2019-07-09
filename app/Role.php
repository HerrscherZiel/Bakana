<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';

    public $primaryKey = 'id_role';

    public $timestamps = true;

    protected $fillable = ['nama_role', 'keterangan'];
}
