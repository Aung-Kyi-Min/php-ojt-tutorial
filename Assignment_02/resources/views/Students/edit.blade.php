@extends('layouts.app')

@section('content')

<div class="container mt-3 w-75">
    <div class="card ">
      <div class="card-header">
        <h4>Student Create</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('students.update', $student->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">Name</label>
                <input type="text" name="name" id="name" value="{{ $student->name }}" class="form-control @error('name') is invalid @enderror">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Major</label>
                <select name="majors" class="form-select @error('majors') is-invalid @enderror">
                    @foreach ($majors as $major)
                        <option  {{ (old("majors", $major->majors) == $major->id ? "selected" : "") }}
                            value="{{ $major->id }}"
                            {{ $major->id == $student->majors ? 'selected' : '' }}>
                            {{ $major->name }}
                        </option>
                    @endforeach
                </select>
                @error('majors')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Phone</label>
                <input type="text"  name="phone" id="phone" value="{{ $student->phone }}" class="form-control @error('phone') is invalid @enderror">
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" name="email" id="email" value="{{ $student->email }}" class="form-control @error('email') is invalid @enderror">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Address</label>
                <textarea name="address" id="address" rows="3" value="{{ $student->name }}" class="form-control @error('address') is invalid @enderror">
                    {{ $student->address }}
                </textarea>
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <a href="{{route('students.index')}}" class="btn btn-secondary btn-sm">Back</a>
                <button type="submit" class="btn btn-primary btn-sm float-end">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection
