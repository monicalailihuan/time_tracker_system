<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRate extends Model
{

    protected $table = "job_rates";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'salary_id', 'job_id', 'complete', 'hour', 'remark'
    ];


    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }


    public function rates()
    {
        return $this->belongsTo(Salary::class, 'salary_id');
    }


    // public function staffs()
    // {
    //     return $this->belongsToMany(User::class)->withPivot('complete', 'hour', 'remark');
    // }

  
    // public function company()
    // {
    //     return $this->belongsTo(Company::class, 'company_id');
    // } 
    // 


}