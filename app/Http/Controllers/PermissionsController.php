<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
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
        $permissions =  Permission::orderBy('name')->paginate(25);
        return view('privilege/permissions.index', compact('permissions'));
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
            'name' => 'required|unique:permissions',
            'label' => 'required'
        ]);

        // Permission::verify(auth()->user())->addPermission($request->all());

        $permissions = new Permission([
            'name'     => $request->input('name'),
            'label'   => $request->input('label'),
        ]);

        $permissions->save();

        flash()->overlay('Thanks for the contribution!', 'success');
           

        return back();
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


    public function status(Request $request, $id)
    {
        $permission = Permission::find($id);
        $status = $permission->status != 'A' ? 'A' : 'B';
        $permission->update(['status' => $status]);

        flash()->overlay(trans('job/index.status'.$status), trans('job/index.success'));
        return redirect('/permission');
    } 
}
