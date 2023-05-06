@extends('layouts.app')

@section('content')

    <div class="container mt-3 w-75">
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">Create</a>
        <div class="float-end ">
            <a href="{{ route('export.students') }}" class="btn btn-primary btn-sm">Export</a>
            <a href="{{ route('import-view') }}" class="btn btn-primary btn-sm">Import</a>
        </div>
        <div class="card mt-4">
            <div class="card-header">
                <h4>Students Lists
                    <form action="{{ route('students.search') }}" class="float-end">
                        @csrf
                        <div class="input-group">
                            <input type="search" name="search" id="search" value="{{ old('search') }}"
                                class="form-control rounded" placeholder="Search" aria-label="Search"
                                aria-describedby="search-addon" />
                            <button type="submit" class="btn btn-outline-primary">search</button>
                        </div>
                    </form>
                </h4>
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
                    <tbody>

                        @if (count($results) > 0)
                            @foreach ($results as $student)
                                <tr>
                                    <input type="hidden" class="serdelete_val_id " value="{{ $student->id }}">
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td> {{ $student->major }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->address }}</td>
                                    <td class="">
                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class=" btn btn-success btn-sm">
                                            Edit
                                        </a>
                                        <button type="button"
                                            class="btn btn-danger btn-sm service_deletebtn">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                <div class="pagination-block">
                    {{ $results->appends(request()->input())->links('layouts.paginationlinks') }}
                </div>
            @else
                <p>No results found.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.3.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>

    @if (Session::has('message'))
        <script>
            swal("Message", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "Ok",
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.service_deletebtn').click(function(e) {
                e.preventDefault();
                var delete_id = $(this).closest("tr").find(".serdelete_val_id").val();
                console.log(delete_id);
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var data = {
                                "_token": $('input[name=_token]').val(),
                                "id": delete_id,
                            };
                            $.ajax({
                                type: 'DELETE',
                                url: "students/" + delete_id,
                                data: 'data',
                                success: function(response) {
                                    swal(response.status, {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });
        });
    </script>

@endsection
