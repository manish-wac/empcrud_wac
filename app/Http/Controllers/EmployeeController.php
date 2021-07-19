<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
        $employees = Employee::latest()->paginate(5);
        $departments = Department::all();
        $designations = Designation::all();

        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('departments', $departments)
            ->with('designations', $designations);
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
        $departments = Department::all();
        $designations = Designation::all();
        return view('employees.create')->with('departments', $departments)
            ->with('designations', $designations);
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
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'photo' => 'required',
            'dept_id' => 'required',
            'design_id' => 'required',
        ]);


        $input = $request->all();

//        print_r($input);
//        exit;

        if ($image = $request->file('photo')) {
            $destinationPath = 'photo/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['photo'] = "$profileImage";
        }

        Employee::create($input);

        $this->send_email($input['email']);


        return redirect()->route('employees.index')
            ->with('success','Employee created successfully.');
    }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        if(Auth::check()){
        $departments = Department::all();
            $designations = Designation::all();
        return view('employees.show',compact('employee'))
            ->with('departments', $departments)
            ->with('designations', $designations);
        }

        return redirect("login")->withSuccess('Opps! You do not have access');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        if(Auth::check()){
        $departments = Department::all();
        $designations = Designation::all();
        return view('employees.edit',compact('employee'))
            ->with('departments', $departments)
            ->with('designations', $designations);
        }

        return redirect("login")->withSuccess('Opps! You do not have access');

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        if(Auth::check()){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success','Employee updated successfully');
    }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if(Auth::check()){
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success','Employee deleted successfully');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function send_email($email)
    {
        $product_email=$email;
        $details = [
            'title' => 'Mail from EmpCRUD',
            'body' => 'Login access using    '.$product_email,
        ];

//        dd($product_email);

        \Mail::to($product_email)->send(new \App\Mail\MyTestMail($details));

        return redirect()->route('employees.index')
            ->with('success','Employee created and emailed successfully');
    }



}
