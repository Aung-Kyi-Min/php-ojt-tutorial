@extends('layouts.app')

@section('content')
    <div class="container mt-3 w-75">
        <div class="card">
            <div class="card-header">
                <h4>Majors Edit</h4>
            </div>
            <div class="card-body">
                <form name="editForm" method="post">
                    <input type="hidden" name="update_id" id="update_id" value="{{ $major->id }}">
                    <label for="">Name</label>
                    <input type="text" value="{{ old('name', $major->name) }}" name="name" id="name"
                        class="form-control @error('name') is invalid @enderror" placeholder="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="mt-3">
                        <a href="{{ route('majors.index') }}" type="submit" class="btn btn-secondary btn-sm">Back</a>
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

        editForm.onsubmit = function(e) {
            e.preventDefault();
            console.log(IdToUpdate);

            axios.put('/majors/' + IdToUpdate + "/update", {
                    name: nameInput.value,
                })
                .then(response => {
                    swal("Message", response.data.msg, 'success', {
                        button: true,
                        button: "Ok",
                    });
                    console.log(response);
                    console.log(response.data.msg);
                    alertMsg(response.data.msg);
                })
                .catch(error => console.log(error));

        }
    </script>
@endsection
