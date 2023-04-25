@extends('layouts.app')

@section('content')
    <div class="card w-75 mx-auto mt-5">
        <div class="card-header">
            <h4>New Task</h4>
        </div>
        <div class="card-body ">
            @include('common.errors')
            <form action="{{ route('tasks.store') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="task" class="mb-3 control-label">Task</label>

                    <div class="">
                        <input type="text" name="name" id="task-name" class="mb-3 form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="">
                        <button type="submit" class="btn btn-default border">
                            <i class="fa fa-plus"></i> Add Task
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if (count($tasks) > 0)
        <div class="card w-75 mx-auto mt-5">
            <div class="card-header ">
                <h4>Current Tasks</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="table-text">
                                    <input type="hidden" class="serdelete_val_id " value="{{ $task->id }}">
                                    <div>{{ $task->name }}</div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm service_deletebtn">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.6.3.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>

    @if (Session::has('message'))
        <script>
            swal("Message", "{{ Session::get('message') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
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
                                url: "/tasks.destroy/" + delete_id,
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
