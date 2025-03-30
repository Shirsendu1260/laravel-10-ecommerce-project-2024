{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Static Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_static_pages') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            <form id="staticPageEditForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{ $static_page->name }}">
                                    <p class="error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Slug" value="{{ $static_page->slug }}" readonly>
                                    <p class="error"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" rows="30" class="summernote" placeholder="Content">{{ $static_page->content }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select class="custom-select" name="status" id="status">
                                        <option value="1" {{ $static_page->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $static_page->status == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <button type="reset" class="btn btn-outline-dark ml-3">Reset</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $(".summernote").summernote({
            height: 375,
        });
    </script>

    <script>
        $('#name').on('input', function() {
            var data = $(this).val().toLowerCase().replace(/[^a-z0-9\s]/gi, "").replace(
                    /^\s+|\s+$|\s+(?=\s)/g, "")
                .replace(/[_\s]/g, "-");
            $('#slug').val(data);
        });

        $('#staticPageEditForm').submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_update_static_page', $static_page->id) }}",
                type: 'put',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $(".error").prev().removeClass('is-invalid');
                        $(".error").removeClass('invalid-feedback').html('');

                        window.location.href = "{{ route('admin_view_static_pages') }}";
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        var errors = response['msg'];

                        $(".error").prev().removeClass('is-invalid');
                        $(".error").removeClass('invalid-feedback').html('');

                        $.each(errors, function(key, value) {
                            $(`#${key}`).addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(`${value}`);
                        });
                    }
                },
                error: function(jqXHR, exception) {
                    alert('Error occured!');
                },
            });
        });
    </script>
@endsection
