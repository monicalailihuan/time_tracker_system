<?php

namespace App\Http\Controllers;

use App\Role;
use App\Position;
use App\Salary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = User::orderBy('name')->get();

        return view('staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        flash()->overlay('New Staff Created!', trans('job/index.Success'));
        return redirect('/staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff =  User::with('roles')->find($id);
        $currentDate = \Carbon\Carbon::now();
        // $agoDate = $currentDate->subDays($currentDate->dayOfWeek)->subWeek();
     
        $roles =  Role::all();
        $positions =  Position::all();
        return view('staffs.show', compact('staff', 'roles','positions' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('staffs.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email2' => 'email'
        ]);

        $validator->validate();

        User::find(Auth::user()->id)->update($request->all());

        flash()->overlay('Detail Updated!', 'Success');
        return back();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign_role(Request $request, $id)
    {
        $staff = User::find($id);
        $staff->roles()->sync($request->roles);

        flash()->overlay('Role assigned!', 'Success');
        return back();
        
    }

    public function salary(Request $request, $user)
    {
        $staff = User::find($user);

        Salary::where('user_id', $user)->update(['status' => 'B']);

        $staff->new_salary(New Salary($request->all()));

        flash()->overlay('Salary updated!', 'Success');
        return back();
            
    } 

    public function status(Request $request, $user)
    {
        $staff = User::find($user);

        $status = $staff->status != 'A' ? 'A' : 'B';
        $staff->update(['status' => $status]);

        flash()->overlay('Status Updated', 'Success');
        return redirect('/staff/'.$staff->id);
    } 

public function edit_position(Request $request, $user)
    {
        $staff = User::find($user);

        $staff->update($request->all());

        flash()->overlay('Status Updated', 'Success');
        return redirect('/staff/'.$staff->id);
    } 


    public function edit_pass()
    {
        return view('staffs/password.edit');
    } 


    public function update_pass(Request $request)
    {
        if(Hash::check($request->old_password, Auth()->user()->password)){
            $this->validate($request, [
                'password' => 'required|min:6|confirmed'
            ]);

            Auth()->user()->update(['password' => Hash::make($request->password)]);
    
            flash()->overlay('Password Updated', 'Success');
            return view('staffs/password.edit');
        }

        $errors = collect();
        $errors->old_password = "Invalid current password.";
        return view('staffs/password.edit', compact('errors'));
        
    }

}
