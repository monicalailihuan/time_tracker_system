<?php

namespace App\Http\Controllers;

use App\Company;
use App\Engagement;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EngagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::detailOf(request('company'));

        $engagements_collect = Engagement::orderBy('created_at')->get();
      
        if(request()->exists('company')){
            if(count($company) > 0){
                $engagements_collect = $engagements_collect->where('company_id', $company->id);
            }else{
                $engagements = collect();
                return view('job.index', compact('jobs'));
            }
        }


        
        $engagements = $engagements_collect;

        return view('engagement.index', compact('engagements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_detail = Company::detailOf(request("company"));
        $company = request()->exists("company") && !empty($company_detail) ? $company_detail : Company::all();

        $engagement = request()->exists("job") ? Engagement::find(request('engagement')) : collect();

        return view('engagement.create', compact('engagement','company'));
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
            'name' => 'required',
            'engagement_end_date' => 'required',
            'company_id' => 'required',
        ]);
        $validator->validate();


        // $prev_engagement = Engagement::where('id', $request->prev_engagement)->get();
        $request['user_id'] = Auth::id();
        
        $request['end_date'] = \Carbon\Carbon::createFromFormat('d-m-Y H', $request->engagement_end_date.' 0');
            

        $company_detail = Company::detailOf(request("company"));
        $company = request()->exists('company') && !empty($company_detail) ? $company_detail : Company::find($request->company_id);

        $engagement = $company->new_engagement(
            new Engagement($request->all())
        );


        // if($prev_engagement->count() > 0){
        //     $jobs->pinned_comment($prev_engagement->first()->comments->where('pin', 1)->toArray());
        // }

        flash()->overlay('New engagement created!', 'Success');
        return redirect('engagement/'. $engagement->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Engagement $engagement)
    {
        $staffs = User::with('salaries')->orderBy('name')->get();
        return view('engagement.show', compact('engagement', 'staffs'));
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
    public function update(Request $request, $id)
    {
        //
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
}
