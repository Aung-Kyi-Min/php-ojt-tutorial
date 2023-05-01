@extends('layouts.app')

@section('content')
    <div class="container mt-3 w-75">
        <a href="{{ route('majors.create') }}" class="btn btn-primary btn-sm">Create</a>
        <div class="card mt-4">
            <div class="card-header">
                <h4>Majors Lists</h4>
            </div>
            <div class="card-body">
                <table class="table table-strip text-center">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($major as $major)
                            <tr>
                                <input type="hidden" class="serdelete_val_id " value="{{ $major->id }}">
                                <td>{{ $major->id }}</td>
                                <td>{{ $major->name }}</td>
                                <td class="">
                                    <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>
                                    <a href="#" onclick="deleteData({{ $major->id }})"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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


    @if (Session::has('message'))
        <script>
            swal("Message", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "Ok",
            });
        </script>
    @endif

    <script></script>

    <script>
        function deleteData(id) {
            console.log(id);
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete('/majors/' + id + '/destroy')
                            .then((response) => {
                                location.reload();
                                console.log(response);
                            })
                            .catch((error) => {
                                console.log(error);
                                console.log(response);
                            });
                    }
                });
        }
    </script>
@endsection
