<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Client;
use App\Product;
use App\SalesBill;
use App\CounterPage;
use Illuminate\Http\Request;
use Session;

class SalesBillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($accion, Request $request)
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }

        $salesbillstodelete = SalesBill::all();
        for ($i = 0; $i < count($salesbillstodelete); $i++) {
            if ($salesbillstodelete[$i]->confirmed == false) {
                $this->destroy($salesbillstodelete[$i]->id);
            }
        }

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $salesbills = SalesBill::where('salesdate', 'LIKE', "%$keyword%")
				->orWhere('totalamount', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $salesbills = SalesBill::paginate($perPage);
        }

        return view('sales-bills.'.$accion, compact('salesbills'));
    }

    public function contarindex($accion)
    {
        $cant = 0;
        $accions = CounterPage::where('pageroute','/sales-bills/index/'.$accion)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;
    }

    public function contarfuncion($funcion)
    {
        $rutinga = '/sales-bills/'.$funcion;
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $cant = $this->contarfuncion('create');
        $clients = Client::all();
        $salesbill = new SalesBill;
        return view('sales-bills.create', compact('clients', 'salesbill','cant'));
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
        $salesbill = new SalesBill;
        $salesbill->salesdate = $requestData['salesdate'];
        $salesbill->totalamount = $requestData['totalamount'];
        $salesbill->confirmed = $requestData['confirmed'];
        $salesbill->employee_id = $requestData['employee_id'];
        $salesbill->client_id = $requestData['client_id'];
        $salesbill->save();
        $cant = $this->contarfuncion('show');
        return view('sales-bills.show', compact('salesbill','cant'));
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
        $salesbill = SalesBill::findOrFail($id);
        return view('sales-bills.show', compact('salesbill','show'));
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
        $clients = Client::all();
        $salesbill = SalesBill::findOrFail($id);

        return view('sales-bills.edit', compact('salesbill', 'clients'));
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
        
        $salesbill = SalesBill::findOrFail($id);
        $salesbill->update($requestData);

        Session::flash('flash_message', 'SalesBill updated!');
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $salesbill = SalesBill::findOrFail($id);
        $salebilldetails = $salesbill->salebilldetails;
        for ($i = 0; $i < count($salebilldetails); $i++) { 
            $product = Product::findOrFail($salebilldetails[$i]->product_id);
            $product->stock = $product->stock + $salebilldetails[$i]->amount;
            $product->update();
        }
        SalesBill::destroy($id);

        Session::flash('flash_message', 'SalesBill deleted!');

        return redirect('sales-bills/index/indexdelete');
    }

    public function statistics() {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $salesbills = SalesBill::all();
        $all = "";
        $array = array();
        for ($i = 0; $i < count($salesbills); $i++) {
            if (!in_array($salesbills[$i]->salesdate, $array)) {               
                $sales = $salesbills[$i]->salesdate;
                $array[] = $sales;
                $cantidad = $salesbills[$i]->totalamount;
                for ($j =$i + 1; $j < count($salesbills); $j++) { 
                    $aux = $salesbills[$j]->salesdate;
                    if ($sales === $aux) {
                        $cantidad = $cantidad + $salesbills[$j]->totalamount;
                    }
                }
                $all .= "{x: '". $salesbills[$i]->salesdate. "', y: ". $cantidad. "}," ;
            }
        }
        return view('sales-bills.statistics', compact('all'));
    }

    public function confirm($id) {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $salesbill = SalesBill::findOrFail($id);
        $salesbill->confirmed = true;;
        $salesbill->update();

        return redirect('sales-bills/index/index');
    }
}
