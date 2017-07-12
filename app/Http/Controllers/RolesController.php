<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Role;
use App\Module;
use App\AccionRole;
use App\User;
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
        $role = new Role;
        $role->role = $requestData['role'];
        $role->description = $requestData['description'];
        $role->save();
        if(isset($requestData['accions']))
        {
            $accions_id = $requestData['accions'];
            foreach($accions_id as $accion_id)
            {
                $accion_role = new AccionRole;
                $accion_role->accion_id = $accion_id;
                $accion_role->role_id = $role->id;
                $accion_role->save();
            }
        }
        Session::flash('flash_message', 'Role added!');

        return redirect('roles');
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
        if(isset($requestData['accions'])){
            $accions_id = $requestData['accions'];
            foreach($accions_id as $accion_id)
            {
                $accion_role = new AccionRole;
                $accion_role->accion_id = $accion_id;
                $accion_role->role_id = $role->id;
                $accion_role->save();
            }            
        }
        Session::flash('flash_message', 'Role updated!');

        return redirect('roles');
    }

    public function commituser(Request $request)
    {
        $requestData = $request->all();
        $role = Role::findOrFail($requestData['id']);

        if(!isset($requestData['users']))
        {
            $users = $role->users;
            foreach ($users as $user) {
               $user->role_id = null;
               $user->save();
            }
        }else{
            $users_role = $requestData['users'];
            if(count($role->users)>0)
            {
                User::where('role_id', $role->id)->update(array('role_id' => null));
            }

            foreach ($users_role as $user_role) {
                   $user = User::findOrFail($user_role);
                   $user->role_id = $role->id;
                   $user->save();
            }
        }
        $perPage = 20;
        $roles = Role::paginate($perPage);
        return view('roles.index', compact('roles'));
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
        $accions = $role->accions;
        return view('roles.show', compact('role','accions'));
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

    public function signup($id)
    {
        $role = Role::findOrFail($id);
        $usersNull = User::where('role_id',null)->get();
        $usersMine = User::where('role_id',$id)->get();
        $users = $usersMine->merge($usersNull);
        return view('roles.signup', compact('role','users'));
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
