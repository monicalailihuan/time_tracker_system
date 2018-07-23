<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'name', 'company_id', 'user_id', 'status', 'user', 'end_date', 'remark'
    ];


    public function jobs()
    {
        return $this->hasMany(Job::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    } 

  
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    } 


    public function new_job(Job $job)  
    {
       return $this->jobs()->save($job);
    } 

}