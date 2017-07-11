<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Client;
use App\Employee;
use App\Customize;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->session()->has('id')) {

            return redirect('clients');
        }
        return view('session.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $users = User::where('email', 'LIKE', $requestData['email'])->where('password', 'LIKE', $requestData['password'])->get();
        if (count($users) > 0) {
            $user = $users->first();
            $customizes = Customize::where('user_id', '=', $user->id);
            $customize = $customizes->first();

            $clients = Client::where('user_id', '=', $user->id);
            $client = $clients->first();

            $employees = Employee::where('user_id', '=', $user->id);
            $employee = $employees->first();

            $request->session()->put('id', $user->id);
            $request->session()->put('username', $user->username);
            if (is_null($customize)) {
                $customize_id = '';
                $theme = '';
                $imagepath = '';
            } else {
                $customize_id = $customize->id;
                $theme = $customize->theme;
                $imagepath = $customize->imagepath;
            }
            $request->session()->put('customize_id', $customize_id);
            $request->session()->put('theme', $theme);
            $request->session()->put('imagepath', $imagepath);

            if (!is_null($client)) {
                $person_id = $client->id;
            } else if (!is_null($employee)) {
                $person_id = $employee->id;
            } else {
                $person_id = '';
            }
            $request->session()->put('person_id', $person_id);
        } else {
            return redirect()->back()->withErrors(array('username' => 'Credenciales inválidos.'));
        }
        return redirect('clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }

    public function shutdown(Request $request) {
        if ($request->session()->has('id')) {

            $request->session()->forget('id');
            $request->session()->forget('username');
            $request->session()->forget('customize_id');
            $request->session()->forget('theme');
            $request->session()->forget('imagepath');
            $request->session()->forget('person_id');
        }
        return redirect('session');
    }
}
