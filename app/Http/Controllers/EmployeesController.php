<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\User;

use App\Employee;
use App\CounterPage;
use Illuminate\Http\Request;
use Session;

class EmployeesController extends Controller
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
        $cant = $this->contarindex($accion);        
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $employees = Employee::where('name', 'LIKE', "%$keyword%")
				->orWhere('lastname', 'LIKE', "%$keyword%")
				->orWhere('sex', 'LIKE', "%$keyword%")
				->orWhere('age', 'LIKE', "%$keyword%")
				->orWhere('career', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $employees = Employee::paginate($perPage);
        }
        return view('employees.'.$accion, compact('employees','cant'));
    }

    public function contarindex($accion)
    {
        $cant = 0;
        $accions = CounterPage::where('pageroute','/employees/index/'.$accion)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;
    }

    public function contarfuncion($funcion)
    {

        $rutinga = '/employees/'.$funcion;
        $accions = CounterPage::where('pageroute',$rutinga)->get();
        $accion = $accions->first();
        $cant = $accion->visitcount;
        $cant++;
        $accion->visitcount = $cant;
        $accion->save();
        return $cant;

    }

    public function trash()
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $employees = Employee::intrash();
        $cant = $this->contarfuncion('trash');
        return view('employees.trash', compact('employees','cant'));
    }

    public function restore($id)
    {
        if(!$this->islogged())
        {
            return redirect('main');
        }
        $employee = Employee::withTrashed()->find($id);
        $employee->restore();
        User::withTrashed()->find($employee->user_id)->restore();
        return redirect('employees/trash');
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
        $employees = new Employee;
        $user = new User;
        $cant = $this->contarfuncion('create');
        return view('employees.create', compact('employees', 'user','cant'));
    }

    public function requiretypes(Request $request)
    {
        $this->validate($request, [
        'username' => 'required',
        'email' => 'required',
        'name'=>'required',
        'lastname' => 'required',
        'password' => 'required',
        'sex' => 'required',
        'age' => 'required',
        'career' => 'required',
        ]);
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
        $employee = new Employee;
        $employee->name = $requestData['name'];
        $employee->lastname = $requestData['lastname'];
        $employee->sex = $requestData['sex'];
        $employee->age = $requestData['age'];
        $employee->career = $requestData['career'];
        $employee->user_id = $user->id;
        $employee->save();

        Session::flash('flash_message', 'Employee added!');
        return redirect('employees/index/index');
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
        $employees = Employee::findOrFail($id);
        $user = User::findOrFail($employees->user_id);

        return view('employees.show', compact('employees', 'user'));
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
        $cant = $this->contarfuncion('edit');        
        $employees = Employee::findOrFail($id);
        $user = User::findOrFail($employees->user_id);

        return view('employees.edit', compact('employees', 'user','cant'));
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
        $this->requiretypes($request);
        $employees = Employee::findOrFail($id);
        $user = User::findOrFail($employees->user_id);
        if(!$user->ismyusername($requestData['username']) && !User::isusernameunique($request['username']))
        {
                return redirect()->back()->withErrors(array('username' => 'Nombre de usuario ya existe. Ingrese otro porfavor')); 
        }
        $employees->update($requestData);
        $user->update($requestData);

        Session::flash('flash_message', 'Employee updated!');
        return redirect('employees/index/indexedit');
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
        $employee = Employee::findOrFail($id);
        $employee->user->delete();
        $employee->delete();

        Session::flash('flash_message', 'Employee deleted!');

        return Redirect::back();
    }
}
