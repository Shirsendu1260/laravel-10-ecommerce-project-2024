@extends('user_end.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('userend_home') }}">Home</a></li>
                    <li class="breadcrumb-item">{{ $page_data->name }}</li>
                </ol>
            </div>
        </div>
    </section>
    <section class="section-10">
        @if ($page_data->slug == 'contact-us')
            <div class="container py-5">
                <div class="row">
                    @if (Session::has('success'))
                        <div class="col-md-12 mb-3" id="msg-success">
                            <div class="alert alert-success px-4">
                                <h6><i class="icon fa fa-check"></i> {!! Session::get('success') !!}</h6>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="section-title">
                    <h2>{{ $page_data->name }}</h2>
                </div>
                <div class="row" style="padding: 0 12px;">
                    <div class="col-md-6 ps-0 pe-lg-5">
                        {!! $page_data->content !!}
                    </div>
                    <div class="col-md-6 pe-0">
                        <form class="shake" role="form" id="contactForm">
                            <div class="mb-3">
                                <input class="form-control fw-normal rounded-0" id="name" type="text" name="name"
                                    placeholder="Name">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <input class="form-control fw-normal rounded-0" id="email" type="email" name="email"
                                    placeholder="Email">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <input class="form-control fw-normal rounded-0" id="msg_subject" type="text"
                                    name="subject" placeholder="Subject">
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control fw-normal rounded-0" rows="4" id="message" name="message" placeholder="Message"></textarea>
                                <p></p>
                            </div>
                            <div class="form-submit">
                                <button class="btn btn-dark" type="submit" id="form-submit"><i
                                        class="material-icons mdi mdi-message-outline"></i> Send Message</button>
                                {{-- <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="container py-5">
                <div class="row">
                    @if (Session::has('success'))
                        <div class="col-md-12 mb-3" id="msg-success">
                            <div class="alert alert-success px-4">
                                <h6><i class="icon fa fa-check"></i> {!! Session::get('success') !!}</h6>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="section-title">
                    <h2>{{ $page_data->name }}</h2>
                </div>
                <div>{!! $page_data->content !!}</div>
            </div>
        @endif
    </section>
@endsection

@section('customJs')
    <script>
        setTimeout(function() {
            $('#msg-success').fadeOut('slow');
        }, 5000);
    </script>

    <script>
        $("#contactForm").submit(function(event) {
            event.preventDefault();
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: "{{ route('userend_send_contact_mail') }}",
                type: "post",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if (response['status'] == true) {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#email').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#msg_subject').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');
                        $('#message').removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html('');

                        window.location.href = "{{ route('userend_static_page', 'contact-us') }}";
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

                        if (errors['email']) {
                            $('#email').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['email']);
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['subject']) {
                            $('#msg_subject').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['subject']);
                        } else {
                            $('#msg_subject').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }

                        if (errors['message']) {
                            $('#message').addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['message']);
                        } else {
                            $('#message').removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback').html('');
                        }
                    }
                },
                error: function(jqXHR, exception) {
                    alert("Something went wrong while submitting contact form!");
                }
            });
        });
    </script>
@endsection
