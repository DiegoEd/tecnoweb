<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Accion;
use App\Module;
use Illuminate\Http\Request;
use Session;
use DB;

class AccionsController extends Controller
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
            $accions = Accion::where('name', 'LIKE', "%$keyword%")
				->orWhere('pageroute', 'LIKE', "%$keyword%")
				->orWhere('visitcount', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $accions = Accion::paginate($perPage);
        }

        return view('accions.index', compact('accions'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $accion = new Accion;
        $accion->visitcount = 0;
        $accion->module_id = $id;
        return view('accions.create',compact('accion'));
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
        $module = Module::findOrFail($requestData['module_id']);
        Accion::create($requestData);

        Session::flash('flash_message', 'Accion added!');

        return view('modules.show', compact('module'));
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
        $accion = Accion::findOrFail($id);

        return view('accions.show', compact('accion'));
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
        $accion = Accion::findOrFail($id);

        return view('accions.edit', compact('accion'));
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
        
        $accion = Accion::findOrFail($id);
        $accion->update($requestData);

        Session::flash('flash_message', 'Accion updated!');
        $module = Module::findOrFail($accion->module_id);
        return view('modules.show', compact('module'));
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
        $accion = Accion::findOrFail($id);
        $module = Module::findOrFail($accion->module_id);
        DB::table('accion_role')->where('accion_id',$accion->id)->delete();
        $accion->delete();
        Session::flash('flash_message', 'Accion deleted!');
        return view('modules.show', compact('module'));
    }
}
