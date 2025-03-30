@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible mb-4 w-100 shadow rounded">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5><i class="icon fa fa-ban"></i> Error!</h5>
        {{ Session::get('error') }}
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible mb-4 w-100 shadow rounded">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5><i class="icon fa fa-check"></i> Success!</h5>
        {{ Session::get('success') }}
    </div>
@endif
