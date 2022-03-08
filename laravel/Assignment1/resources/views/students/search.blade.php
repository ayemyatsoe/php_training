@extends('students.layout')

@section('content')
<form action="{{ route('date') }}" method="GET">
    <input type="date" name="start_date" class="" placeholder="Enter Start Date">
    <input type="date" name="start_date" class="" placeholder="Enter Start Date">
  <button type="submit">Search</button>
</form>

@endsection
