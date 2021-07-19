<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
        $designations = Designation::latest()->paginate(5);

        return view('designations.index',compact('designations'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
        return view('designations.create');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Designation::create($request->all());

        return redirect()->route('designations.index')
            ->with('success','Designation created successfully.');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        if(Auth::check()){
        return view('designations.show',compact('designation'));
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        if(Auth::check()){
        return view('designations.edit',compact('designation'));
    }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        if(Auth::check()){
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $designation->update($request->all());

        return redirect()->route('designations.index')
            ->with('success','Designation updated successfully');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        if(Auth::check()){
        $designation->delete();

        return redirect()->route('designations.index')
            ->with('success','Designation deleted successfully');
    }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }
}
