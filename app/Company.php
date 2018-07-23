<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'state', 'add1', 'add2', 'postcode'
    ];


    public static function detailOf($name)
    {
        return static::where(compact('name'))->first();
    }



    public function engagements()
    {
        return $this->hasMany(Engagement::class);
    }


    // public function jobs()
    // {
    //     return $this->hasMany(Job::class);
    // }


    
    public function new_engagement(Engagement $engagement)  
    {
       return $this->engagements()->save($engagement);
    } 

    
    // public function new_job(Job $job)  
    // {
    //    return $this->jobs()->save($job);
    // } 
}
