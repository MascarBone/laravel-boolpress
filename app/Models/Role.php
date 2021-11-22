<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Relation Many to Many with users
    public function users() {
        return $this->belongsToMany('App\User','role_user');
    }
}
