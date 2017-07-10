<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Role;
use App\Module;
use App\AccionRole;
use Illuminate\Http\Request;
use Session;
use DB;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $roles = Role::where('role', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $roles = Role::paginate($perPage);
        }

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $role = new Role;
        $modules = Module::with('accions')->get();
        return view('roles.create',compact('role','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        $accions_id = $requestData['accions'];
        $role = new Role;
        $role->role = $requestData['role'];
        $role->description = $requestData['description'];
        $role->save();
        foreach($accions_id as $accion_id)
        {
            $accion_role = new AccionRole;
            $accion_role->accion_id = $accion_id;
            $accion_role->role_id = $role->id;
            $accion_role->save();
        }

        Session::flash('flash_message', 'Role added!');

        return redirect('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $modules = Module::with('accions')->get();
        return view('roles.edit', compact('role','modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $role = Role::findOrFail($id);
        DB::table('accion_role')->where('role_id',$id)->delete();
        $role->update($requestData);
        $accions_id = $requestData['accions'];
        foreach($accions_id as $accion_id)
        {
            $accion_role = new AccionRole;
            $accion_role->accion_id = $accion_id;
            $accion_role->role_id = $role->id;
            $accion_role->save();
        }

        Session::flash('flash_message', 'Role updated!');

        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        DB::table('accion_role')->where('role_id',$id)->delete();
        Role::destroy($id);

        Session::flash('flash_message', 'Role deleted!');

        return redirect('roles');
    }
}
