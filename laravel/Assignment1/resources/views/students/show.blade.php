@extends('students.layout')
@section('content')
<div class="row mt-3">
    <div class="col-md-8">
        <div class="float-left">
            <h2>Student Details</h2>
        </div>
    </div>
<div class="col-md-4">
        <div class="float-right">
            <a class="btn btn-outline-primary" href="{{ route('student.index') }}">Back</a>
        </div>
    </div>
</div>

<hr>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $student->name }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <strong>Address:</strong>
            {{ $student->address }}
        </div>
    </div>
</div>
@endsection
