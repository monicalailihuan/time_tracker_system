<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function jobs()
    {
        return $this->belongsToMany(Job::class)->withPivot('complete', 'hour', 'remark');
    }


    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }



    public function new_salary(Salary $salary)  
    {
       return $this->salaries()->save($salary);
    }

}