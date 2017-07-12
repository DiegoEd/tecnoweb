<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Support\Facades\Redirect;

use App\Product;
use Illuminate\Http\Request;
use Session;

class ProductsController extends Controller
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
            $products = Product::where('name', 'LIKE', "%$keyword%")
				->orWhere('price', 'LIKE', "%$keyword%")
				->orWhere('stock', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $products = Product::paginate($perPage);
        }

        return view('products.'.$accion, compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $productcategories = ProductCategory::all();
        $product = new Product;
        return view('products.create', compact('productcategories','product'));
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
        
        Product::create($requestData);

        Session::flash('flash_message', 'Product added!');

        return redirect('products/index/index');
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
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
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
        $product = Product::findOrFail($id);
        $productcategories = ProductCategory::all();
        $selected='selected';
        return view('products.edit', compact('product','productcategories','selected'));
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
        
        $product = Product::findOrFail($id);
        $product->update($requestData);

        Session::flash('flash_message', 'Product updated!');

        return redirect('products/index/indexedit');
    }

    public function trash()
    {
        $products = Product::intrash();
        return view('products.trash', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        $product->restore();
        return redirect('products/trash');
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
        Product::destroy($id);

        Session::flash('flash_message', 'Product deleted!');

        return Redirect::back();
    }
}
