{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Sub Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_sub_categories') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            <form id="subCategoryEditForm">
                <div class="card">
                    <div class="card-body">
                        {{-- {{ dd($sub_category) }} --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{ $sub_category->name }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Slug" value="{{ $sub_category->slug }}" readonly>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select class="custom-select" name="status" id="status">
                                        <option {{ $sub_category->status == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $sub_category->status == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="show_on_homepage">Show On Homepage</label>
                                    <select class="custom-select" name="show_on_homepage" id="show_on_homepage">
                                        <option {{ $sub_category->show_on_homepage == 1 ? 'selected' : '' }} value="1">
                                            Yes
                                        </option>
                                        <option {{ $sub_category->show_on_homepage == 0 ? 'selected' : '' }} value="0">
                                            No
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id">Category</label>
                                    <select class="custom-select" name="category_id" id="category_id">
                                        <option value="">Select a category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                @if ($sub_category->category_id == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="">N/A</option>
                                        @endif
                                    </select>
                                    <p></p>
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
        $('#name').on('input', function() {
            var data = $(this).val().toLowerCase().replace(/[^a-z0-9\s]/gi, "").replace(
                    /^\s+|\s+$|\s+(?=\s)/g, "")
                .replace(/[_\s]/g, "-");
            $('#slug').val(data);
        });

        $('#subCategoryEditForm').submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_update_sub_category', $sub_category->id) }}",
                type: 'put',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#slug').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#category_id').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.href = "{{ route('admin_view_sub_categories') }}";
                    } else {
                        // If record was not found, redirect to category listing page
                        if (response['notFound'] == true) {
                            window.location.href = "{{ route('admin_view_sub_categories') }}";
                        }

                        $('button[type=submit]').prop('disabled', false);
                        var errors = response['msg'];

                        if (errors['name']) {
                            $('#name').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['name']);
                        } else {
                            $('#name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors['slug']) {
                            $('#slug').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['slug']);
                        } else {
                            $('#slug').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                        if (errors['category_id']) {
                            $('#category_id').addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(errors['category_id']);
                        } else {
                            $('#category_id').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert('Error occured!');
                },
            });
        });
    </script>
@endsection
