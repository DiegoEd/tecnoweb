<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Module;
use App\Accion;
use App\CounterPage;
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $modules = Module::where('name', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $modules = Module::with('accions')->paginate($perPage);
        }
        $cant = $this->contarfuncion('/modules');

        return view('modules.index', compact('modules','cant'));
    }

    public function contarfuncion($funcion)
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $accions = CounterPage::where('pageroute',$funcion)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;

    }
    public function generateview($id,Request $request)
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $roless = $request->session()->get('roles');
        $accions = Accion::whereIn('id', (($roless[0])[$id])[3] )->get();
        $modules =  Module::where('id',(($roless[0])[$id])[0] )->get();
        $module = $modules->first();
        $cant = $module->visitcount;
        $cant++;
        $module->visitcount = $cant;
        $module->save();
        return view('modules.generateview',compact('accions','cant'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $requestData = $request->all();
        
        Module::create($requestData);

        Session::flash('flash_message', 'Module added!');

        return redirect('modules');
    }
    ##funcion descontinuada
    public function signup($id)
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $module = Module::findOrFail($id);
        $accions = Accion::all();
        return view('roles.signup', compact('accions','module'));
    }
    ##funcion descontinuada
    public function commitaccions(Request $request)
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $module = Module::findOrFail($id);
        $cant = $this->contarfuncion('/modules/show');
        return view('modules.show', compact('module','cant'));
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
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
