{{-- Layout --}}
@extends('admin.layouts.app')

{{-- Dashboard Section --}}
@section('content')
    <!-- Content Header (Page Header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin_view_products') }}" class="btn btn-dark">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form id="productForm">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                placeholder="Title">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" name="slug" id="slug" class="form-control"
                                                placeholder="Slug" readonly>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="short_desc">Short Description</label>
                                            <textarea name="short_desc" id="short_desc" rows="10" class="summernote" placeholder="Short Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" rows="10" class="summernote" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="shipping_returns">Shipping & Returns</label>
                                            <textarea name="shipping_returns" id="shipping_returns" rows="10" class="summernote"
                                                placeholder="Shipping & Returns"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Media</h2>
                                <div id="imageSelector" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop image here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="productImages"></div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Pricing</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="number" name="price" id="price" class="form-control"
                                                placeholder="Price">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="number" name="compare_price" id="compare_price"
                                                class="form-control" placeholder="Compare Price">
                                            <p class="text-muted mt-3">
                                                To show a reduced price, move the product’s original price into 'Compare at
                                                Price'. Enter a lower value into 'Price'.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Inventory</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sku">SKU (Stock Keeping Unit)</label>
                                            <input type="text" name="sku" id="sku" class="form-control"
                                                placeholder="SKU">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="barcode">Barcode</label>
                                            <input type="text" name="barcode" id="barcode" class="form-control"
                                                minlength="10" maxlength="10" placeholder="Barcode">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="track_qty"
                                                    name="track_qty" value="1" checked>
                                                <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                <p class="error"></p>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="qty">Quantity</label>
                                            <input type="number" min="0" name="qty" id="qty"
                                                class="form-control" placeholder="Qty">
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Related Products</h2>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3 row px-2">
                                            <select name="related_products[]" id="related_products"
                                                class="related-products-selector col-12" multiple>
                                            </select>
                                            {{-- <p class="error"></p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Product Status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Product Category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select a category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">N/A</option>
                                        @endif
                                    </select>
                                    <p class="error"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="sub_category">Sub-category</label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                        <option value="">Select a sub-category</option>
                                        @if ($sub_categories->isNotEmpty())
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">N/A</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Product Brand</h2>
                                <div class="mb-3">
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="">Select a brand</option>
                                        @if ($brands->isNotEmpty())
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">N/A</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h5 mb-3">Featured Product</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    {{-- <p class="error"></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button class="btn btn-warning">Create</button>
                    <button type="reset" class="btn btn-outline-dark ml-3">Reset</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('.related-products-selector').select2({
            ajax: {
                url: "{{ route('get_products_for_related_products') }}",
                type: "get",
                dataType: "json",
                // theme: "bootstrap",
                placeholder: 'Select a product',
                tags: true,
                multiple: true,
                minimumInputLength: 3,
                processResults: function(data) {
                    return {
                        results: data.tags
                    };
                }
            }
        });
    </script>

    <script>
        $('#title').on('input', function() {
            var data = $(this).val().toLowerCase().replace(/[^a-z0-9\s]/gi, "").replace(/^\s+|\s+$|\s+(?=\s)/g, "")
                .replace(/[_\s]/g, "-");
            $('#slug').val(data);
        });

        $('#productForm').submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('admin_create_product') }}",
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $(".error").prev().removeClass('is-invalid');
                        $(".error").removeClass('invalid-feedback').html('');

                        window.location.href = "{{ route('admin_view_products') }}";
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        var errors = response['msg'];

                        $(".error").prev().removeClass('is-invalid');
                        $(".error").removeClass('invalid-feedback').html('');

                        $.each(errors, function(key, value) {
                            // console.log(key + '\n' + value + '\n');
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

    <script>
        $("#category_id").change(function() {
            let category_id = $(this).val();

            $.ajax({
                url: "{{ route('get_sub_categories_of_category') }}",
                type: "post",
                data: {
                    category_id: category_id,
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response["subCategories"]);

                    // Remove all options of sub-categories dropdown except the first one
                    $("#sub_category_id").find("option").not(":first").remove();

                    // Add the returned sub-categories as options from response if response contains sub-categories
                    if (response["subCategories"].length > 0) {
                        // alert("Contains data");
                        $.each(response["subCategories"], function(key, item) {
                            // console.log(item);
                            $("#sub_category_id").append(
                                `<option value="${item.id}">${item.name}</option>`);
                        });
                    } else {
                        // alert("Does not contain data");
                        $("#sub_category_id").append(`<option value="">N/A</option>`);
                    }

                },
                error: function() {
                    alert("Failed to get the specific sub-categories.");
                }
            });
        });
    </script>

    <script>
        $("#track_qty").change(function() {
            if ($(this).is(":checked")) {
                $(this).val(1);
                $(this).parent().find("input[name='track_qty'][value='0']").remove();
            } else {
                $(this).parent().append("<input type='hidden' name='track_qty' value='0'>");
            }
        });
    </script>

    <script>
        Dropzone.autoDiscover = false;
        const dropzone = $("#imageSelector").dropzone({
            url: "{{ route('temp_images_create') }}",
            type: 'post',
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/jpg,image/png",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                // $("#image_id").val(response.image_id);
                //console.log(response);

                let imgCardHTML = `<div class="col-sm-6 col-md-3 col-lg-3 col-6" id="img-row-${response['image_id']}">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <img src="${response['imagePath']}" class="card-img-top rounded mb-3"
                                                    alt="temp-product-image">
                                                <input type="hidden" name="img_ids[]" value="${response['image_id']}">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="deleteImg(${response['image_id']})">Delete</a>
                                            </div>
                                        </div>
                                    </div>`;

                $("#productImages").append(imgCardHTML);
            },
            complete: function(file) {
                this.removeFile(file);
            },
        });
    </script>

    <script>
        function deleteImg(temp_img_id) {
            $.ajax({
                url: "{{ route('temp_images_delete') }}",
                type: "post",
                data: {
                    temp_img_id: temp_img_id,
                },
                dataType: "json",
                success: function(response) {
                    if (response["status"] == true) {
                        $("#img-row-" + temp_img_id).remove();
                    } else {
                        alert("Failed to delete the uploaded image.");
                    }
                },
                error: function() {
                    alert("Image deletion operation failed.");
                }
            });
        }
    </script>
@endsection
