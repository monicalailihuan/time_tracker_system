<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'title', 'engagement_id', 'stage_id', 'user_id', 'status', 'remark', 'job_id', 'hour'
    ];


    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }


    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function staffs()
    {
        return $this->belongsToMany(User::class)->withPivot('complete', 'hour', 'remark');
    }

  
    // public function company()
    // {
    //     return $this->belongsTo(Company::class, 'company_id');
    // } 
    // 

    public function engagement()
    {
        return $this->belongsTo(Engagement::class, 'engagement_id');
    } 

}