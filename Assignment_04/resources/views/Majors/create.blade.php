@extends('layouts.app')

@section('content')
    <div class="container mt-3 w-75">
        <div class="card">
            <div class="card-header">
                <h4>Majors Create</h4>
            </div>
            <div class="card-body">
                <form name="myform" method="post">
                    @csrf
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="name">
                    <span id="nameError"></span>
                    <div class="mt-3">
                        <a href="{{ route('majors.index') }}" type="submit" class="btn btn-secondary btn-sm">Back</a>
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
        myForm.onsubmit = function(e) {
            e.preventDefault();

            console.log(nameInput.value);

            axios.post('/majors/store', {
                    name: nameInput.value,
                })
                .then(response => {
                    $nameError = document.getElementById('nameError');
                    console.log(response);
                    console.log(response.data.msg);
                    if (response.data.msg == 'Created Successfully...') {
                        swal("Message", response.data.msg, 'success', {
                            button: true,
                            button: "Ok",
                        });
                        console.log(response.data);
                        myForm.reset();
                        $nameError.innerHTML = '';
                    }

                })
                .catch(error => {
                    console.log(error.response);
                    if (error.response.status === 422) {
                        $nameError = document.getElementById('nameError');
                        $nameInput = document.getElementById('name');
                        $nameError.innerHTML = $nameInput.value == '' ?
                            '<i class="text-danger">' + error.response.data.errors.name + '</i>' : '';
                    }

                });
        }
    </script>
@endsection
