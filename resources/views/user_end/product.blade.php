@extends('user_end.layouts.app')

@section('content')
    <div>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_shoppage') }}">Shop</a></li>
                        <li class="breadcrumb-item">{{ $product->title }}</li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="section-7 pt-3 mb-3">
            <div class="container">
                <div class="row ">
                    <div class="d-flex justify-content-start">
                        <div class="alert alert-danger px-4" id="product-already-added-alert" style="display: none;"></div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <div id="product-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner bg-light">
                                @if (!empty($product->get_product_images))
                                    @foreach ($product->get_product_images as $key => $product_img)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img class="w-100 h-100 rounded"
                                                src="{{ asset('uploads\product\\' . $product_img->name) }}"
                                                alt="{{ $product->title }}">
                                        </div>
                                    @endforeach
                                    @if ($product->get_product_images->count() > 1)
                                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                                        </a>
                                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="bg-light right">
                            <h1>{{ $product->title }}</h1>
                            {{-- Get brand name using 'brand' relation --}}
                            <h5 class="mb-3">{{ $product->brand->name }}</h5>
                            @if ($product->get_product_ratings_count > 0)
                                <div class="d-flex ms-1 mb-3">
                                    <div class="star-rating product mr-2">
                                        <div class="back-stars">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <div class="front-stars" style="width: {{ $total_rating_perc }}%">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="mx-2">({{ $product->get_product_ratings_count }} Reviews)</small>
                                </div>
                            @endif
                            <div class="d-flex flex-row">
                                <h2 class="price me-3">₹{{ $product->price }}</h2>
                                @if ($product->compare_price != null && $product->compare_price != 0)
                                    <h2 class="price text-secondary">
                                        <del>₹{{ $product->compare_price }}</del>
                                    </h2>
                                @endif
                            </div>
                            <div class="input-group mt-2 mb-4" style="width: 265px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="product-qty-selector">Quantity</span>
                                </div>
                                <input type="number" min="1" max="1000" name="qty" id="qty"
                                    class="form-control" aria-describedby="product-qty-selector" value="1">
                            </div>
                            {{-- Short Description --}}
                            <div style="text-align: justify;" class="mb-4">{!! $product->short_desc !!}</div>
                            @if ($product->track_qty == 1)
                                @if ($product->qty > 0)
                                    <a class="btn btn-dark me-2 mb-2" href="javascript:void(0)"
                                        onclick="addToCart({{ $product->id }})">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>
                                @else
                                    <a class="btn me-2 mb-2 btn-danger text-white rounded-0" href="javascript:void(0)"
                                        style="padding: 10px 20px;">
                                        <i class="fa fa-ban"></i> Out Of Stock
                                    </a>
                                @endif
                            @else
                                <a class="btn btn-dark me-2 mb-2" href="javascript:void(0)"
                                    onclick="addToCart({{ $product->id }})">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>
                            @endif
                            <a href="javascript:void(0)" onclick="addToWishlist({{ $product->id }})"
                                class="btn btn-warning rounded-0 mb-2" style="padding: 10px 20px;"><i
                                    class="fas fa-heart"></i>
                                &nbsp;ADD TO WISHLIST</a>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="bg-light">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="shipping-tab" data-bs-toggle="tab"
                                        data-bs-target="#shipping" type="button" role="tab"
                                        aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                                </li>
                                @if ($product->get_product_ratings_count > 0 || (Auth::check() && $user_bought_product == true))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                            data-bs-target="#reviews" type="button" role="tab"
                                            aria-controls="reviews" aria-selected="false">Reviews</button>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" style="text-align: justify;" id="description"
                                    role="tabpanel" aria-labelledby="description-tab">{!! $product->description !!}</div>
                                <div class="tab-pane fade" style="text-align: justify;" id="shipping" role="tabpanel"
                                    aria-labelledby="shipping-tab">
                                    {!! $product->shipping_returns !!}</div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    @if (Auth::check() && $user_bought_product == true)
                                        <div class="col-md-8 mb-1">
                                            <div class="row">
                                                <h3 class="h4 pb-3">Write a Review</h3>
                                                <form id="reviewForm">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="rating">Rating</label>
                                                        <br>
                                                        <div class="rating" style="width: 10rem">
                                                            <input id="rating-5" type="radio" name="rating"
                                                                value="5" /><label for="rating-5"><i
                                                                    class="fas fa-3x fa-star"></i></label>
                                                            <input id="rating-4" type="radio" name="rating"
                                                                value="4" /><label for="rating-4"><i
                                                                    class="fas fa-3x fa-star"></i></label>
                                                            <input id="rating-3" type="radio" name="rating"
                                                                value="3" /><label for="rating-3"><i
                                                                    class="fas fa-3x fa-star"></i></label>
                                                            <input id="rating-2" type="radio" name="rating"
                                                                value="2" /><label for="rating-2"><i
                                                                    class="fas fa-3x fa-star"></i></label>
                                                            <input id="rating-1" type="radio" name="rating"
                                                                value="1" /><label for="rating-1"><i
                                                                    class="fas fa-3x fa-star"></i></label>
                                                        </div>
                                                        <p class="product-rating-error text-danger mt-1"
                                                            style="font-size: 0.875em;"></p>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="review">How was your overall experience?
                                                            (Optional)</label>
                                                        <textarea name="review" id="review" class="form-control rounded-0" cols="30" rows="10"
                                                            placeholder="Write here"></textarea>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-dark">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product->get_product_ratings_count > 0)
                                        @php
                                            $user_ratings = get_ratings($product->id);
                                            // dd($user_ratings);
                                        @endphp
                                        @if (Auth::check() && $user_bought_product == true)
                                            <div class="mb-5"></div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="overall-rating mb-3">
                                                <div class="d-flex">
                                                    <h1 class="h3 pe-3">{{ $rating }}</h1>
                                                    <div class="star-rating mt-2">
                                                        <div class="back-stars">
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                            <div class="front-stars"
                                                                style="width: {{ $total_rating_perc }}%">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-2 ps-2">({{ $product->get_product_ratings_count }}
                                                        Reviews)</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @foreach ($user_ratings as $user_rating)
                                                    @php
                                                        // Calculate percentage value based on 5 star rating
                                                        // For example, 100% for 5 star rating, 80% for 4 star rating and so on
                                                        $rating_perc = ($user_rating->rating / 5) * 100;
                                                    @endphp
                                                    <div class="rating-group col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
                                                        <span><strong>{{ $user_rating->name }}</strong></span>
                                                        <div class="star-rating mt-1">
                                                            <div class="back-stars ms-1">
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <div class="front-stars"
                                                                    style="width: {{ $rating_perc }}%">
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 mb-3">
                                                            <p style="text-align: justify; text-justify: inter-word;">
                                                                {!! $user_rating->comment !!}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @php
            $related_products = get_related_products($product->related_products);
        @endphp
        @if ($related_products->isNotEmpty())
            <section class="pt-5 section-8">
                <div class="container">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                    <div class="col-md-12">
                        <div id="related-products" class="carousel row pb-3">
                            @foreach ($related_products as $rel_product)
                                @php
                                    // Select the first image of the returned images using the relation 'get_product_images' from 'Product' model
                                    $product_img = $rel_product->get_product_images->first();
                                @endphp
                                <div class="col-lg-3 col-md-3 col-sm-6 col-6 d-flex">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                            <a href="{{ route('userend_product_details_page', $rel_product->slug) }}"
                                                class="product-img">
                                                @if (!empty($product_img))
                                                    <img src="{{ asset('uploads\product\\' . $product_img->name) }}"
                                                        alt="{{ $rel_product->name }}" class="card-img-top">
                                                @else
                                                    <img src="{{ asset('admin-assets/img/unavailable.png') }}"
                                                        class="card-img-top">
                                                @endif
                                            </a>
                                            <a class="wishlist wishlist-btn" onclick="addToWishlist({{ $product->id }})"
                                                href="javascript:void(0)"><i class="far fa-heart"></i></a>
                                            <div class="product-action">
                                                @if ($rel_product->track_qty == 1)
                                                    @if ($rel_product->qty > 0)
                                                        <a class="btn btn-dark" href="javascript:void(0)"
                                                            onclick="addToCart({{ $rel_product->id }})">
                                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                                        </a>
                                                    @else
                                                        <a class="btn btn-danger text-white rounded-0"
                                                            href="javascript:void(0)" style="padding: 10px 20px;">
                                                            <i class="fa fa-ban"></i> Out Of Stock
                                                        </a>
                                                    @endif
                                                @else
                                                    <a class="btn btn-dark" href="javascript:void(0)"
                                                        onclick="addToCart({{ $rel_product->id }})">
                                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body text-center mt-3" style="min-height: 120px;">
                                            <a class="h6 link"
                                                href="{{ route('userend_product_details_page', $rel_product->slug) }}">{{ $rel_product->title }}</a>
                                            <div class="price mt-2">
                                                <span class="h5"><strong>₹{{ $rel_product->price }}</strong></span>
                                                @if ($rel_product->compare_price != null && $rel_product->compare_price != 0)
                                                    <span
                                                        class="h6 text-underline"><del>₹{{ $rel_product->compare_price }}</del></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if ($recently_viewed_products->isNotEmpty())
            <section class="pt-5 section-8">
                <div class="container">
                    <div class="section-title">
                        <h2>Recently Viewed Products</h2>
                    </div>
                    <div class="col-md-12">
                        <div id="related-products" class="row pb-3 d-flex justify-content-center">
                            @foreach ($recently_viewed_products as $viewed_product)
                                {{-- {{ dd($viewed_product) }} --}}
                                @php
                                    $product_img = get_product_image($viewed_product->product_id);
                                    // echo $product_img->name;
                                @endphp
                                <div class="col-lg-2 col-md-3 col-sm-4 col-4 d-flex">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                            <a href="{{ route('userend_product_details_page', $viewed_product->slug) }}"
                                                class="product-img">
                                                @if (!empty($product_img))
                                                    <img src="{{ asset('uploads\product\\' . $product_img->name) }}"
                                                        alt="{{ $viewed_product->title }}" class="card-img-top">
                                                @else
                                                    <img src="{{ asset('admin-assets/img/unavailable.png') }}"
                                                        class="card-img-top">
                                                @endif
                                            </a>
                                            <a class="wishlist wishlist-btn"
                                                onclick="addToWishlist({{ $viewed_product->product_id }})"
                                                href="javascript:void(0)"><i class="far fa-heart"></i></a>
                                            <div class="product-action">
                                                @if ($viewed_product->track_qty == 1)
                                                    @if ($viewed_product->qty > 0)
                                                        <a class="btn btn-dark" href="javascript:void(0)"
                                                            onclick="addToCart({{ $viewed_product->product_id }})">
                                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                                        </a>
                                                    @else
                                                        <a class="btn btn-danger text-white rounded-0"
                                                            href="javascript:void(0)" style="padding: 10px 20px;">
                                                            <i class="fa fa-ban"></i> Out Of Stock
                                                        </a>
                                                    @endif
                                                @else
                                                    <a class="btn btn-dark" href="javascript:void(0)"
                                                        onclick="addToCart({{ $viewed_product->product_id }})">
                                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body text-center mt-3" style="min-height: 120px;">
                                            <a class="h6 link"
                                                href="{{ route('userend_product_details_page', $viewed_product->slug) }}">{{ $viewed_product->title }}</a>
                                            <div class="price mt-2">
                                                <span class="h5"><strong>₹{{ $viewed_product->price }}</strong></span>
                                                @if ($viewed_product->compare_price != null && $viewed_product->compare_price != 0)
                                                    <span
                                                        class="h6 text-underline"><del>₹{{ $viewed_product->compare_price }}</del></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Laravel ECOM</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <i class="icon fa fa-check"></i> Product is added to your wishlist successfully.
            </div>
        </div>
    </div>
    <div class="position-fixed top-0 start-0 p-3" style="z-index: 11">
        <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Laravel ECOM</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <i class="icon fa fa-check"></i>&nbsp;<span id="review-span">TEXT</span>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        let qty = 1;

        $("#qty").change(function() {
            qty = $(this).val();
        })
    </script>

    <script>
        function addToCart(productId) {
            // alert(productId);

            $.ajax({
                url: "{{ route('product_add_to_cart') }}",
                type: "post",
                data: {
                    product_id: productId,
                    qty: qty,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('userend_cartpage') }}";
                    } else {
                        let alertDiv = $("#product-already-added-alert");
                        alertDiv.html("<h6><i class='icon fa fa-exclamation-triangle'></i> " + response.msg +
                            "</h6>")
                        alertDiv.fadeIn('fast');
                        setTimeout(function() {
                            alertDiv.fadeOut('slow');
                        }, 5000);
                    }
                },
                error: function() {
                    alert("ADD TO CART operation failed.");
                }
            });
        }
    </script>

    <script>
        function addToWishlist(productId) {
            let logged_in = false;

            @auth
            logged_in = true;
        @endauth

        if (logged_in == true) {
            $.ajax({
                url: "{{ route('product_add_to_wishlist') }}",
                type: "post",
                data: {
                    product_id: productId,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        // alert(response.msg);
                        var toastLiveExample = document.getElementById('liveToast');
                        var toast = new bootstrap.Toast(toastLiveExample);
                        toast.show();
                    } else {
                        alert(response.msg);
                    }
                },
                error: function() {
                    alert("ADD TO WISHLIST operation failed!");
                },
            });
        } else {
            alert("You must sign in to add this product to your wishlist.");
        }
        }
    </script>

    <script>
        $("#reviewForm").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('userend_save_rating', $product->id) }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('.product-rating-error').text('');
                        document.getElementById("reviewForm").reset(); // Reset the form

                        if (response['success'] == true) {
                            var toastLiveExample = document.getElementById('liveToast2');
                            var toast = new bootstrap.Toast(toastLiveExample);
                            $('#review-span').text(response['msg']);
                            $(".toast-body").removeClass('text-danger');
                            $(".toast-body").find('.icon').addClass('fa-check').removeClass('fa-ban');
                            toast.show();
                        } else {
                            var toastLiveExample = document.getElementById('liveToast2');
                            var toast = new bootstrap.Toast(toastLiveExample);
                            $('#review-span').text(response['msg']);
                            $(".toast-body").addClass('text-danger');
                            $(".toast-body").find('.icon').addClass('fa-ban').removeClass('fa-check');
                            toast.show();
                        }
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        let errors = response['errors'];

                        if (errors['rating']) {
                            $('.product-rating-error').text(errors['rating']);
                        } else {
                            $('.product-rating-error').text('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while submitting the review!");
                },
            });
        });
    </script>
@endsection
