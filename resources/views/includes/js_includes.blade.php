<!-- jQuery -->
<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin-assets/js/demo.js') }}"></script>
{{-- Summernote for text editing --}}
<script src="{{ asset('admin-assets/plugins/summernote/summernote.min.js') }}"></script>
{{-- Dropzone --}}
<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
{{-- Select2 --}}
<script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>
{{-- DateTimePicker --}}
<script src="{{ asset('admin-assets/plugins/datetime/datetimepicker.js') }}"></script>
{{-- Ajax Setup for CSRF Token --}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $(".summernote").summernote({
            height: 250,
        });
    });
</script>
{{-- Custom JS Scripts --}}
@yield('customJs')
