@extends('user_end.layouts.app')

@section('content')
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
            data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('user-assets/images/carousel-1-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('user-assets/images/carousel-1.jpg') }}" />
                        <img src="{{ asset('user-assets/images/carousel-1.jpg') }}" alt="" />
                    </picture>
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Kid's Fashion</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                stet amet amet ndiam elitr ipsum diam.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('userend_shoppage') }}">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('user-assets/images/carousel-2-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('user-assets/images/carousel-2.jpg') }}" />
                        <img src="{{ asset('user-assets/images/carousel-2.jpg') }}" alt="" />
                    </picture>
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Women's Fashion</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                stet amet amet ndiam elitr ipsum diam.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('userend_shoppage') }}">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('user-assets/images/carousel-3-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('user-assets/images/carousel-3.jpg') }}" />
                        <img src="{{ asset('user-assets/images/carousel-3.jpg') }}" alt="" />
                    </picture>
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Flat 70% off on Branded Clothes
                            </h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo
                                stet amet amet ndiam elitr ipsum diam.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('userend_shoppage') }}">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg rounded">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg rounded">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg rounded">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg rounded">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>
            <div class="row pb-3">
                @php
                    $categories = get_categories();
                @endphp
                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <div class="col-lg-3 d-flex">
                            <div class="cat-card rounded">
                                <div class="left p-2">
                                    @if ($category->image != null)
                                        <img src="{{ asset('uploads\category\\' . $category->image) }}"
                                            alt="{{ $category->name }}" class="img-fluid rounded">
                                    @else
                                        <img src="{{ asset('admin-assets/img/unavailable.png') }}"
                                            class="img-fluid rounded">
                                    @endif
                                </div>
                                <div class="right">
                                    <div class="cat-data">
                                        <h2>{{ $category->name }}</h2>
                                        <p>{{ count_products_of_category($category->id) }} Products</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
            </div>
            <div class="row pb-3">
                @if ($featured_products->isNotEmpty())
                    @foreach ($featured_products as $product)
                        @php
                            // Select the first image of the returned images using the relation 'get_product_images' from 'Product' model
                            $product_img = $product->get_product_images->first();
                            // dd($product_img);
                        @endphp
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 d-flex">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route('userend_product_details_page', $product->slug) }}"
                                        class="product-img">
                                        @if (!empty($product_img))
                                            <img src="{{ asset('uploads\product\\' . $product_img->name) }}"
                                                alt="{{ $product->name }}" class="card-img-top">
                                        @else
                                            <img src="{{ asset('admin-assets/img/unavailable.png') }}"
                                                class="card-img-top">
                                        @endif
                                    </a>
                                    <a class="wishlist wishlist-btn" onclick="addToWishlist({{ $product->id }})"
                                        href="javascript:void(0)"><i class="far fa-heart"></i></a>
                                    <div class="product-action">
                                        @if ($product->track_qty == 1)
                                            @if ($product->qty > 0)
                                                <a class="btn btn-dark" href="javascript:void(0)"
                                                    onclick="addToCart({{ $product->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            @else
                                                <a class="btn btn-danger text-white rounded-0" href="javascript:void(0)"
                                                    style="padding: 10px 20px;">
                                                    <i class="fa fa-ban"></i> Out Of Stock
                                                </a>
                                            @endif
                                        @else
                                            <a class="btn btn-dark" href="javascript:void(0)"
                                                onclick="addToCart({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link"
                                        href="{{ route('userend_product_details_page', $product->slug) }}">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>₹{{ $product->price }}</strong></span>
                                        @if ($product->compare_price != null && $product->compare_price != 0)
                                            <span
                                                class="h6 text-underline"><del>₹{{ $product->compare_price }}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if ($featured_products_count > 4)
                <div class="text-center mb-3">
                    <a href="{{ route('userend_shoppage') }}" class="btn btn-dark rounded see-more-link">See More</a>
                </div>
            @endif
        </div>
    </section>
    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Latest Products</h2>
            </div>
            <div class="row pb-3">
                @if ($latest_products->isNotEmpty())
                    @foreach ($latest_products as $product)
                        @php
                            // Select the first image of the returned images using the relation 'get_product_images' from 'Product' model
                            $product_img = $product->get_product_images->first();
                            // dd($product_img);
                        @endphp
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 d-flex">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route('userend_product_details_page', $product->slug) }}"
                                        class="product-img">
                                        @if (!empty($product_img))
                                            <img src="{{ asset('uploads\product\\' . $product_img->name) }}"
                                                alt="{{ $product->name }}" class="card-img-top">
                                        @else
                                            <img src="{{ asset('admin-assets/img/unavailable.png') }}"
                                                class="card-img-top">
                                        @endif
                                    </a>
                                    <a class="wishlist wishlist-btn" onclick="addToWishlist({{ $product->id }})"
                                        href="javascript:void(0)"><i class="far fa-heart"></i></a>
                                    <div class="product-action">
                                        @if ($product->track_qty == 1)
                                            @if ($product->qty > 0)
                                                <a class="btn btn-dark" href="javascript:void(0)"
                                                    onclick="addToCart({{ $product->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            @else
                                                <a class="btn btn-danger text-white rounded-0" href="javascript:void(0)"
                                                    style="padding: 10px 20px;">
                                                    <i class="fa fa-ban"></i> Out Of Stock
                                                </a>
                                            @endif
                                        @else
                                            <a class="btn btn-dark" href="javascript:void(0)"
                                                onclick="addToCart({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link"
                                        href="{{ route('userend_product_details_page', $product->slug) }}">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>₹{{ $product->price }}</strong></span>
                                        @if ($product->compare_price != null && $product->compare_price != 0)
                                            <span
                                                class="h6 text-underline"><del>₹{{ $product->compare_price }}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if ($latest_products_count > 4)
                <div class="text-center mb-3">
                    <a href="{{ route('userend_shoppage') }}" class="btn btn-dark rounded see-more-link">See More</a>
                </div>
            @endif
        </div>
    </section>
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
@endsection

@section('customJs')
    <script>
        function addToCart(productId) {
            // alert(productId);

            $.ajax({
                url: "{{ route('product_add_to_cart') }}",
                type: "post",
                data: {
                    product_id: productId,
                    qty: 1,
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('userend_cartpage') }}";
                    } else {
                        alert(response.msg);
                    }
                },
                error: function() {
                    alert("ADD TO CART operation failed!");
                },
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
@endsection
