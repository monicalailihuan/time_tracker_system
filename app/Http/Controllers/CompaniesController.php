<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyRequest;
use App\Job;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CompaniesController extends Controller
{
    protected $permissions;

    public function __construct()
    {
        $this->middleware('auth');
        $this->permissions = Permission::all();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('name')->get();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $companies = (new Company($request->all()))->save();
        flash()->overlay('Company Added!', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
            $company = Company::with('engagements', 'engagements.jobs')->where('name', $name)->first();
            return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('companies','name')->ignore($company->id)
            ]
        ]);

        $company->update($request->all());
        flash()->overlay('Company Updated!', 'success');
        return redirect('/company/'.$company->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function stat_details($jobs, $ongoing, $complete)
    {
        $stat_details = collect();
        for($x=0; $x<2; $x++){
            $at_date = $x==0 ? 'created_at' : 'updated_at';
            foreach($jobs->unique('id')->groupBy($at_date.'.year')->sortByDesc($at_date) as $year => $months){
                foreach($months->groupBy($at_date.'.month') as $month => $job_list){
                    $details = collect();
                    $details['year'] = $year;
                    $details['month'] = $month;
                    $details['title'] = $year.' '.date('F', mktime(0, 0, 0, $month, 10));

                    $next_year = $year+1;
                    $next_month = date('m', mktime(0, 0, 0, $month+1, 10));
                    $final_next_month = $month==12 ? $next_year.'-01-01' : $year.'-'.$next_month.'-01';
                    $final_current_month = $year.'-'.date('m', mktime(0, 0, 0, $month, 10)).'-01';
                    
                    if($x==0){
                        $details['created'] = count($job_list->where('created_at', '>=',  $final_current_month)->where('created_at', '<',  $final_next_month));
                        $details['ongoing'] = count($ongoing->where('created_at', '>=',  $final_current_month)->where('created_at', '<',  $final_next_month)->where('status', 'A'));
                        $details['complete'] = count($complete->where('last_work_date', '>=',  $final_current_month)->where('last_work_date', '<',  $final_next_month)->where('status', 'A'));
                    }else{
                        $details['reject'] = count($job_list->where('updated_at', '>=', $final_current_month)->where('updated_at', '<',  $final_next_month)->where('status', 'B'));
                        $details['hold'] = count($job_list->where('updated_at', '>=', $final_current_month)->where('updated_at', '<',  $final_next_month)->where('status', 'H'));
                    }
    
                    $stat_details->push($details);
                }
            }
        }

        return $stat_details->sortBy('month')->sortBy('year');
    }


}
