<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
        $departments = Department::latest()->paginate(5);

        return view('departments.index',compact('departments'))
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
        return view('departments.create');
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

        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success','Department created successfully.');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        if(Auth::check()){
        return view('departments.show',compact('department'));
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        if(Auth::check()){
        return view('departments.edit',compact('department'));
    }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        if(Auth::check()){
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success','Department updated successfully');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if(Auth::check()){
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success','Department deleted successfully');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }
}
