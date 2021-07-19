@include('admin.header');
@extends('employees.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employees.create') }}"> Create New Employee</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

{{--    <table class="table table-bordered" id="d_table">--}}
        <table id="d_table" class="display table table-bordered" style="width:100%">
            <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Department</th>
            <th>Designation</th>
            <th width="280px">Action</th>
        </tr>
            </thead>
        @foreach ($employees ?? '' as $employee)

            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $employee['name'] }}</td>
                <td>{{ $employee['email'] }}</td>
                <td>{{ $employee['address'] }}</td>
                <?php
                $dept_show=$departments->find($employee->dept_id);
                ?>
                <td>{{isset($dept_show['name'])?$dept_show['name']:""}}</td>
                <?php
                $design_show=$designations->find($employee->design_id);
                ?>
                <td>{{isset( $design_show['name'])? $design_show['name']:""}}</td>
                <td>
                    <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('employees.show',$employee->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>

                    </form>
                </td>
            </tr>
        @endforeach
    </table>




@endsection
@include('admin.footer');
