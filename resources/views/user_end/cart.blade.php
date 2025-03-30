@extends('user_end.layouts.app')

@section('content')
    <div>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                        <li class="breadcrumb-item">Cart</li>
                    </ol>
                </div>
            </div>
        </section>
        @if ($cart_content->isNotEmpty())
            <section class="section-9 pt-4">
                <div class="container">
                    <div class="row">
                        @if (Session::has('success'))
                            <div class="col-md-12 mb-3" id="msg-success">
                                <div class="alert alert-success px-4">
                                    <h6><i class="icon fa fa-check"></i> {!! Session::get('success') !!}</h6>
                                </div>
                            </div>
                        @elseif (Session::has('error'))
                            <div class="col-md-12 mb-3" id="msg-error">
                                <div class="alert alert-danger px-4">
                                    <h6><i class="icon fa fa-exclamation-triangle"></i> {!! Session::get('error') !!}</h6>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-8 mb-3">
                            <div class="table-responsive">
                                <table class="table" id="cart">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart_content as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center px-2">
                                                        @if ($item->options->product_image != '')
                                                            <img src="{{ asset('uploads\product\\' . $item->options->product_image) }}"
                                                                alt="{{ $item->name }}" class="img-fluid rounded">
                                                        @else
                                                            <img src="{{ asset('admin-assets/img/unavailable.png') }}"
                                                                class="img-fluid rounded">
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <h2><a class="link"
                                                            href="{{ route('userend_product_details_page', $item->options->slug) }}">{{ $item->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>₹{{ $item->price }}</td>
                                                <td>
                                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub"
                                                                data-id="{{ $item->rowId }}">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="number"
                                                            class="form-control form-control-sm border-0 text-center bg-white"
                                                            value="{{ $item->qty }}" min="1" max="10"
                                                            readonly>
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add"
                                                                data-id="{{ $item->rowId }}">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>₹{{ $item->price * $item->qty }}</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-sm btn-danger delete_cart_item_btn"
                                                        data-bs-toggle="modal" data-bs-target="#deleteCartItem">
                                                        <input type="hidden" name="item_rowId" class="item_rowId"
                                                            value="{{ $item->rowId }}">
                                                        <input type="hidden" name="item_name" class="item_name"
                                                            value="{{ $item->name }}">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card cart-summery">
                                <div class="sub-title">
                                    <h2 class="bg-white">Cart Summery</h3>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between pb-2">
                                        <div>Subtotal</div>
                                        <div>₹{{ Cart::subtotal() }}</div>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <div>Shipping <br><span style="font-size: small">(Will Be Applied Later)</span>
                                        </div>
                                        <div>₹0</div>
                                    </div>
                                    <div class="d-flex justify-content-between summery-end">
                                        <div>Total</div>
                                        <div>₹{{ Cart::subtotal() }}</div>
                                    </div>
                                    <div class="pt-5">
                                        <a href="{{ route('userend_checkout_page') }}"
                                            class="btn-dark btn btn-block w-100">Proceed to
                                            Checkout</a>
                                        <a href="{{ route('userend_shoppage') }}"
                                            class="btn-warning rounded-0 btn btn-block w-100 mt-3">Continue
                                            Shopping<i class="fa fa-chevron-right ms-2"></i></a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="input-group apply-coupon mt-4">
                                <input type="text" placeholder="Coupon Code" class="form-control">
                                <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </section>
        @else
            <div class="d-flex flex-column align-items-center justify-content-center">
                <img src="{{ asset('user-assets/images/empty-cart.png') }}" alt="empty-cart-png" style="width: 400px;">
                <br>
                <h4><b>No Items In Cart</b></h4>
                <br>
                <a href="{{ route('userend_shoppage') }}" class="btn btn-dark rounded d-flex align-items-center">Return To
                    Shop<i class="fa fa-chevron-right ms-2"></i></a>
            </div>
        @endif
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteCartItem" tabindex="-1" aria-labelledby="deleteCartItemLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCartItemLabel">Are you sure?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you really want to delete this item (<span id="modal-item-name">ItemName</span>) from cart?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-warning" id="modalYesBtn" onclick="">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        function updateCartQty(rowId, qty) {
            $.ajax({
                url: "{{ route('userend_update_cart_qty') }}",
                type: "post",
                data: {
                    row_id: rowId,
                    qty: qty,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('userend_cartpage') }}"
                    }
                },
                error: function() {
                    alert("Error occurred while updating the item's quantity.");
                }
            });
        }

        function deleteCartItem(rowId = "") {
            $.ajax({
                url: "{{ route('userend_delete_cart_item') }}",
                type: "post",
                data: {
                    row_id: rowId,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('userend_cartpage') }}"
                    }
                },
                error: function() {
                    alert("Error occurred while deleting the item.");
                }
            });
        }
    </script>

    <script>
        $('.sub').click(function() {
            let qtyElement = $(this).parent().next(); // Qty Input Tag
            let qtyValue = parseInt(qtyElement.val());

            if (qtyValue > 1) {
                qtyElement.val(qtyValue - 1);

                let rowId = $(this).data("id");
                let updatedQty = qtyElement.val();
                // console.log(rowId);
                updateCartQty(rowId, updatedQty);
            }
        });

        $('.add').click(function() {
            let qtyElement = $(this).parent().prev(); // Qty Input Tag
            let qtyValue = parseInt(qtyElement.val());

            if (qtyValue < 10) {
                qtyElement.val(qtyValue + 1);

                let rowId = $(this).data("id");
                let updatedQty = qtyElement.val();
                // console.log(rowId);
                updateCartQty(rowId, updatedQty);
            }
        });
    </script>

    <script>
        $(".delete_cart_item_btn").click(function() {
            let itemRowId = $(this).children().eq(0).val();
            let itemName = $(this).children().eq(1).val();
            // console.log(itemRowId + " " + itemName);

            $("#modal-item-name").text(itemName);

            $("#modalYesBtn").attr("onclick", "deleteCartItem(rowId = '" + itemRowId + "')");
        });
    </script>

    <script>
        setTimeout(function() {
            $('#msg-success').fadeOut('slow');
        }, 5000);

        setTimeout(function() {
            $('#msg-error').fadeOut('slow');
        }, 5000);
    </script>
@endsection

{{-- {{ dd(Session::all()) }} --}}
