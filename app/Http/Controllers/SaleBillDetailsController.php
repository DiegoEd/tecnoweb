<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\SalesBill;
use App\SaleBillDetail;
use Illuminate\Http\Request;
use Session;

class SaleBillDetailsController extends Controller
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
            $salebilldetails = SaleBillDetail::where('price', 'LIKE', "%$keyword%")
				->orWhere('amount', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $salebilldetails = SaleBillDetail::paginate($perPage);
        }

        return view('sale-bill-details.index', compact('salebilldetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $salebilldetail = new SaleBillDetail;
        $salebilldetail->sales_bill_id = $id;
        $products = Product::all();
        return view('sale-bill-details.create', compact('salebilldetail', 'products'));
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
        
        $product = Product::findOrFail($requestData['product_id']);
        if ($requestData['amount'] > $product->stock) {
            return redirect()->back()->withErrors(array('error' => 'El Stock no abastece la venta: '. $product->stock. ' disponible'));
        }
        $product->stock = $product->stock - $requestData['amount'];
        $product->update();
        $salesbill = SalesBill::findOrFail($requestData['sales_bill_id']);
        $salesbill->totalamount = $salesbill->totalamount + ($requestData['amount'] * $requestData['price']);
        $salesbill->save();
        SaleBillDetail::create($requestData);

        Session::flash('flash_message', 'SaleBillDetail added!');

        return view('sales-bills.show', compact('salesbill'));
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
        $salebilldetail = SaleBillDetail::findOrFail($id);

        return view('sale-bill-details.show', compact('salebilldetail'));
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
        $salebilldetail = SaleBillDetail::findOrFail($id);
        $products = Product::all();
        return view('sale-bill-details.edit', compact('salebilldetail', 'products'));
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
        $salebilldetail = SaleBillDetail::findOrFail($id);
        $salebilldetail->update($requestData);

        Session::flash('flash_message', 'SaleBillDetail updated!');
        $salesbill = SalesBill::findOrFail($requestData['sales_bill_id']);
        return view('sales-bills.show', compact('salesbill'));
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
        SaleBillDetail::destroy($id);

        Session::flash('flash_message', 'SaleBillDetail deleted!');

        return redirect('sale-bill-details');
    }
}
