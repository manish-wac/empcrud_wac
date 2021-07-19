@include('admin.header');
@extends('employees.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $employee->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $employee->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                {{ $employee->address }}
            </div>
        </div>
        <?php
        $dept_show=$departments->find($employee->dept_id);
        ?>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Department:</strong>
                {{isset($dept_show['name'])?$dept_show['name']:""}}
            </div>
        </div>
        <?php
        $design_show=$designations->find($employee->dept_id);
        ?>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Designation:</strong>
                {{isset( $design_show['name'])? $design_show['name']:""}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Photo:</strong>
{{--                <img src="{{ asset($employee->photo) }}" width="50" height="50">--}}
                <img src="{{url('/photo/')}}/{{$employee->photo}}" width="50" height="50">
            </div>
        </div>
    </div>
@endsection
@include('admin.footer');
