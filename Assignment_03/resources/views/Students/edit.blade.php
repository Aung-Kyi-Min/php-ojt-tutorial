@extends('layouts.app')

@section('content')
    <div class="container mt-3 w-75">
        <div class="card ">
            <div class="card-header">
                <h4>Student Edit</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('students.update', $student->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $student->name) }} "
                            class="form-control @error('name') is invalid @enderror">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Major</label>
                        <select name="majors" class="form-select @error('majors') is-invalid @enderror">
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}"
                                    {{ old('majors', $student->majors) == $major->id ? 'selected' : '' }}>
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
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone) }}"
                            class="form-control @error('phone') is invalid @enderror">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}"
                            class="form-control @error('email') is invalid @enderror">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Address</label>
                        <textarea name="address" id="address" rows="3" value="{{ old('address', $student->address) }}"
                            class="form-control @error('address') is invalid @enderror">
                    {{ $student->address }}
                </textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        <button type="submit" class="btn btn-primary btn-sm float-end">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
