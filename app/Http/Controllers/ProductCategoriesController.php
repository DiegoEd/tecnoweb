<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use App\ProductCategory;
use App\CounterPage;
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
        $idind = $this->idindex($accion);
        if(!$this->islogged() || !$this->tienepermiso($idind,4))
        {
            return redirect('main');
        }
        $keyword = $request->get('search');
        $perPage = 25;
        $cant = $this->contarindex($accion); 
        if (!empty($keyword)) {
            $productcategories = ProductCategory::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $productcategories = ProductCategory::paginate($perPage);
        }
        return view('product-categories.'.$accion, compact('productcategories','cant'));
    }

    public function idindex($accion)
    {
        if($accion == 'index'){
            return 18;
        }elseif($accion == 'indexedit'){
            return 19;
        }elseif($accion == 'indexdelete'){
            return 20;
        }
        return 23424;
    }


    public function contarindex($accion)
    {
        $cant = 0;
        $accions = CounterPage::where('pageroute','/product-categories/index/'.$accion)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;
    }

    public function contarfuncion($funcion)
    {
        $rutinga = '/product-categories/'.$funcion;
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
        if(!$this->islogged() || !$this->tienepermiso(16,4))
        {
            return redirect('main');
        }
        $productcategory = new ProductCategory;
        $cant = $this->contarfuncion('create');        
        return view('product-categories.create',compact('productcategory','cant'));
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
        if(!$this->islogged() || !$this->tienepermiso(16,4))
        {
            return redirect('main');
        }
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
        if(!$this->islogged() || !$this->tienepermiso(18,4))
        {
            return redirect('main');
        }
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
        if(!$this->islogged() || !$this->tienepermiso(19,4))
        {
            return redirect('main');
        }
        $productcategory = ProductCategory::findOrFail($id);
        $cant = $this->contarfuncion('edit');
        return view('product-categories.edit', compact('productcategory','cant'));
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
        if(!$this->islogged() || !$this->tienepermiso(19,4))
        {
            return redirect('main');
        }
        $requestData = $request->all();
        
        $productcategory = ProductCategory::findOrFail($id);
        $productcategory->update($requestData);

        Session::flash('flash_message', 'ProductCategory updated!');
        
        return redirect('product-categories/index/indexedit');
    }

    public function trash()
    {
        if(!$this->islogged() || !$this->tienepermiso(17,4))
        {
            return redirect('main');
        }
        $productcategories = ProductCategory::intrash();
        $cant = $this->contarfuncion('trash');        
        return view('product-categories.trash', compact('productcategories','cant'));
    }

    public function restore($id)
    {
        if(!$this->islogged() || !$this->tienepermiso(17,4))
        {
            return redirect('main');
        }
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
        if(!$this->islogged() || !$this->tienepermiso(20,4))
        {
            return redirect('main');
        }
        ProductCategory::destroy($id);

        Session::flash('flash_message', 'ProductCategory deleted!');

        return Redirect::back();
    }
}
