@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user_dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">My Wishlist</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-11">
        <div class="container mt-5 py-4">
            <div class="row">
                <div class="col-md-3">
                    @include('includes.account_panel')
                </div>
                <div class="col-md-9">
                    @if ($wishlist_items->isNotEmpty())
                        <div class="card border">
                            <div class="card-header bg-dark">
                                <h2 class="h5 mb-0 pt-2 text-white pb-2">My Wishlist</h2>
                            </div>
                            <div class="card-body p-4 items-card">
                                @foreach ($wishlist_items as $item)
                                    @php
                                        $product_img = get_product_image($item->id);
                                    @endphp
                                    <div class="d-sm-flex justify-content-between my-2 p-2 border rounded"
                                        id="item-card-{{ $item->id }}">
                                        <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                            <a class="d-block flex-shrink-0 mx-auto me-sm-4"
                                                href="{{ route('userend_product_details_page', $item->slug) }}"
                                                style="width: 5.5rem;">
                                                @if (!empty($product_img))
                                                    <img src="{{ asset('uploads\product\\' . $product_img->name) }}"
                                                        alt="{{ $item->title }}" class="card-img-top border rounded">
                                                @else
                                                    <img src="{{ asset('admin-assets/img/unavailable.png') }}"
                                                        class="card-img-top border rounded">
                                                @endif
                                            </a>
                                            <div class="pt-2">
                                                <h5 class="fs-base" style="font-size: 16.5px;">
                                                    <a class="link"
                                                        href="{{ route('userend_product_details_page', $item->slug) }}">{{ $item->title }}</a>
                                                </h5>
                                                <div class="text-accent pt-2" style="font-size: small">
                                                    ₹{{ number_format($item->price, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                            <a href="javascript:void(0)"
                                                class="btn btn-outline-danger btn-sm delete_wishlist_item_btn"
                                                data-bs-toggle="modal" data-bs-target="#removeFromWishlist">
                                                <input type="hidden" name="product_id" class="productId"
                                                    value="{{ $item->id }}">
                                                <input type="hidden" name="product_name" class="productName"
                                                    value="{{ $item->title }}">
                                                <i class="fas fa-trash-alt me-2"></i>Remove
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <img src="{{ asset('user-assets/images/not-found.png') }}" alt="not-found-png"
                                style="width: 170px;">
                            <br>
                            <h5><b>No Items In Wishlist</b></h5>
                        </div>
                    @endif
                    <div class="col-md-12 pt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination m-0 justify-content-end">
                                {{ $wishlist_items->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="removeFromWishlist" tabindex="-1" aria-labelledby="removeFromWishlistLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removeFromWishlistLabel">Are you sure?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you really want to remove this item (<b><span id="modal-item-name">ItemName</span></b>) from
                        wishlist?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="modalNoBtn" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-warning" id="modalYesBtn" onclick="">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $(".delete_wishlist_item_btn").click(function() {
            let productId = $(this).children().eq(0).val();
            let productName = $(this).children().eq(1).val();

            $("#modal-item-name").text(productName);

            $("#modalYesBtn").attr("onclick", "removeFromWishlist(productId = '" + productId + "')");
        });
    </script>

    <script>
        function removeFromWishlist(productId) {
            let itemCard = $(".items-card").find("#item-card-" + productId);

            $.ajax({
                url: "{{ route('product_remove_from_wishlist') }}",
                type: "delete",
                data: {
                    product_id: productId,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        itemCard.fadeOut("fast", function() {
                            itemCard.remove();
                        });
                        $("#modalNoBtn").click();
                    } else {
                        alert(response.msg);
                    }
                },
                error: function() {
                    alert("REMOVE FROM WISHLIST operation failed!");
                },
            });
        }
    </script>
@endsection
