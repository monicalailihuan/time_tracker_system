<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salary', 'status', 'user_id'
    ];
    protected $table = "salary";



    public static function detailOf($name)
    {
        return static::where(compact('name'))->first();
    }


    public function jobs()
    {
        return $this->hasMany(Job::class);
    }


    public function salary()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
