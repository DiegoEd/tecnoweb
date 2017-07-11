<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Module;
use App\Accion;
use Illuminate\Http\Request;
use Session;
use DB;

class ModulesController extends Controller
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
            $modules = Module::where('name', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $modules = Module::with('accions')->paginate($perPage);
        }

        return view('modules.index', compact('modules'));
    }
    public function generateview($id,Request $request)
    {
        $roless = $request->session()->get('roles');
        $accions = Accion::whereIn('id', (($roless[0])[$id])[2] )->get();
        return view('modules.generateview',compact('accions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $module = new Module;
        return view('modules.create',compact('module'));
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
        
        Module::create($requestData);

        Session::flash('flash_message', 'Module added!');

        return redirect('modules');
    }
    ##funcion descontinuada
    public function signup($id)
    {
        $module = Module::findOrFail($id);
        $accions = Accion::all();
        return view('roles.signup', compact('accions','module'));
    }
    ##funcion descontinuada
    public function commitaccions(Request $request)
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
        $module = Module::findOrFail($id);

        return view('modules.show', compact('module'));
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
        $module = Module::findOrFail($id);

        return view('modules.edit', compact('module'));
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
        
        $module = Module::findOrFail($id);
        $module->update($requestData);

        Session::flash('flash_message', 'Module updated!');

        return redirect('modules');
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
        $module = Module::findOrFail($id);

        foreach ($module->accions as $accion) {
            DB::table('accion_role')->where('accion_id',$accion->id)->delete();
        }

        Accion::where('module_id', $id)->delete();
        Module::destroy($id);
        Session::flash('flash_message', 'Module deleted!');

        return redirect('modules');
    }
}
