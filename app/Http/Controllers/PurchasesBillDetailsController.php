<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use App\Product;
use App\PurchasesBill;
use App\PurchasesBillDetail;
use Illuminate\Http\Request;
use App\CounterPage;
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
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

    public function contarfuncion($funcion)
    {
        $accions = CounterPage::where('pageroute',$funcion)->get();
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
    public function create($id)
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $purchasesbilldetail = new PurchasesBillDetail;
        $purchasesbilldetail->purchases_bill_id = $id;
        $products = Product::all();
        $cant = $this->contarfuncion('/purchases-bills-details/create');
        return view('purchases-bill-details.create', compact('purchasesbilldetail', 'products','cant'));
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
        $product = Product::findOrFail($requestData['product_id']);
        $product->stock = $product->stock + $requestData['amount'];
        $product->update();

        $purchasesbill = PurchasesBill::findOrFail($requestData['purchases_bill_id']);
        $purchasesbill->totalamount = $purchasesbill->totalamount + ($requestData['amount'] * $requestData['price']);
        $purchasesbill->save();

        PurchasesBillDetail::create($requestData);

        Session::flash('flash_message', 'PurchasesBillDetail added!');
        $cant = $this->contarfuncion('/purchases-bills/show');
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $purchasesbilldetail = PurchasesBillDetail::findOrFail($id);
        $products = Product::all();

        return view('purchases-bill-details.edit', compact('purchasesbilldetail', 'products'));
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

        $purchasesbill = PurchasesBill::findOrFail($requestData['purchases_bill_id']);
        if ($requestData['amount'] > $requestData['previous_amount']) {
            $diferencia = $requestData['amount'] - $requestData['previous_amount'];
            $purchasesbill->totalamount = $purchasesbill->totalamount - ($requestData['previous_amount'] * $requestData['price']);
            $purchasesbill->totalamount = $purchasesbill->totalamount + ($requestData['amount'] * $requestData['price']);
            $product = Product::findOrFail($requestData['product_id']);
            $product->stock = $product->stock + $diferencia;
            $purchasesbill->update();
            $product->update();
        } else if ($requestData['amount'] < $requestData['previous_amount']) {
            $diferencia = $requestData['previous_amount'] - $requestData['amount'];
            $purchasesbill->totalamount = $purchasesbill->totalamount - ($requestData['previous_amount'] * $requestData['price']);
            $purchasesbill->totalamount = $purchasesbill->totalamount + ($requestData['amount'] * $requestData['price']);
            $product = Product::findOrFail($requestData['product_id']);
            $product->stock = $product->stock - $diferencia;
            $purchasesbill->update();
            $product->update();
        }
        
        $purchasesbilldetail = PurchasesBillDetail::findOrFail($id);
        $purchasesbilldetail->update($requestData);

        Session::flash('flash_message', 'PurchasesBillDetail updated!');

        return view('purchases-bills.show', compact('purchasesbill'));
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

        $purchasesbilldetail = PurchasesBillDetail::findOrFail($id);
        $purchasesbill = PurchasesBill::findOrFail($purchasesbilldetail->purchases_bill_id);
        $product = Product::findOrFail($purchasesbilldetail->product_id);

        $purchasesbill->totalamount = $purchasesbill->totalamount - ($purchasesbilldetail->price * $purchasesbilldetail->amount);

        $product->stock = $product->stock - $purchasesbilldetail->amount;

        $purchasesbilldetail->update();
        $product->update();

        PurchasesBillDetail::destroy($id);

        Session::flash('flash_message', 'PurchasesBillDetail deleted!');

        return view('purchases-bills.show', compact('purchasesbill'));
    }
}
