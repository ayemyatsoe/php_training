@extends('students.layout')

@section('content')

<div class="row mt-3">
    <div class="col-md-8">
        <div class="float-left">
            <h2>Students List</h2>
        </div>
    </div>

    <div class="col-md-6 offset-3 mb-5">
        <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
        <a class="btn btn-warning" href="{{ route('importExportView') }}">Import User Data</a>
        <div class="float-right">
            <a class="btn btn-outline-success" href="{{ route('student.create') }}"> Create New student</a>
        </div>
    </div>
</div>
<div class="col-md-8 mb-3">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="search" placeholder="Search Name" required/>
        <button type="submit">Search</button>
      </form>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

 @if(session()->has('create-message'))
              <div class="alert alert-success">
                  {{ session()->get('create-message') }}
              </div>
@endif

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>DOB</th>
            <th>Major</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $student)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->dob }}</td>
            <td>{{ $student->major->name }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->phone }}</td>
            <td>
                <form action="{{ route('student.destroy',$student->id) }}" method="POST">
                    <a class="btn btn-outline-info btn-sm" href="{{ route('student.show',$student->id) }}">Show</a>
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('student.edit',$student->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

@endsection
