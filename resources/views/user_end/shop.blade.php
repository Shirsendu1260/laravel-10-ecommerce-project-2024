@extends('user_end.layouts.app')

@section('content')
    <div>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="section-6 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 sidebar">
                        <div class="sub-title">
                            <h2>Categories</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="categoryAccordion">
                                    @if ($categories->isNotEmpty())
                                        @foreach ($categories as $key => $category)
                                            <div class="accordion-item">
                                                @php
                                                    $sub_categories = get_sub_categories($category->id);
                                                @endphp
                                                @if ($sub_categories->isNotEmpty())
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne-{{ $key }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapseOne-{{ $key }}">
                                                            {{ $category->name }}
                                                        </button>
                                                    </h2>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="nav-item nav-link category-href {{ $category_selected == $category->id ? 'text-primary' : '' }}">
                                                        {{ $category->name }}
                                                        <input type="hidden" name="category_href"
                                                            value="{{ $category->id }}">
                                                    </a>
                                                @endif
                                                @if ($sub_categories->isNotEmpty())
                                                    <div id="collapseOne-{{ $key }}"
                                                        class="accordion-collapse collapse {{ $category_selected == $category->id ? 'show' : '' }}"
                                                        aria-labelledby="headingOne" data-bs-parent="#categoryAccordion"
                                                        style="">
                                                        <div class="accordion-body">
                                                            <div class="navbar-nav">
                                                                @foreach ($sub_categories as $sub_category)
                                                                    <a href="javascript:void(0)"
                                                                        class="nav-item nav-link sub-category-href {{ $sub_category_selected == $sub_category->id ? 'text-primary' : '' }}">
                                                                        {{ $sub_category->name }}
                                                                        <input type="hidden" name="category_href"
                                                                            value="{{ $category->id }}">
                                                                        <input type="hidden" name="sub_category_href"
                                                                            value="{{ $sub_category->id }}">
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="sub-title mt-5">
                            <h2>Brand</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @if ($brands->isNotEmpty())
                                    @foreach ($brands as $brand)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input brand-checkbox" type="checkbox" name="brands[]"
                                                value="{{ $brand->id }}" id="brand-{{ $brand->id }}"
                                                {{ in_array($brand->id, $brands_array) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="brand-{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="sub-title mt-5">
                            <h2>Price</h2>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-3 text-secondary" style="font-size: 12.5px;">Use the slider to adjust min and
                                    max price.</p>
                                <input type="text" class="range-slider" name="price_range" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row pb-3">
                            <div class="col-12 pb-1">
                                <div class="d-flex align-items-center justify-content-end mb-2">
                                    <div class="ml-2 mt-3">
                                        <a href="{{ route('userend_shoppage') }}" class="btn btn-sm btn-outline-dark me-2"
                                            onMouseOver="this.style.color='#f7ca0d'"
                                            onMouseOut="this.style.color='#000'">Undo Selection</a>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown">Sorting</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item {{ $sorting_type_selected == 'latest' ? 'active' : '' }}"
                                                    href="javascript:void(0)" id="sort-latest">
                                                    Latest
                                                    <input type="hidden" name="sorting_type" value="latest">
                                                </a>
                                                <a class="dropdown-item {{ $sorting_type_selected == 'price_desc' ? 'active' : '' }}"
                                                    href="javascript:void(0)" id="sort-price-desc">
                                                    Price High
                                                    <input type="hidden" name="sorting_type" value="price_desc">
                                                </a>
                                                <a class="dropdown-item {{ $sorting_type_selected == 'price_asc' ? 'active' : '' }}"
                                                    href="javascript:void(0)" id="sort-price-asc">
                                                    Price Low
                                                    <input type="hidden" name="sorting_type" value="price_asc">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="productList" class="row">
                                @if ($products->isNotEmpty())
                                    @foreach ($products as $product)
                                        @php
                                            // Select the first image of the returned images using the relation 'get_product_images' from 'Product' model
                                            $product_img = $product->get_product_images->first();
                                            // dd($product_img);
                                        @endphp
                                        <div class="col-sm-6 col-md-4 col-lg-3 col-6 d-flex">
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
                                                    <a class="wishlist wishlist-btn"
                                                        onclick="addToWishlist({{ $product->id }})"
                                                        href="javascript:void(0)"><i class="far fa-heart"></i></a>
                                                    <div class="product-action">
                                                        @if ($product->track_qty == 1)
                                                            @if ($product->qty > 0)
                                                                <a class="btn btn-dark" href="javascript:void(0)"
                                                                    onclick="addToCart({{ $product->id }})">
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
                                                        <span
                                                            class="h5"><strong>₹{{ $product->price }}</strong></span>
                                                        @if ($product->compare_price != null && $product->compare_price != 0)
                                                            <span
                                                                class="h6 text-underline"><del>₹{{ $product->compare_price }}</del></span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('user-assets/images/not-found.png') }}" alt="not-found-png"
                                            style="width: 400px;">
                                        <br><br>
                                        <h4><b>No Results Found</b></h4>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12 pt-5">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination m-0 justify-content-end">
                                        {{ $products->withQueryString()->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
@endsection

@section('customJs')
    <script>
        let category = "{{ $category_selected != '' ? $category_selected : '' }}";
        let subCategory = "{{ $sub_category_selected != '' ? $sub_category_selected : '' }}";
        let sortingType = "{{ $sorting_type_selected != '' ? $sorting_type_selected : '' }}";
        let brands = [];
    </script>

    <script>
        $(".range-slider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 100000,
            from: {{ $price_min }},
            step: 5000,
            to: {{ $price_max }},
            skin: "flat",
            grid: true,
            grid_num: 3,
            force_edges: true,
            prettify_separator: ",",
            values_separator: " - ",
            max_postfix: "+",
            prefix: "₹",
            onFinish: function() {
                apply_filters();
            },
        });

        // Saving the instance
        let slider = $(".range-slider").data("ionRangeSlider");
        // console.log(slider.result);
    </script>

    <script>
        $(".category-href").click(function() {
            category = $(this).find("input[name='category_href']").val();
            subCategory = "";
            // console.log(category);
            apply_filters();
        });
    </script>

    <script>
        $(".sub-category-href").click(function() {
            category = $(this).find("input[name='category_href']").val();
            subCategory = $(this).find("input[name='sub_category_href']").val();
            // console.log(category + " " + subCategory);
            apply_filters();
        });
    </script>

    <script>
        $("#sort-latest").click(function() {
            sortingType = $(this).find("input[name='sorting_type']").val();
            apply_filters();
        });
    </script>

    <script>
        $("#sort-price-desc").click(function() {
            sortingType = $(this).find("input[name='sorting_type']").val();
            apply_filters();
        });
    </script>

    <script>
        $("#sort-price-asc").click(function() {
            sortingType = $(this).find("input[name='sorting_type']").val();
            apply_filters();
        });
    </script>

    <script>
        function base64Encode(str) {
            return btoa(encodeURIComponent(str)); // Encode to Base64
        }

        function apply_filters() {
            let url = null;

            $(".brand-checkbox").each(function() {
                if ($(this).is(":checked") == true) {
                    brands.push($(this).val());
                }
            });

            // console.log(brands.toString());

            url = "{{ route('userend_shoppage') }}?a=0";

            if (category != "" && subCategory == "") {
                url += "&c=" + base64Encode(category.toString());
            } else if (category != "" && subCategory != "") {
                url += "&c=" + base64Encode(category.toString()) + "&sc=" + base64Encode(subCategory.toString());
            }

            if (brands.length > 0) {
                url += "&b=" + base64Encode(brands.toString());
            }

            if (sortingType != "") {
                url += "&st=" + base64Encode(sortingType);
            }

            url += "&p1=" + slider.result.from + "&p2=" + slider.result.to;

            let searched_keyword = $("#search").val();
            if (searched_keyword != "") {
                url += "&search=" + searched_keyword;
            }

            window.location.href = url;
        }
    </script>

    <script>
        $(".brand-checkbox").change(function() {
            apply_filters();
        });
    </script>

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
@endsection
