<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'tag', 'description'
    ];

    /**
     * Get the boards for the project.
     */
    public function boards() {
        return $this->hasMany('App\Board');
    }

    /**
     * Get the users for the project.
     */
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
