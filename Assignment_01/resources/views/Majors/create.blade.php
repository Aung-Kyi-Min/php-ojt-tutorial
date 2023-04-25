@extends('layouts.app')

@section('content')

<div class="container mt-3 w-75">
  <div class="card">
    <div class="card-header">
      <h4>Majors Create</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('majors.store') }}" method="post">
        @csrf
        <label for="">Name</label>
        <input type="text" value="{{old('name')}}" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="name">
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="mt-3">
          <a href="{{ route('majors.index') }}" type="submit" class="btn btn-secondary btn-sm">Back</a>
          <button type="submit" class="btn btn-primary btn-sm float-end">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
