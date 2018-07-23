<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


	public function index()
    {
        $permissions = Permission::all();
    	$roles =  Role::orderBy('name')->paginate(25);
    	$companies = Company::orderBy('name', 'asc')->get();
    	return view('privilege/role.index', compact('roles', 'companies', 'permissions'));
    } 



    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|unique:roles',
    		'company_id' => 'required|exists:companies,id',
    		'label' => 'required'
    	]);

    	$roles = new Role([
            'name' => $request->input('name'),
            'company_id' => $request->input('company_id'),
            'label' => $request->input('label'),
        ]);

        $roles->save();

        $roles->permissions()->sync($request->permission);

      	flash()->overlay('Role added!', 'success');
    	return back();
    } 


    public function show(Role $role)
    {
        $permissions = Permission::all()->sortBy('name');
        $staffs = $role->users;
        return view('privilege/role.show', compact('role', 'permissions', 'staffs'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign_permission(Request $request, $id)
    {
        $role = Role::find($id);
        $role->permissions()->sync($request->permissions);

        flash()->overlay('Permissions assigned!', trans('job/index.success'));
        return back();
    }


    public function status(Request $request, $id)
    {
        $role = Role::find($id);
        $status = $role->status != 'A' ? 'A' : 'B';
        $role->update(['status' => $status]);

        flash()->overlay(trans('job/index.status'.$status), trans('job/index.success'));
        return redirect('/role/'.$role->id);
    } 

}
