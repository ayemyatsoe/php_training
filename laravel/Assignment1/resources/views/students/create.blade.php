@extends('students.layout')

@section('content')

<div class="row mt-3">
    <div class="col-md-8">
        <div class="float-left">
            <h2>Add New Student</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="float-right">
            <a class="btn btn-outline-primary" href="{{ route('student.index') }}">Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('student.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label">Name</label>
        <input type="name" name="name" class="form-control" placeholder="Enter Student Name">
    </div>

    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter Student Email">
    </div>
    <div class="form-group">
        <label class="form-label">Choose Major</label>
                    <select class="form-select" name="major_id">
                        <option value="">Choose Major</option>
                        @foreach ($majors as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
    </div>
    <div class="form-group">
        <label class="form-label">Date Of Birth</label>
        <input type="date" name="dob" class="form-control" placeholder="Enter Student Birth Date">
    </div>
    <div class="form-group">
        <label class="form-label">Address</label>
        <input type="address" name="address" class="form-control" placeholder="Enter Student Address">
    </div>
    <div class="form-group">
        <label class="form-label">Phone</label>
        <input type="integer" name="phone" class="form-control" placeholder="Enter Student Phone">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection

