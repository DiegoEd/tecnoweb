<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\PurchasesBill;
use App\PurchasesBillDetail;
use Illuminate\Http\Request;
use Session;

class PurchasesBillDetailsController extends Controller
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
            $purchasesbilldetails = PurchasesBillDetail::where('price', 'LIKE', "%$keyword%")
				->orWhere('amount', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $purchasesbilldetails = PurchasesBillDetail::paginate($perPage);
        }

        return view('purchases-bill-details.index', compact('purchasesbilldetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $purchasesbilldetail = new PurchasesBillDetail;
        $purchasesbilldetail->purchases_bill_id = $id;
        $products = Product::all();
        return view('purchases-bill-details.create', compact('purchasesbilldetail', 'products'));
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
        $product->stock = $product->stock + $requestData['amount'];
        $product->update();

        $purchasesbill = PurchasesBill::findOrFail($requestData['purchases_bill_id']);
        $purchasesbill->totalamount = $purchasesbill->totalamount + ($requestData['amount'] * $requestData['price']);
        $purchasesbill->save();

        PurchasesBillDetail::create($requestData);

        Session::flash('flash_message', 'PurchasesBillDetail added!');

        return view('purchases-bills.show', compact('purchasesbill'));
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
        $purchasesbilldetail = PurchasesBillDetail::findOrFail($id);

        return view('purchases-bill-details.show', compact('purchasesbilldetail'));
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
        $purchasesbilldetail = PurchasesBillDetail::findOrFail($id);

        return view('purchases-bill-details.edit', compact('purchasesbilldetail'));
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
        
        $purchasesbilldetail = PurchasesBillDetail::findOrFail($id);
        $purchasesbilldetail->update($requestData);

        Session::flash('flash_message', 'PurchasesBillDetail updated!');

        return redirect('purchases-bill-details');
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
        PurchasesBillDetail::destroy($id);

        Session::flash('flash_message', 'PurchasesBillDetail deleted!');

        return redirect('purchases-bill-details');
    }
}
