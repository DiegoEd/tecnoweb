<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use DB;
use Illuminate\Support\Facades\Redirect;

use App\Client;
use App\CounterPage;
use Illuminate\Http\Request;
use Session;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    ##index,store,update,restore,destroy
    public function index($accion,Request $request)
    {
        $idind = $this->idindex($accion);
        if(!$this->islogged() || !$this->tienepermiso($idind,1))
        {
            return redirect('main');
        }
        $cant = $this->contarindex($accion);
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $clients = Client::where('name', 'LIKE', "%$keyword%")
				->orWhere('nit', 'LIKE', "%$keyword%")
				->orWhere('number', 'LIKE', "%$keyword%")
				->orWhere('address', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $clients = Client::paginate($perPage);
        }
        return view('clients.'.$accion, compact('clients','cant'));
    }

    public function idindex($accion)
    {
        if($accion == 'index'){
            return 3;
        }elseif($accion == 'indexedit'){
            return 4;
        }elseif($accion == 'indexdelete'){
            return 5;
        }
        return 23424;
    }

    public function contarindex($accion)
    {
        $cant = 0;
        $accions = CounterPage::where('pageroute','/clients/index/'.$accion)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;
    }

    public function contarfuncion($funcion)
    {
        $rutinga = '/clients/'.$funcion;
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
        if(!$this->islogged() || !$this->tienepermiso(1,1))
        {
            return redirect('main');
        }
        $cant = $this->contarfuncion('create');
        $client = new Client;
        $user = new User;
        return view('clients.create',compact('client','user','cant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    
    public function requiretypes(Request $request)
    {
        $this->validate($request, [
        'username' => 'required',
        'email' => 'required',
        'name'=>'required',
        'number' => 'required',
        'password' => 'required',
        'nit' => 'required',
        'address' => 'required'
        ]);
    }

    public function trash()
    {
        if(!$this->islogged() || !$this->tienepermiso(2,1))
        {
            return redirect('main');
        }
        $clients = Client::intrash();
        $cant = $this->contarfuncion('trash');
        return view('clients.trash', compact('clients','cant'));
    }

    public function restore($id)
    {
        if(!$this->islogged() || !$this->tienepermiso(2,1))
        {
            return redirect('main');
        }
        $client = Client::withTrashed()->find($id);
        $client->restore();
        User::withTrashed()->find($client->user_id)->restore();
        return redirect('clients/trash');
    }

    public function store(Request $request)
    {
        if(!$this->islogged() || !$this->tienepermiso(1,1))
        {
            return redirect('main');
        }
        $requestData = $request->all();
        $this->requiretypes($request);
        if(!User::isusernameunique($requestData['username']))
        {

                return redirect()->back()->withErrors(array('username' => 'Nombre de usuario ya existe. Ingrese otro porfavor')); 
        }

        $user = new User;
        $user->username = $requestData['username'];
        $user->password = $requestData['password']; 
        $user->email = $requestData['email']; 
        $user->save();
        $client = new Client;
        $client->name = $requestData['name'];
        $client->nit = $requestData['nit'];
        $client->number = $requestData['number'];
        $client->address = $requestData['address'];
        $client->user_id = $user->id;
        $client->save();

        Session::flash('flash_message', 'Client added!');

        return redirect('clients/index/index');
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
        if(!$this->islogged() || !$this->tienepermiso(3,1))
        {
            return redirect('main');
        }
        $client = Client::findOrFail($id);
        $user = User::findOrFail($client->user_id);
        return view('clients.show', compact('client','user'));
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
        if(!$this->islogged() || !$this->tienepermiso(4,1))
        {
            return redirect('main');
        }
        $cant = $this->contarfuncion('edit');
        $client = Client::findOrFail($id);
        $user = User::findOrFail($client->user_id);

        return view('clients.edit', compact('client','user','cant'));
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
        if(!$this->islogged() || !$this->tienepermiso(4,1))
        {
            return redirect('main');
        }
        $requestData = $request->all();
        $this->requiretypes($request);
        $client = Client::findOrFail($id);
        $user = User::findOrFail($client->user_id);
        if(!$user->ismyusername($requestData['username']) && !User::isusernameunique($request['username']))
        {
                return redirect()->back()->withErrors(array('username' => 'Nombre de usuario ya existe. Ingrese otro porfavor')); 
        }
        $client->update($requestData);
        $user->update($requestData);

        Session::flash('flash_message', 'Client updated!');

        return redirect('clients/index/indexedit');
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
        if(!$this->islogged() || !$this->tienepermiso(5,1))
        {
            return redirect('main');
        }
        $client = Client::findOrFail($id);
        $client->user->delete();
        $client->delete();

        Session::flash('flash_message', 'Client deleted!');

        return Redirect::back();
    }
}
