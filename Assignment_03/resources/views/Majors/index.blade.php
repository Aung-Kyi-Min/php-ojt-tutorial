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
                                <input type="hidden" class="serdelete_val_id " value="{{$major->id}}">
                                <td>{{ $major->id }}</td>
                                <td>{{ $major->name }}</td>
                                <td class="">
                                    <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>
                                    <button type="button"  class="btn btn-danger btn-sm service_deletebtn"
                                        >Delete</button>
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
        $('.service_deletebtn').click(function (e){
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
                        "_token" : $('input[name=_token]').val(),
                        "id" : delete_id,
                    };
                    $.ajax({
                        type: 'DELETE',
                        url: "majors.destroy/" + delete_id,
                        data: 'data',
                        success: function (response){

                            swal(response.status , {
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
