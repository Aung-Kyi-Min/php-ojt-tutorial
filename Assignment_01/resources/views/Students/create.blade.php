@extends('layouts.app')

@section('content')
    <div class="container mt-3 w-75">
        <div class="card ">
            <div class="card-header">
                <h4>Student Create</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('students.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror " placeholder="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Major</label>
                        <select name="majors" class="form-select @error('majors') is-invalid @enderror">
                            @foreach ($majors as $major)
                                <option {{ old('majors', $major->majors) == $major->id ? 'selected' : '' }}
                                    value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                        @error('majors')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" value="{{ old('phone') }}" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror" placeholder="phone">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror " placeholder="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" form-outline mb-3">
                        <label for="">Address</label>
                        <textarea name="address"  id="address" rows="3"
                            class="form-control @error('address') is-invalid @enderror " placeholder="address">
                            {{ old('address') }}
                        </textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        <button type="submit" class="btn btn-primary btn-sm float-end">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
