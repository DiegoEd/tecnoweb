<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customize;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image as Image;

class CustomizesController extends Controller
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
            $customizes = Customize::where('theme', 'LIKE', "%$keyword%")
				->orWhere('imagepath', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $customizes = Customize::paginate($perPage);
        }

        return view('customizes.index', compact('customizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customizes = new Customize;
        return view('customizes.create', compact('customizes'));
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
        $fileName = $this->postNewImage($request);
        
        $requestData = $request->all();
        $requestData['imagepath'] = $fileName;
        
        Customize::create($requestData);

        Session::flash('flash_message', 'Customize added!');

        return redirect('customizes');
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
        $customize = Customize::findOrFail($id);

        return view('customizes.show', compact('customize'));
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
        $customizes = Customize::findOrFail($id);

        return view('customizes.edit', compact('customizes'));
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
        if (empty($requestData['imagepath'])) {
            $requestData['imagepath'] = $requestData['filename'];
        } else {
            $fileName = $this->postNewImage($request);
            $requestData['imagepath'] = $fileName;
            unlink('img/users/'. $requestData['filename']);
        }

        $customizes = Customize::findOrFail($id);
        $customizes->update($requestData);

        Session::flash('flash_message', 'Customize updated!');

        return redirect('customizes');
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
        Customize::destroy($id);

        Session::flash('flash_message', 'Customize deleted!');

        return redirect('customizes');
    }

    public function postNewImage(Request $request)
    {
        $this->validate($request, ['imagepath' => 'required|image']);
        $fileName = $request->file('imagepath')->getClientOriginalName();
        Image::make($request->file('imagepath'))->resize(144, 144)->save('img/users/'. $fileName);

        return $fileName;
    }
}
