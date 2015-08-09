<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected  $fillable = [
        'name',
        'responsable',
        'email',
        'phone',
        'address',
        'obs'
    ];

    public function projects(){

        return $this->hasMany(Project::class);
    }

}
