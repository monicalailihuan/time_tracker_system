<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 
    ];


    public function jobs()
    {
    	return $this->hasMany(Job::class);
    }


}
