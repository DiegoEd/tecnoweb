<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use App\Employee;
use Illuminate\Http\Request;
use Session;

class EmployeesController extends Controller
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
            $employees = Employee::where('name', 'LIKE', "%$keyword%")
				->orWhere('lastname', 'LIKE', "%$keyword%")
				->orWhere('sex', 'LIKE', "%$keyword%")
				->orWhere('age', 'LIKE', "%$keyword%")
				->orWhere('career', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $employees = Employee::paginate($perPage);
        }

        return view('employees.index', compact('employees'));
    }

    public function trash()
    {
        $employees = Employee::intrash();
        return view('employees.trash', compact('employees'));
    }

    public function restore($id)
    {
        $employee = Employee::withTrashed()->find($id);
        $employee->restore();
        User::withTrashed()->find($employee->user_id)->restore();
        return redirect('employees');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $employees = new Employee;
        $user = new User;
        return view('employees.create', compact('employees', 'user'));
    }

    public function validatefields(Request $request)
    {
        $this->validate($request, [
        'username' => 'required|unique:users'
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
        $this->validatefields($request);
        $requestData = $request->all();
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

        return redirect('employees');
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
        $employees = Employee::findOrFail($id);
        $user = User::findOrFail($employees->user_id);

        return view('employees.edit', compact('employees', 'user'));
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
        $this->validatefields($request);
        $requestData = $request->all();
        
        $employees = Employee::findOrFail($id);
        $user = User::findOrFail($employees->user_id);
        $employees->update($requestData);
        $user->update($requestData);

        Session::flash('flash_message', 'Employee updated!');

        return redirect('employees');
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
        $employee = Employee::findOrFail($id);
        $employee->user->delete();
        $employee->delete();

        Session::flash('flash_message', 'Employee deleted!');

        return redirect('employees');
    }
}
