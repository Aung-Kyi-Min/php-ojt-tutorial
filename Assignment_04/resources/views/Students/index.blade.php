@extends('layouts.app')

@section('content')
    <div class="container mt-3 w-75">
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">Create</a>
        <span id="successMsg"></span>
        <div class="card mt-4">
            <div class="card-header">
                <h4>Students Lists</h4>
            </div>
            <div class="card-body">
                <table class="table table-strip">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Major</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </thead>
                    <tbody id="tablebody">
                        @foreach ($students as $student)
                            <tr>
                                <input type="hidden" class="serdelete_val_id " value="{{ $student->id }}">
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td> {{ $student->major->name }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->address }}</td>
                                <td class="">
                                    <a href="{{ route('students.edit', $student->id) }}" class=" btn btn-success btn-sm">
                                        Edit
                                    </a>
                                    <a href="#" onclick="deleteData({{ $student->id }})"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-block">
                    {{  $students->appends(request()->input())->links('layouts.paginationlinks') }}
                </div>
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

    <script>
        function deleteData(id) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete('/students/' + id + '/destroy')
                            .then((response) => {
                                location.reload();
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    }
                });
        }
    </script>
@endsection
