<?php

namespace App\Http\Controllers;


use App\Company;
use App\Engagement;
use App\Job;
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
    public function show(Job $job)
    {  
        $staffs = User::orderBy('name')->get();
        return view('job.show', compact('job', 'staffs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $company = $job->company;

        $job_type = request()->exists("type") ? JobType::find(request('type')) : collect();
        $rfid_selected = collect();

        if(count($job)>0 && count($job->layers)>0){
            $rfid_selected = Layer::join('layer_layer_type_option', 'layer_layer_type_option.layer_id', 'layers.id')
            ->join('layer_type_options', 'layer_layer_type_option.layer_type_option_id', 'layer_type_options.id')
            ->join('layer_types', 'layer_types.id', 'layer_type_options.layer_type_id')
            ->join('layer_setting_options', 'layer_type_options.layer_setting_option_id', 'layer_setting_options.id')
            ->join('layer_settings', 'layer_setting_options.layer_setting_id', 'layer_settings.id')

            ->select('layer_setting_options.id as id', 'layer_setting_options.name as name')
            ->where('layers.job_id', $job->id)
            ->where('layers.status', 'A')
            ->where('layer_types.id', 2)// 2 for rfid
            ->where('layer_settings.id', 2)// 2 for it's a type of material
            ->get();
            $rfid_selected = $rfid_selected->first();
        }



        $rfid_types = LayerTypeOption::join('layer_types', 'layer_types.id', 'layer_type_options.layer_type_id')
            ->join('layer_setting_options', 'layer_type_options.layer_setting_option_id', 'layer_setting_options.id')
            ->join('layer_settings', 'layer_setting_options.layer_setting_id', 'layer_settings.id')
            ->select('layer_setting_options.*')
            ->where('layer_types.name', 'RFID')
            ->where('layer_type_options.status', 'A')
            ->where('layer_settings.name', 'Material')
            ->get();

      

        $countries = Country::where('status', 'A')->orderBy('name')->get();
        $card_features = CardFeature::where('status', 'A')->orderBy('name')->get();
        $card_thickness = CardThickness::all()->sortBy("start_thickness");
        $agents = Agent::all();

        $barcodes = Barcode::where('status', 'A')->orderBy('name')->get();
        $monochromes = Monochrome::where('status', 'A')->orderBy('name')->get();
        $embossings = Embossing::where('status', 'A')->orderBy('name')->get();
        $magstripe_types = MagstripeType::where('status', 'A')->orderBy('name')->get();
        $card_textures = CardTexture::where('status', 'A')->orderBy('name')->get();

        return view('job.edit', compact('rfid_selected', 'job_type', 'job','company', 'countries', 'card_features', 'card_thickness', 'rfid_types', 'agents', 'barcodes', 'monochromes', 'embossings', 'magstripe_types', 'card_textures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $job)
    {


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'country_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'card_texture_id' => 'required'
        ]);

        $validator->validate();
        if(($request->card_thickness_id == null) && ($request->start_thickness == null || $request->end_thickness==null)){
            flash()->overlay('Please select thickness!', trans('job/index.alert'));
            return back();
        }


        $job =  Job::with('card_details')->find($job);
        $job_request = collect();
        foreach($request->all() as $item => $value){
             if($item == 'other_agent_ck') {
                $agent = Agent::detailOf($request->other_agent);
                if(count($agent)==0){
                    $other['name'] = $request->other_agent;
                    $agent = Agent::create($other);
                }
                $job_request->put('agent_id', $agent->id);

            }elseif($item == 'other_card_feature_ck') {
                $card_feature = CardFeature::detailOf($request->other_card_feature);
                if(count($card_feature)==0){
                    $other['name'] = $request->other_card_feature;
                    $card_feature = CardFeature::create($other);
                }
                $job_request->put('card_feature_id', $card_feature->id);
            }elseif($item == 'other_thickness_ck') { 
                $card_thickness = CardThickness::detailOf($request->start_thickness, $request->end_thickness);
                if(count($card_thickness)==0){
                    $thickness['start_thickness'] = $request->start_thickness;
                    $thickness['end_thickness'] = $request->end_thickness;
                    $card_thickness = CardThickness::create($thickness);
                }
                $job_request->put('card_thickness_id', $card_thickness->id);
            }elseif($item == 'other_rfid_ck') {
                $job_request->put('rfid_type', $request->other_rfid);
            }elseif($item=='agent_id' && $request->other_agent_ck == ''){
                $agent_id = $request->agent_id ? $request->agent_id : null;
                $job_request->put($item, $agent_id);
            }elseif($item == 'prev_job' && trim($request->prev_job) != '' && is_numeric($request->prev_job)) {
                $job_request->put('job_id', $value);
            }elseif($item=='urgent'){
                $job_request->put('priority_id', 2);
            }elseif($item=='preprinted'){
                $job_request->put($item, 1);
            }elseif($item=='reference'){
                $job_request->put('job_type_id', 3);
            }elseif($item == 'quantity'){
                if($request->sample == 1){
                    $reference_quantity = $request->sample_quantity == null ? 0 : $request->sample_quantity;
                    if($reference_quantity < 1){
                        flash()->overlay('Sample quantity must be more then 0!', trans('job/index.alert'));
                        return back();
                    }
                    $job_request->put('quantity', $reference_quantity);
                    $job_request->put('reference_quantity', $request->quantity);
                    $job_request->put('sample', 1);
                }else{
                    $job_request->put('sample', 0);
                    $job_request->put('quantity', $request->quantity);
                }
            }else{
                $job_request->put($item, $value);
            }
        }


        $request->preprinted==null ? $job_request->put('preprinted', 0) : '';
        $request->urgent==null ? $job_request->put('priority_id', 1) : '';
        if($request->job_type_id == null) {
            $job->job==null ? $job_request->put('job_type_id', 1) : $job_request->put('job_type_id', 3);
        }
        $jobs = $job->update($job_request->toArray());

        $card_front_detail['side'] = 1;
        $card_front_detail['job_id'] = $job->id;
        $card_front_detail['photo_image'] = $request->photo_image_front ? 1 : 0;
        $card_front_detail['barcode_id'] = $request->barcode_front ? $request->barcode_front : null;
        $card_front_detail['monochrome_id'] = $request->monochrome_front ? $request->monochrome_front : null;
        $card_front_detail['embossing_id'] = $request->embossing_front ? $request->embossing_front : null;
        $card_front_detail['magstripe_type_id'] = $request->magstripe_front && $request->magstripe_type_front ? $request->magstripe_type_front : null;
        $card_front_detail['t1'] = $request->magstripe_front && $request->t1_front ? $request->t1_front : 0;
        $card_front_detail['t2'] = $request->magstripe_front && $request->t2_front ? $request->t2_front : 0;
        $card_front_detail['t3'] = $request->magstripe_front && $request->t3_front ? $request->t3_front : 0;
        $card_front_update = $job->card_details->where('job_id', $job->id)->where('side', 1)->first();
        $card_front_update->update($card_front_detail);



        $card_back_detail['side'] = 0;
        $card_back_detail['job_id'] = $job->id;
        $card_front_detail['photo_image'] = $request->photo_image_back ? 1 : 0;
        $card_back_detail['barcode_id'] = $request->barcode_back ? $request->barcode_back : null;
        $card_back_detail['monochrome_id'] = $request->monochrome_back ? $request->monochrome_back : null;
        $card_back_detail['embossing_id'] = $request->embossing_back ? $request->embossing_back : null;
        $card_back_detail['magstripe_type_id'] = $request->magstripe_back && $request->magstripe_type_back ? $request->magstripe_type_back : null;
        $card_back_detail['t1'] = $request->magstripe_back && $request->t1_back ? $request->t1_back : 0; 
        $card_back_detail['t2'] = $request->magstripe_back && $request->t2_back ? $request->t2_back : 0;
        $card_back_detail['t3'] = $request->magstripe_back && $request->t3_back ? $request->t3_back : 0;
        $card_back_update = $job->card_details->where('job_id', $job->id)->where('side', 0)->first();
        $card_back_update->update($card_back_detail);

        flash()->overlay(trans('job/index.job_updated').'!', trans('job/index.success'));
        return redirect('job/'. $job->id);
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



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function images(Job $job)
    {   
        return view('job.image-list', compact('job'));
    }


    /**
     * Display the specified resource.
     *
     * @param  string $company
     * @return \Illuminate\Http\Response
     */
    public function company($company)
    {
        $company = Company::detailOf($company);
        $jobs = $company->jobs;

        return view('job.company-job', compact('company','jobs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Job $job
     * @return \Illuminate\Http\Response
     */
    public function progress($job)
    {
        $job = Job::with('job_stages_active')->find($job);
        $exceed = JobStage::exceed(Stage::all(), $job->id);

        $jobs = collect();
        $overall = floatval($job->check_stage($jobs->push($job), $this->permissions, null, null, True)->pluck('progress')->first());

        // $overall = floatval($job->check_stage($jobs->push($job, $this->permissions, null, null, 'com', True))->pluck('progress')->first());
        return view('job.progress', compact('job', 'exceed', 'overall'));
    }


    public function path(Job $job)
    {
        $parent = !is_null($job->job_id) ? Job::where('id', $job->job_id)->first() : collect();
        $sibling = count($parent) > 0 ? Job::with('jobs')->where('job_id', $parent->id)->where('id', '!=', $job->id)->get() : collect();
        $child = Job::with('jobs')->where('job_id', $job->id)->orderBy('id')->get();
        $sibling->push($job);

        return view('job.path', compact('job', 'parent', 'sibling', 'child'));
    }

    public function log($job)
    {
        $job = Job::with('activity', 'priority', 'job_type', 'company', 'arrangement', 'card_thickness', 'card_texture', 'card_feature', 'country', 'agent', 'user', 'card_details', 'card_details.activity', 'card_details.barcode', 'card_details.monochrome', 'card_details.embossing', 'card_details.magstripe_type')->find($job);

        $job_card_details = $job->card_details;
        $logs = collect();
        foreach($job->activity as $activity){
            $activity['decode_data'] = $activity->type == "updated" ? $this->re_json_encode($activity, array_keys($job->getRelations())) : array();
            $logs->push($activity);
        } 
        foreach($job_card_details as $job_card_detail){
            foreach($job_card_detail->activity as $activity){
                $activity['decode_data'] = $activity->type == "updated" ? $this->re_json_encode($activity, array_keys($job->card_details->first()->getRelations())) : array();
                $logs->push($activity);
            } 
        }
        $logs = $logs->sortByDesc('id');
        return view('job.log', compact('job', 'logs'));
    }


    public function re_json_encode($items, $relationships)
    {
        $old_object = (new $items->subject_type(json_decode($items->item, true)['old']));
        $new_object = (new $items->subject_type(json_decode($items->item, true)['new']));

        $custom_name = $this->custom_name();
        $data = array();
        foreach($old_object->getAttributes() as $old_key=>$old_item){
            if(!array_key_exists($old_key, $relationships) && strpos($old_key, '_id') === False){
                $data['old'][$old_key] = array_key_exists($old_key, $custom_name) ? $custom_name[$old_key][$old_item] : $old_item;
                $data['new'][$old_key] = array_key_exists($old_key, $custom_name) ? $custom_name[$old_key][$new_object[$old_key]] : $new_object[$old_key];
            }
        }
        foreach($relationships as $relationship){
            if(count($old_object->$relationship) > 0){
                if(array_key_exists($relationship, $custom_name)){
                    $data['old'][$relationship] = "";
                    $data['new'][$relationship] = "";
                    foreach($custom_name[$relationship] as $combination_name){
                        $data['old'][$relationship] .= $data['old'][$relationship] != "" ? $custom_name['symbol'][$relationship].$old_object->$relationship->$combination_name : $old_object->$relationship->$combination_name;
                        $data['new'][$relationship] .= $data['new'][$relationship] != "" ? $custom_name['symbol'][$relationship].$new_object->$relationship->$combination_name : $new_object->$relationship->$combination_name;        
                    }
                }else{
                    $data['old'][$relationship] = $old_object->$relationship->name;
                    $data['new'][$relationship] = $new_object->$relationship->name;    
                }
            }
        }
        return json_encode($data);
    }

    public function custom_name()
    {
        return array(
                "card_thickness" => array(
                    "start_thickness",
                    "end_thickness",
                ),
                "arrangement" => array(
                    "value1",
                    "value2",
                ),
                "symbol" => array(
                    "card_thickness" => " ~ ",
                    "arrangement" => " x "
                ),
                "status" => array(
                    "A" => " Active",
                    "B" => " Suspend",
                    "P" => " Pause",
                    "H" => " Hidden"
                ),
                "preprinted" => array(
                    "No",
                    "Yes"
                )

            );
    } 


    public function workflow($job)
    {
        $job = Job::with('job_stages_active', 'job_stages_active.stage')->find($job);
        return view('job.workflow', compact('job'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Job  $job
     * @return \Illuminate\Http\Response
     */
    public function hold(Request $request, Job $job)
    {
        $status = $job->status=='A' ? 'H' : 'A';

        $job->update(['status' => $status]);
        flash()->overlay(trans('job/index.job_updated').'!', trans('job/index.success'));
        return redirect('/job/'.$job->id);
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

        $staff = $job->staffs->where('id', Auth()->id())->first();
        $staff->pivot->complete = 1;
        $staff->pivot->hour = $request->hour;
        $staff->pivot->remark = $request->remark;
        $staff->pivot->save();

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