<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Supplier;
use App\Product;
use App\CounterPage;
use App\PurchasesBill;
use Illuminate\Http\Request;
use Session;

class PurchasesBillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($accion,Request $request)
    {
        $idind = $this->idindex($accion);
        if(!$this->islogged() || !$this->tienepermiso($idind,7))
        {
            return redirect('main');
        }
        $keyword = $request->get('search');
        $perPage = 25;
        $cant = $this->contarindex($accion); 

        if (!empty($keyword)) {
            $purchasesbills = PurchasesBill::where('purchasedate', 'LIKE', "%$keyword%")
				->orWhere('totalamount', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $purchasesbills = PurchasesBill::paginate($perPage);
        }
        return view('purchases-bills.'.$accion, compact('purchasesbills','cant'));
    }

    public function idindex($accion)
    {
        if($accion == 'index'){
            return 29;
        }elseif($accion == 'indexdelete'){
            return 30;
        }
        return 23424;
    }

    public function contarindex($accion)
    {
        $cant = 0;
        $accions = CounterPage::where('pageroute','/purchases-bills/index/'.$accion)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;
    }

    public function contarfuncion($funcion)
    {
        $rutinga = '/purchases-bills/'.$funcion;
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
        if(!$this->islogged() || !$this->tienepermiso(28,7))
        {
            return redirect('main');
        }
        $suppliers = Supplier::all();
        $purchasesbill = new PurchasesBill;
        $cant = $this->contarfuncion('create');
        return view('purchases-bills.create', compact('suppliers', 'purchasesbill','cant'));
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
        if(!$this->islogged() || !$this->tienepermiso(28,7))
        {
            return redirect('main');
        }
        $requestData = $request->all();
        $purchasesbill = new PurchasesBill;
        $purchasesbill->purchasedate = $requestData['purchasedate'];
        $purchasesbill->totalamount = $requestData['totalamount'];
        $purchasesbill->confirmed = $requestData['confirmed'];
        $purchasesbill->employee_id = $requestData['employee_id'];
        $purchasesbill->supplier_id = $requestData['supplier_id'];
        $purchasesbill->save();

        Session::flash('flash_message', 'PurchasesBill added!');
        $cant = $this->contarfuncion('show');
        return view('purchases-bills.show', compact('purchasesbill','cant'));
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
        if(!$this->islogged() || !$this->tienepermiso(29,7))
        {
            return redirect('main');
        }
        $purchasesbill = PurchasesBill::findOrFail($id);

        return view('purchases-bills.show', compact('purchasesbill','show'));
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
        $purchasesbill = PurchasesBill::findOrFail($id);
        return view('purchases-bills.edit', compact('purchasesbill','cant'));
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
        
        $purchasesbill = PurchasesBill::findOrFail($id);
        $purchasesbill->update($requestData);

        Session::flash('flash_message', 'PurchasesBill updated!');

        return redirect('sales-bills/index/indexedit');
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
        if(!$this->islogged() || !$this->tienepermiso(30,7))
        {
            return redirect('main');
        }
        $purchasesbill = PurchasesBill::findOrFail($id);
        $purchasesbilldetails = $purchasesbill->purchasesbilldetails;
        for ($i = 0; $i < count($purchasesbilldetails); $i++) { 
            $product = Product::findOrFail($purchasesbilldetails[$i]->product_id);
            $product->stock = $product->stock - $purchasesbilldetails[$i]->amount;
            $product->update();
        }
        PurchasesBill::destroy($id);

        Session::flash('flash_message', 'PurchasesBill deleted!');

        return Redirect::back();
    }
}
