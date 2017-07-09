<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
				->orWhere('username', 'LIKE', "%$keyword%")
				->orWhere('password', 'LIKE', "%$keyword%")
				->orWhere('email', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $employees = Employee::paginate($perPage);
        }

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $employees = new Employee;
        return view('employees.create', compact('employees'));
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
        
        Employee::create($requestData);

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

        return view('employees.show', compact('employees'));
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

        return view('employees.edit', compact('employees'));
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
        
        $employees = Employee::findOrFail($id);
        $employees->update($requestData);

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
        Employee::destroy($id);

        Session::flash('flash_message', 'Employee deleted!');

        return redirect('employees');
    }
}
