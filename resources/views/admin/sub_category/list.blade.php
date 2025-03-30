{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub Categories</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_create_sub_category_page') }}" class="btn btn-warning">Add New Sub Category</a>
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
                            <button type="button" onclick="window.location.href='{{ route('admin_view_sub_categories') }}'"
                                class="btn btn-sm btn-secondary">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group" style="width: 250px;">
                                <input type="text" name="sub_category_search" class="form-control float-right"
                                    value="{{ Request::get('sub_category_search') }}" placeholder="Search for sub-category">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- {{ dd($sub_categories) }} --}}
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Created/Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($sub_categories->isNotEmpty())
                                @foreach ($sub_categories as $sub_category)
                                    <tr>
                                        <td>{{ $sub_category->id }}</td>
                                        <td>{{ $sub_category->name }}</td>
                                        <td>{{ $sub_category->slug }}</td>
                                        <td>{{ $sub_category->category }}</td>
                                        <td>
                                            @if ($sub_category->status == 1)
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
                                            <a href="{{ route('admin_edit_sub_category', $sub_category->id) }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1 edit_sub_category"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="text-danger w-4 h-4 mr-1 delete_sub_category_btn" data-toggle="modal"
                                                data-target="#deleteSubCategory">
                                                <input type="hidden" name="temp_subCatId" class="temp_subCatId"
                                                    value="{{ $sub_category->id }}">
                                                <svg wire:loading.remove.delay="" wire:target=""
                                                    class="filament-link-icon w-4 h-4 mr-1 delete_sub_category"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path ath fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </td>
                                        <td>{{ $sub_category->updated_at->format('d M Y, h:m a') }}</td>
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
                        {{ $sub_categories->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="deleteSubCategory" tabindex="-1" aria-labelledby="deleteSubCategoryLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSubCategoryLabel">Are you
                        sure?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to permanently delete this sub-category?
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
        $(".delete_sub_category_btn").click(function() {
            let subCategoryId = $(this).children().first().val();

            $("#modalYesBtn").attr("onclick", "deleteSubCategory(" + subCategoryId + ")");
        });
    </script>

    <script>
        function deleteSubCategory(subCategoryId) {
            var url = "{{ route('admin_destroy_sub_category', 'id') }}";
            var newUrl = url.replace('id', subCategoryId);

            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Whatever the response's status may be, redirect to sub-category listing page
                    // console.log(response['status']);
                    if (response['status'] == true || response['status'] == false) {
                        window.location.href = "{{ route('admin_view_sub_categories') }}";
                    }
                },
                error: function(jqXHR, exception) {
                    alert('Error occured!');
                },
            });
        }
    </script>
@endsection
