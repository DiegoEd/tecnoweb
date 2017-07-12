<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Client;
use App\Product;
use App\SalesBill;
use Illuminate\Http\Request;
use Session;

class SalesBillsController extends Controller
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
            $salesbills = SalesBill::where('salesdate', 'LIKE', "%$keyword%")
				->orWhere('totalamount', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $salesbills = SalesBill::paginate($perPage);
        }

        return view('sales-bills.index', compact('salesbills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $clients = Client::all();
        $salesbill = new SalesBill;
        return view('sales-bills.create', compact('clients', 'salesbill'));
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
        
        SalesBill::create($requestData);

        Session::flash('flash_message', 'SalesBill added!');

        return redirect('sales-bills');
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
        $salesbill = SalesBill::findOrFail($id);

        return view('sales-bills.show', compact('salesbill'));
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
        
        $requestData = $request->all();
        
        $salesbill = SalesBill::findOrFail($id);
        $salesbill->update($requestData);

        Session::flash('flash_message', 'SalesBill updated!');

        return redirect('sales-bills');
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
        $salesbill = SalesBill::findOrFail($id);
        $salebilldetails = $salesbill->salebilldetails;
        for ($i = 0; $i < count($salebilldetails); $i++) { 
            $product = Product::findOrFail($salebilldetails[$i]->product_id);
            $product->stock = $product->stock + $salebilldetails[$i]->amount;
            $product->update();
        }
        SalesBill::destroy($id);

        Session::flash('flash_message', 'SalesBill deleted!');

        return redirect('sales-bills');
    }

    public function statistics() {
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
}
