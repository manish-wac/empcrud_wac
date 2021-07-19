@include('admin.header');
@extends('designations.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Designations</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('designations.create') }}"> Create New Designation</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table id="d_table" class="display table table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        @foreach ($designations ?? '' as $designation)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $designation->name }}</td>
                <td>{{ $designation->detail }}</td>
                <td>
                    <form action="{{ route('designations.destroy',$designation->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('designations.show',$designation->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('designations.edit',$designation->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $designations ?? ''->links() !!}

@endsection
@include('admin.footer');
