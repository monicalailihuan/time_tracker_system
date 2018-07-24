<?php

namespace App\Http\Controllers;

use App\Company;
use App\Engagement;
use App\Job;
use App\JobRate;
use App\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
		return view('report.index');
    } 


    public function revenue()
    {
    	$companies = Company::with('engagements', 'engagements.jobs')->orderBy('name')->get();
    	return view('report.revenue', compact('companies'));
    }



    public function engagement_revenue()
    {
    	$engagements = Engagement::with('company', 'jobs')->orderBy('name')->get();
    	return view('report.engagement_revenue', compact('engagements'));
    } 
 

    public function high_variance()
    {
    	$jobs = Job::with('staffs')->orderBy('title')->get();
    	$job_rates = JobRate::with('rates', 'job')->get();

    	return view('report.high_variance', compact('jobs', 'job_rates'));
    } 


    public function staff_earn()
    {
    	$staffs = User::with('salaries')->orderBy('name')->get();
    	$job_rates = JobRate::with('rates', 'job')->get();

    	return view('report.staff_earn', compact('staffs', 'job_rates'));
    } 


}
