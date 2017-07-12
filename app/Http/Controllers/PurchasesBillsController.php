<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

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
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $purchasesbills = PurchasesBill::where('purchasedate', 'LIKE', "%$keyword%")
				->orWhere('totalamount', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $purchasesbills = PurchasesBill::paginate($perPage);
        }

        return view('purchases-bills.index', compact('purchasesbills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('purchases-bills.create');
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
        
        PurchasesBill::create($requestData);

        Session::flash('flash_message', 'PurchasesBill added!');

        return redirect('purchases-bills');
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
        $purchasesbill = PurchasesBill::findOrFail($id);

        return view('purchases-bills.show', compact('purchasesbill'));
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
        $purchasesbill = PurchasesBill::findOrFail($id);

        return view('purchases-bills.edit', compact('purchasesbill'));
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
        
        $purchasesbill = PurchasesBill::findOrFail($id);
        $purchasesbill->update($requestData);

        Session::flash('flash_message', 'PurchasesBill updated!');

        return redirect('purchases-bills');
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
        PurchasesBill::destroy($id);

        Session::flash('flash_message', 'PurchasesBill deleted!');

        return redirect('purchases-bills');
    }
}
