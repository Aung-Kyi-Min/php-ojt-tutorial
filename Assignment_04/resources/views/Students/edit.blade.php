@extends('layouts.app')

@section('content')
    <div class="container mt-3 w-75">
        <div class="card ">
            <div class="card-header">
                <h4>Student Edit</h4>
            </div>
            <div class="card-body">
                <form name="editForm" method="post">


                    <div class="mb-3">
                        <input type="hidden" name="update_id" id="update_id" value="{{ $student->id }}">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}"
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

    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/jquery-3.6.3.min.js"></script>
    <script src="../../js/sweetalert.min.js"></script>

    <!-- axios cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>



    <script>
        //UPDATE

        var editForm = document.forms['editForm'];
        var IdToUpdate = document.getElementById('update_id').value;
        var nameInput = editForm['name'];
        var majorsInput = editForm['majors'];
        var phoneInput = editForm['phone'];
        var emailInput = editForm['email'];
        var addressInput = editForm['address'];

        editForm.onsubmit = function(e) {
            e.preventDefault();
            console.log(IdToUpdate);

            axios.put('/students/' + IdToUpdate + "/update", {
                    name: nameInput.value,
                    majors: majorsInput.value,
                    phone: phoneInput.value,
                    email: emailInput.value,
                    address: addressInput.value,
                })
                .then(response => {
                    swal("Message", response.data.msg, 'success', {
                        button: true,
                        button: "Ok",
                    });
                    console.log(response);
                    console.log(response.data.msg);
                })
                .catch(error => console.log(error));

        }
    </script>
@endsection
