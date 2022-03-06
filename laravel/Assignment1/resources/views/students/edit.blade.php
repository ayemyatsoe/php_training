@extends('students.layout')

@section('content')

<div class="row mt-3">
    <div class="col-md-8">
        <div class="float-left">
            <h2>Edit Student</h2>
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
{{--{{ route('student.update',$item->id) }}--}}
<form action="{{ route('student.update',$student->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $student->name }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $student->email }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Choose Major</label>
        <select class="form-select" name="major_id">
            <option value="">Choose Major</option>
            @foreach ($majors as $key => $value)
                @if ($student->major_id == $key)
                    <option value="{{ $key }}" selected>
                        {{ $value }}
                    </option>
                @else
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Date Of Birth</label>
        <input type="date" name="dob" class="form-control" value="{{ $student->dob }}">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" id="address" name="address" placeholder="Address">{{ $student->address }}</textarea>

    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="integer" name="phone" class="form-control" value="{{ $student->phone }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
