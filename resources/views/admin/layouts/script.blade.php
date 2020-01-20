<!-- Bootstrap core JavaScript-->
{{--<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>--}}

<!-- Core plugin JavaScript-->
{{--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>--}}

<!-- Custom scripts for all pages-->
<script src="{{ asset('hb/js/app.js') }}"></script>
<script src="{{ asset('hb/ckeditor/ckeditor.js') }}"></script>

<!-- Page level plugins -->
{{--<script src="vendor/chart.js/Chart.min.js"></script>--}}

<!-- Page level custom scripts -->
{{--<script src="js/demo/chart-area-demo.js"></script>--}}
{{--<script src="js/demo/chart-pie-demo.js"></script>--}}

<script>
@if($errors->any())
    @foreach ($errors->all() as $error)
            window.toastr.error('{{ get_validate_error($error) }}');
    @endforeach
@endif
</script>
