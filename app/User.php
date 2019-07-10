<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo('App\Role','role_id');
    }

    public function authorizeRoles($role)
    {
        if (is_array($role)) {
            return $this->hasAnyRole($role) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($role) ||
            abort(401, 'This action is unauthorized.');
    }
    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($role)
    {
        return null !== $this->role()->whereIn('nama_role', $role)->first();
    }
    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->role()->where('nama_role', $role)->first();
    }



    public function timesheet(){
        return $this->hasMany('App\Timesheet','user_id', 'id');
    }

    public function team_project(){
        return $this->hasMany('App\TeamProject','user_id', 'id');
    }


}
