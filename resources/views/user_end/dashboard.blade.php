@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user_dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Profile</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-11">
        <div class="container mt-5">
            <div class="row">
                @if (Session::has('login_success'))
                    <div class="col-md-12 mb-3" id="msg-login-success">
                        <div class="alert alert-primary px-4">
                            <h6><i class="icon fa fa-check"></i> {!! Session::get('login_success') !!}</h6>
                        </div>
                    </div>
                @elseif (Session::has('success'))
                    <div class="col-md-12 mb-3" id="msg-success">
                        <div class="alert alert-success px-4">
                            <h6><i class="icon fa fa-check"></i> {!! Session::get('success') !!}</h6>
                        </div>
                    </div>
                @elseif (Session::has('error'))
                    <div class="col-md-12 mb-3" id="msg-error">
                        <div class="alert alert-danger px-4">
                            <h6><i class="icon fa fa-ban"></i> {!! Session::get('error') !!}</h6>
                        </div>
                    </div>
                @endif
                <div class="col-md-3">
                    @include('includes.account_panel')
                </div>
                <div class="col-md-9">
                    <div class="card border mb-5">
                        <div class="card-header bg-dark">
                            <h2 class="h5 mb-0 pt-2 text-white pb-2">Personal Information</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <form id="update-profile-form">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" placeholder="Enter Your Name"
                                            class="form-control" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender">Gender</label>
                                        <select class="form-control form-select rounded-0" id="gender" name="gender">
                                            <option selected value="">Select Your Gender</option>
                                            <option value="M" {{ Auth::user()->gender == 'M' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="F" {{ Auth::user()->gender == 'F' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="O" {{ Auth::user()->gender == 'O' ? 'selected' : '' }}>
                                                Others</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" placeholder="Enter Your Email"
                                            class="form-control bg-white" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" placeholder="Enter Your Phone"
                                            class="form-control" value="{{ Auth::user()->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Profile Picture</label>
                                        <div id="imageSelector" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">
                                                <br>Drop image here or click to upload.<br><br>
                                            </div>
                                        </div>
                                        <input type="hidden" name="image_id" id="image_id" value="">
                                    </div>
                                    <div class="row mb-3" id="productImages">
                                        @if (Auth::user()->image != null)
                                            <div class="col-sm-6 col-md-3 col-lg-3 col-6"
                                                id="profile-picture-row-{{ Auth::user()->id }}">
                                                <div class="card shadow-sm">
                                                    <div class="card-body">
                                                        <img src="{{ asset('uploads/user/thumbnails/' . Auth::user()->image) }}"
                                                            class="card-img-top rounded mb-3"
                                                            alt="{{ Auth::user()->name }}">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                            onclick="deleteProfilePicture()">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-sm btn-dark">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-header bg-dark">
                            <h2 class="h5 mb-0 pt-2 text-white pb-2">Billing Address</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <form id="billing-address-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="first_name">First Name</label>
                                                <input type="text" name="first_name" id="first_name"
                                                    class="form-control" placeholder="First Name"
                                                    value="{{ !empty($customer_address->first_name) ? $customer_address->first_name : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" name="last_name" id="last_name"
                                                    class="form-control" placeholder="Last Name"
                                                    value="{{ !empty($customer_address->last_name) ? $customer_address->last_name : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Email"
                                                    value="{{ !empty($customer_address->email) ? $customer_address->email : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="country">Country</label>
                                                <select name="country" id="country" class="form-control">
                                                    <option value="" selected>Select a Country</option>
                                                    @if (!empty($countries))
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}"
                                                                {{ !empty($customer_address->country_id) && $customer_address->country_id == $country->id ? 'selected' : '' }}>
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address">Address</label>
                                                <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ !empty($customer_address->address) ? $customer_address->address : '' }}</textarea>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="house">House</label>
                                                <input type="text" name="house" id="house" class="form-control"
                                                    placeholder="Apartment, suite, unit, etc. (Optional)"
                                                    value="{{ !empty($customer_address->house) ? $customer_address->house : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="city">City</label>
                                                <input type="text" name="city" id="city" class="form-control"
                                                    placeholder="City"
                                                    value="{{ !empty($customer_address->city) ? $customer_address->city : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="state">State</label>
                                                <input type="text" name="state" id="state" class="form-control"
                                                    placeholder="State"
                                                    value="{{ !empty($customer_address->state) ? $customer_address->state : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="zip">Zipcode</label>
                                                <input type="text" name="zip" id="zip" class="form-control"
                                                    placeholder="Zipcode"
                                                    value="{{ !empty($customer_address->zip) ? $customer_address->zip : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="country_code">Country Code</label>
                                                <input type="text" name="country_code" id="country_code"
                                                    class="form-control" placeholder="Country Code"
                                                    value="{{ !empty($customer_address->country_code) ? $customer_address->country_code : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label for="phone">Phone No.</label>
                                                <input type="text" name="phone" id="phone" class="form-control"
                                                    placeholder="Phone No."
                                                    value="{{ !empty($customer_address->phone) ? $customer_address->phone : '' }}">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-sm btn-dark">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            window.scrollTo(0, 0);
        });
    </script>

    <script>
        setTimeout(function() {
            $('#msg-login-success').fadeOut('slow');
        }, 10000);

        setTimeout(function() {
            $('#msg-success').fadeOut('slow');
        }, 10000);

        setTimeout(function() {
            $('#msg-error').fadeOut('slow');
        }, 10000);
    </script>

    <script>
        $("#update-profile-form").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('user_update_profile') }}",
                type: "put",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#gender').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#email').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#phone').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.reload();
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        let errors = response['msg'];

                        if (errors['name']) {
                            $('#name').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['name']);
                        } else {
                            $('#name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['gender']) {
                            $('#gender').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['gender']);
                        } else {
                            $('#gender').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['email']) {
                            $('#email').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['email']);
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['phone']) {
                            $('#phone').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['phone']);
                        } else {
                            $('#phone').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while updating your profile!");
                },
            });
        });
    </script>

    <script>
        $("#billing-address-form").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('user_save_billing_address') }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        window.location.reload();
                    } else {
                        $('button[type=submit]').prop('disabled', false);
                        let errors = response['errors'];

                        if (errors['first_name']) {
                            $('#first_name').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['first_name']);
                        } else {
                            $('#first_name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['last_name']) {
                            $('#last_name').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['last_name']);
                        } else {
                            $('#last_name').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['email']) {
                            $('#email').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['email']);
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['country_code']) {
                            $('#country_code').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['country_code']);
                        } else {
                            $('#country_code').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['phone']) {
                            $('#phone').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['phone']);
                        } else {
                            $('#phone').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['country']) {
                            $('#country').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['country']);
                        } else {
                            $('#country').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['address']) {
                            $('#address').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['address']);
                        } else {
                            $('#address').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['city']) {
                            $('#city').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['city']);
                        } else {
                            $('#city').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['state']) {
                            $('#state').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['state']);
                        } else {
                            $('#state').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['zip']) {
                            $('#zip').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['zip']);
                        } else {
                            $('#zip').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while saving the billing address!");
                },
            });
        });
    </script>

    <script>
        Dropzone.autoDiscover = false;
        const dropzone = $("#imageSelector").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('temp_images_create') }}",
            type: 'post',
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/jpg,image/png",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                //console.log(response);
            }
        });
    </script>

    <script>
        function deleteProfilePicture() {
            let userId = "{{ Auth::user()->id }}";

            $.ajax({
                url: "{{ route('user_profile_picture_delete', Auth::user()->id) }}",
                type: "post",
                dataType: "json",
                success: function(response) {
                    if (response["status"] == true) {
                        $("#profile-picture-row-" + userId).remove();
                    } else {
                        alert("Failed to delete your profile_picture.");
                    }
                },
                error: function() {
                    alert("Image deletion operation failed.");
                }
            });
        }
    </script>
@endsection

{{-- {{ dd(Session::all()) }} --}}
