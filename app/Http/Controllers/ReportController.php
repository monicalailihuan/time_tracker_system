<?php

namespace App\Http\Controllers;

use App\Company;
use App\Job;
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

    public function high_variance()
    {
    	$jobs = Job::with('staffs')->orderBy('title')->get();
    	return view('report.high_variance', compact('jobs'));
    } 


    public function staff_earn()
    {
    	$staffs = User::with('salaries', 'jobs')->orderBy('name')->get();


    	return view('report.staff_earn', compact('staffs'));
    } 


}
