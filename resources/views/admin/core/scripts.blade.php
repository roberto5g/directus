<!-- Bootstrap and necessary plugins -->
<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-fileinput/fileinput.js') }}"></script>
<script src="{{ asset('js/bootstrap-fileinput/pt-BR.js') }}"></script>
<script src="{{ asset('js/bootstrap-fileinput/theme.js') }}"></script>
<script src="{{ asset('js/bootstrap-fileinput/popper.min.js') }}"></script>
<script src="{{ asset('js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/vendor/pace.min.js') }}"></script>
<!-- Plugins and scripts required by all views -->
<script src="{{ asset('js/vendor/Chart.min.js') }}"></script>
<script src="{{ asset('js/vendor/datatables.js')}}"></script>
<script src="{{ asset('js/vendor/multiselect.js') }}"></script>
<script src="{{ asset('js/vendor/toastr.min.js') }}"></script>
{{--<script src="{{ asset('js/vendor/chosen.jquery.js') }}"></script>--}}
<script src="{{ asset('js/vendor/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.validate.js') }}"></script>
<script src="{{ asset('js/vendor/select2.min.js') }}"></script>
<script src="{{ asset('js/vendor/jquery.loadingModal.js') }}"></script>
<script src="{{ asset('js/vendor/croppie.js') }}"></script>
<script src="{{ asset('js/vendor/moment.min.js') }}"></script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>



<script src="{{ asset('js/vendor/jquery.maskMoney.min.js') }}"></script>

<!-- CoreUI main scripts -->
<script src="{{ asset('js/app.js')}}"></script>

<script>
    //chamada do ready
    $(function () {

        // ajustes do toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "4000",
            "hideDuration": "1000",
            "timeOut": "4000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    });
</script>