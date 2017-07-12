<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Supplier;
use App\CounterPage;
use Illuminate\Http\Request;
use Session;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($accion,Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $cant = $this->contarindex($accion);  
        if (!empty($keyword)) {
            $suppliers = Supplier::where('name', 'LIKE', "%$keyword%")
				->orWhere('email', 'LIKE', "%$keyword%")
				->orWhere('telephone', 'LIKE', "%$keyword%")
				->orWhere('address', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $suppliers = Supplier::paginate($perPage);
        }

        return view('suppliers.'.$accion, compact('suppliers','cant'));
    }

    public function contarindex($accion)
    {
        $cant = 0;
        $accions = CounterPage::where('pageroute','/suppliers/index/'.$accion)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;
    }

    public function contarfuncion($funcion)
    {
        $rutinga = '/suppliers/'.$funcion;
        $accions = CounterPage::where('pageroute',$rutinga)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $suppliers = new Supplier;
        $cant = $this->contarfuncion('create');
        return view('suppliers.create', compact('suppliers','user','cant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @Route("/supplier/store", name="supplier_store")
     * @Method("POST")
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        //dd($requestData);
        Supplier::create($requestData);

        Session::flash('flash_message', 'Supplier added!');


        return redirect('suppliers/index/index');
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
        $suppliers = Supplier::findOrFail($id);
        return view('suppliers.show', compact('suppliers','user'));
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
        $suppliers = Supplier::findOrFail($id);
        $cant = $this->contarfuncion('edit');
        return view('suppliers.edit', compact('suppliers','user','cant'));
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
        $suppliers = Supplier::findOrFail($id);
        $suppliers->update($requestData);

        Session::flash('flash_message', 'Supplier updated!');
        return redirect('suppliers/index/indexedit');
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
        Supplier::destroy($id);

        Session::flash('flash_message', 'Supplier deleted!');
        return redirect::back();
    }
}
