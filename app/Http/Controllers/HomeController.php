<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $job_collect = Job::where('stage_id', '!=', 3)->orderByDesc('created_at')->get();

        $jobs = collect();
        foreach($job_collect as $job){
            if(Auth()->user()->can('sa')){
                $jobs->push($job);
            }else{
                foreach($job->staffs as $staff){
                    if($staff->id == Auth()->id()){
                        if($job->stage_id == 1){
                            $jobs->push($job);
                        }
                    }
                }
            }
        }
        

        return view('home', compact('jobs'));
    }
}
