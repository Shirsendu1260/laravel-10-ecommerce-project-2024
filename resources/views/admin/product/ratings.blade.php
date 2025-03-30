{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Product Ratings</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_products') }}" class="btn btn-dark">Back</a>
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
                        <div class="card-tools">
                            <div class="input-group" style="width: 280px;">
                                <input type="text" name="product_search" class="form-control float-right"
                                    value="{{ Request::get('product_search') }}"
                                    placeholder="Search by product name or customer name">
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
                                <th>Product</th>
                                <th>Rating (Out of 5)</th>
                                <th>Comment</th>
                                <th>Rated By</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($product_ratings->isNotEmpty())
                                @foreach ($product_ratings as $product_rating)
                                    @php
                                        $product_img = get_product_image($product_rating->product_id);
                                    @endphp
                                    <tr>
                                        <td class="rating-row-text">{{ $product_rating->id }}</td>
                                        @if (!empty($product_img))
                                            <td><img src="{{ asset('uploads/product/thumbnails/' . $product_img->name) }}"
                                                    width="55" height="55" class="img-thumbnail"></td>
                                        @else
                                            <td><img src="{{ asset('admin-assets/img/unavailable.png') }}" width="55"
                                                    height="55" class="img-thumbnail"></td>
                                        @endif
                                        <td class="rating-row-text">
                                            <a href="{{ route('userend_product_details_page', $product_rating->product_slug) }}"
                                                class="card-link">
                                                {{ $product_rating->product_name }}
                                            </a>
                                        </td>
                                        <td class="rating-row-text">{{ $product_rating->rating }}</td>
                                        <td class="rating-row-text">
                                            {!! $product_rating->comment !!}
                                        </td>
                                        <td class="rating-row-text">{{ $product_rating->user_name }}</td>
                                        <td class="rating-row-text">
                                            @if ($product_rating->status == 1)
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
                                        <td class="rating-row-text">
                                            @if ($product_rating->status == 0)
                                                <a href="javascript:void(0)"
                                                    class="btn btn-sm btn-warning manage_rating_btn mr-1"
                                                    data-toggle="modal" data-target="#approveRating">
                                                    <input type="hidden" name="temp_productRatingId"
                                                        value="{{ $product_rating->id }}">
                                                    Manage
                                                </a>
                                            @endif
                                            <a href="javascript:void(0)" class="btn btn-sm btn-dark delete_rating_btn"
                                                data-toggle="modal" data-target="#deleteRating">
                                                <input type="hidden" name="temp_productRatingId"
                                                    value="{{ $product_rating->id }}">
                                                Delete
                                            </a>
                                        </td>
                                        <td class="rating-row-text">
                                            {{ $product_rating->created_at->format('d M Y, h:m a') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-danger text-center">Records not found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                        {{ $product_ratings->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="approveRating" tabindex="-1" aria-labelledby="approveRatingLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveRatingLabel">Are you sure?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to approve this product review?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-warning" id="modalYesBtn" onclick="">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteRating" tabindex="-1" aria-labelledby="deleteRatingLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRatingLabel">Are you sure?
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to delete this product review?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-warning" id="modalYesBtn2" onclick="">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(".manage_rating_btn").click(function() {
            let ratingId = $(this).children().first().val();

            $("#modalYesBtn").attr("onclick", "approveRating(" + ratingId + ")");
        });

        $(".delete_rating_btn").click(function() {
            let ratingId = $(this).children().first().val();

            $("#modalYesBtn2").attr("onclick", "deleteRating(" + ratingId + ")");
        });
    </script>

    <script>
        function approveRating(ratingId) {
            var url = "{{ route('admin_approve_product_rating', 'id') }}";
            var newUrl = url.replace('id', ratingId);

            $.ajax({
                url: newUrl,
                type: 'put',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Whatever the response's status may be, redirect to product ratings listing page
                    // console.log(response['status']);
                    if (response['status'] == true || response['status'] == false) {
                        window.location.href = "{{ route('admin_view_product_ratings') }}";
                    }
                },
                error: function(jqXHR, exception) {
                    alert('Error occured!');
                },
            });
        }

        function deleteRating(ratingId) {
            var url = "{{ route('admin_delete_product_rating', 'id') }}";
            var newUrl = url.replace('id', ratingId);

            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Whatever the response's status may be, redirect to product ratings listing page
                    // console.log(response['status']);
                    if (response['status'] == true || response['status'] == false) {
                        window.location.href = "{{ route('admin_view_product_ratings') }}";
                    }
                },
                error: function(jqXHR, exception) {
                    alert('Error occured!');
                },
            });
        }
    </script>
@endsection
