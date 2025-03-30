{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_create_category_page') }}" class="btn btn-warning">Add New Category</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default Box -->
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button type="button" onclick="window.location.href='{{ route('admin_view_categories') }}'"
                                class="btn btn-sm btn-secondary">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group" style="width: 250px;">
                                <input type="text" name="category_search" class="form-control float-right"
                                    value="{{ Request::get('category_search') }}" placeholder="Search for category">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Created/Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        @if ($category->image != null)
                                            <td><img src="{{ asset('uploads/category/thumbnails/' . $category->image) }}"
                                                    width="55" height="55" class="img-thumbnail"></td>
                                        @else
                                            <td><img src="{{ asset('admin-assets/img/unavailable.png') }}" width="55"
                                                    height="55" class="img-thumbnail"></td>
                                        @endif
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            @if ($category->status == 1)
                                                <svg class="text-success-500 h-6 w-6 text-success"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            @else
                                                <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin_edit_category', $category->id) }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1 edit_category"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="text-danger w-4 h-4 mr-1 delete_category_btn" data-toggle="modal"
                                                data-target="#deleteCategory">
                                                <input type="hidden" name="temp_catId" class="temp_catId"
                                                    value="{{ $category->id }}">
                                                <svg wire:loading.remove.delay="" wire:target=""
                                                    class="filament-link-icon w-4 h-4 mr-1 delete_category"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path ath fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>{{ $category->updated_at->format('d M Y, h:m a') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-danger text-center">Records not found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                        {{ $categories->links() }}
                        {{-- <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="deleteCategoryLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryLabel">Are you sure?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to permanently delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-warning" id="modalYesBtn" onclick="">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(".delete_category_btn").click(function() {
            let categoryId = $(this).children().first().val();
            // console.log(categoryId);

            $("#modalYesBtn").attr("onclick", "deleteCategory(" + categoryId + ")");
        });
    </script>

    <script>
        function deleteCategory(categoryId) {
            var url = "{{ route('admin_destroy_category', 'id') }}";
            var newUrl = url.replace('id', categoryId);

            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Whatever the response's status may be, redirect to category listing page
                    // console.log(response['status']);
                    if (response['status'] == true || response['status'] == false) {
                        window.location.href = "{{ route('admin_view_categories') }}";
                    }
                },
                error: function(jqXHR, exception) {
                    alert('Error occured!');
                },
            });
        }
    </script>
@endsection
