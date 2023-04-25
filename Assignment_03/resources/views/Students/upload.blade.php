@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center justify-content-center w-50 mx-auto mt-5 ">
    <div class="card w-75">
        <div class="card-header text-center">
            <h4>Import And Export Students</h4>
        </div>
        <div class="card-body">
<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-4">
        <div class="custom-file text-left">
            <input type="file" name="file" class="custom-file-input" id="customFile">
        </div>
    </div>
    <button class="btn btn-primary">Import Students</button>
    <a class="btn btn-success" href="{{ route('export.students') }}">Export Students</a>
</form>
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

@endsection()
