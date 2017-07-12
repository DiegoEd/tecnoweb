<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use Illuminate\Support\Facades\Redirect;

use App\Product;
use App\CounterPage;
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $keyword = $request->get('search');
        $perPage = 25;
        $cant = $this->contarindex($accion);  

        if (!empty($keyword)) {
            $products = Product::where('name', 'LIKE', "%$keyword%")
				->orWhere('price', 'LIKE', "%$keyword%")
				->orWhere('stock', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $products = Product::paginate($perPage);
        }

        return view('products.'.$accion, compact('products','cant'));
    }

    public function contarindex($accion)
    {
        $cant = 0;
        $accions = CounterPage::where('pageroute','/products/index/'.$accion)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;
    }

    public function contarfuncion($funcion)
    {
        $rutinga = '/products/'.$funcion;
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
        $productcategories = ProductCategory::all();
        $product = new Product;
        $cant = $this->contarfuncion('create');
        return view('products.create', compact('productcategories','product','cant'));
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $product = Product::findOrFail($id);
        $productcategories = ProductCategory::all();
        $selected='selected';
        $cant = $this->contarfuncion('edit');
        return view('products.edit', compact('product','productcategories','selected','cant'));
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
        
        $product = Product::findOrFail($id);
        $product->update($requestData);

        Session::flash('flash_message', 'Product updated!');

        return redirect('products/index/indexedit');
    }

    public function trash()
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $products = Product::intrash();
        $cant = $this->contarfuncion('trash');
        return view('products.trash', compact('products','cant'));
    }

    public function restore($id)
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
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
        if(!$this->islogged())
        {
            return redirect('main');
        }
        Product::destroy($id);

        Session::flash('flash_message', 'Product deleted!');

        return Redirect::back();
    }
}
