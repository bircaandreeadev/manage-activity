<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Support\Facades\Validator;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    /**
    * Get the projects for the users.
    */
    public function projects() {
        return $this->belongsToMany('App\Project');
    }

    /**
    * Get the tasks for the users.
    */
    public function tasks() {
        return $this->hasMany('App\User');
    }

    /**
     * Get the tasks created by the user
     */

    public function createdTasks() {
        return $this->hasMany('App\User', 'created_by_user_id', 'user_id');
    }

    /**
     * Validate inputs
     */
    public static function validate(array $input)
    {
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        return $validator;
    }
}
