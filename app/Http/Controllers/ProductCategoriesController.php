<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use App\ProductCategory;
use Illuminate\Http\Request;
use Session;

class ProductCategoriesController extends Controller
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

        if (!empty($keyword)) {
            $productcategories = ProductCategory::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $productcategories = ProductCategory::paginate($perPage);
        }
        return view('product-categories.'.$accion, compact('productcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $productcategory = new ProductCategory;
        return view('product-categories.create',compact('productcategory'));
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
        
        ProductCategory::create($requestData);

        Session::flash('flash_message', 'ProductCategory added!');
        return redirect('product-categories/index/index');
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
        $productcategory = ProductCategory::findOrFail($id);

        return view('product-categories.show', compact('productcategory'));
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
        $productcategory = ProductCategory::findOrFail($id);

        return view('product-categories.edit', compact('productcategory'));
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
        
        $productcategory = ProductCategory::findOrFail($id);
        $productcategory->update($requestData);

        Session::flash('flash_message', 'ProductCategory updated!');
        
        return redirect('product-categories/index/indexedit');
    }

    public function trash()
    {
        $productcategories = ProductCategory::intrash();
        return view('product-categories.trash', compact('productcategories'));
    }

    public function restore($id)
    {
        $product = ProductCategory::withTrashed()->find($id);
        $product->restore();
        return redirect('product-categories/trash');
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
        ProductCategory::destroy($id);

        Session::flash('flash_message', 'ProductCategory deleted!');

        return Redirect::back();
    }
}
