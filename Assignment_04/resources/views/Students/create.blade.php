@extends('layouts.app')

@section('content')
    <div class="container mt-3 w-75">
        <span id="successMsg"></span>
        <div class="card ">
            <div class="card-header">
                <h4>Student Create</h4>
            </div>
            <div class="card-body">
                <form name="myform" method="post">

                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" value="" class="form-control "
                            placeholder="name">
                        <span id="nameError"></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Major</label>
                        <select name="majors" class="form-select">
                            @foreach ($majors as $major)
                                <option {{ old('majors', $major->majors) == $major->id ? 'selected' : '' }}
                                    value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                        <span id="majorError"></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" value="{{ old('phone') }}" name="phone" id="phone" class="form-control"
                            placeholder="phone">
                        <span id="phoneError"></span>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" id="email"
                            class="form-control " placeholder="email">
                        <span id="emailError"></span>
                    </div>
                    <div class=" form-outline mb-3">
                        <label for="">Address</label>
                        <textarea name="address" value="{{ old('address') }}" id="address" rows="3" class="form-control "
                            placeholder="address">
                </textarea>
                        <span id="addressError"></span>
                    </div>
                    <div class=" mb-3">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary btn-sm">Back</a>
                        <button type="submit" class="btn btn-primary btn-sm float-end">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.3.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>

    <!-- axios cdn link -->
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>




    <script>
        // CREATE

        var myForm = document.forms['myform'];
        var nameInput = myForm['name'];
        var majorsInput = myForm['majors'];
        var phoneInput = myForm['phone'];
        var emailInput = myForm['email'];
        var addressInput = myForm['address'];

        myForm.onsubmit = function(e) {
            e.preventDefault();

            console.log(nameInput.value);

            axios.post('/students/store', {
                    name: nameInput.value,
                    majors: majorsInput.value,
                    phone: phoneInput.value,
                    email: emailInput.value,
                    address: addressInput.value,
                })
                .then(response => {
                    console.log(response);
                    console.log(response.data.msg);
                    if (response.data.msg == 'Created Successfully...') {
                        swal("Message", response.data.msg, 'success', {
                            button: true,
                            button: "Ok",
                        });
                        console.log(response.data);
                        myForm.reset();
                        $nameError.innerHTML = $majorsError.innerHTML =
                            $phoneError.innerHTML = $emailError.innerHTML =
                            $addressError.innerHTML = '';
                    }
                    if(response.data.message== 'The given data was invalid.'){
                        $emailError = document.getElementById('emailError');
                        $emailError.innerHTML = '<i class="text-danger">' + response.data.errors.email + '</i>' ;
                    }
                })
                .catch(error => {
                    console.log(error.response);
                    if (error.response.status === 422) {

                        $nameError = document.getElementById('nameError');
                        $majorsError = document.getElementById('majorsError');
                        $phoneError = document.getElementById('phoneError');
                        $emailError = document.getElementById('emailError');
                        $addressError = document.getElementById('addressError');
                        $nameInput = document.getElementById('name');
                        $phoneInput = document.getElementById('phone');
                        $emailInput = document.getElementById('email');
                        $addressInput = document.getElementById('address');
                        $nameError.innerHTML = $nameInput.value == '' ?
                            '<i class="text-danger">' + error.response.data.errors.name + '</i>' : '';
                        $phoneError.innerHTML = phoneInput.value == '' ?
                            '<i class="text-danger">' + error.response.data.errors.phone + '</i>' : '';
                        $emailError.innerHTML = emailInput.value == '' ?
                            '<i class="text-danger">' + error.response.data.errors.email + '</i>' : '';
                        $addressError.innerHTML = addressInput.value == '' ?
                            '<i class="text-danger">' + error.response.data.errors.address + '</i>' : '';

                    }
                });
        }
    </script>
@endsection
