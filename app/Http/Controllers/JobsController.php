<?php

namespace App\Http\Controllers;


use App\Company;
use App\Engagement;
use App\Job;
use App\JobRate;
use App\Permission;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class JobsController extends Controller
{
    protected $permissions;

    public function __construct()
    {
        $this->middleware('auth');
        $this->permissions = Permission::all();
        $this->current_time = Carbon::now()->toDateTimeString();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::detailOf(request('company'));
        $jobs_collect = Job::orderBy('created_at')->get();
      
        if(request()->exists('company')){
            if(count($company) > 0){
                $jobs_collect = $jobs_collect->where('company_id', $company->id);
            }else{
                $jobs = collect();
                return view('job.index', compact('jobs'));
            }
        }
        $jobs = $jobs_collect;

        return view('job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_detail = Company::detailOf(request("company"));
        $engagements = Engagement::orderBy('name')->get();
        $company = request()->exists("company") && !empty($company_detail) ? $company_detail : Company::all();

        $job = request()->exists("job") ? Job::with('card_details', 'layers')->find(request('job')) : collect();

        return view('job.create', compact('job','company', 'engagements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // start validation
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'hour' => 'required',
            'engagement_id' => 'required',
        ]);
        $validator->validate();

        $prev_job = Job::where('id', $request->prev_job)->get();
        $request['user_id'] = Auth::id();
        $engagement = Engagement::find($request->engagement_id);
        $jobs = $engagement->new_job(
            new Job($request->all())
        );

        flash()->overlay('New Job Created!', 'Success');
        return redirect('job/'. $jobs->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($job)
    {  
        $staffs = User::with('salaries')->orderBy('name')->get();
        $job = Job::with('job_rates')->find($job);

        return view('job.show', compact('job', 'staffs'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, Job $job)
    {
        $status = $job->status=='B' ? 'A' : 'B';
        $job->update(['status' => $status]);

        flash()->overlay(trans('job/index.job_updated').'!', trans('job/index.success'));
        return redirect('/job/'.$job->id);
    }



    public function assign(Request $request, Job $job)
    {

        $job->staffs()->sync($request->user_id);

        flash()->overlay('Staff Assigned', 'Success');
        return back(); 
    }



    public function track(Request $request, Job $job)
    {

        $job->new_job_rate(new JobRate($request->all()));

        // if($request->salary_id != null){
        //     JobRate::where('job_id', $job->id)->whereNotIn('salary_id', $request->salary_id)->update(['status' => 'B']);
        //     $job_rates = JobRate::where('job_id', $job->id)->get();
        //     foreach($request->salary_id as $salary_id){
        //         if(in_array($salary_id, $job_rates->pluck('salary_id')->toArray())){
        //             JobRate::where('job_id', $job->id)->where('salary_id', $salary_id)->update(['status' => 'A']);
        //         }else{
        //             $salary['salary_id'] = $salary_id;
        //             $job->new_job_rate(new JobRate($salary));
        //         }
        //     }
        // }else{
        //     JobRate::where('job_id', $job->id)->update(['status' => 'B']);
        // }

        flash()->overlay('Working Hour Recorded', 'Success');
        return back(); 
    }




    public function complete(Request $request, Job $job)
    {
        $job->update(['stage_id'=> 2]);

        flash()->overlay('Job Completed', 'Success');
        return back(); 
    }


    public function review(Request $request, Job $job)
    {
        $job->update(['stage_id'=> 3]);
        
        flash()->overlay('Job Reviewed', 'Success');
        return back(); 
    }




}