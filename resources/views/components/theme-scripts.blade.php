<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('/assets/admin-assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/assets/admin-assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('/assets/admin-assets/js/toastr.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('/assets/admin-assets/js/select2.full.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('/assets/admin-assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/jszip.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/buttons.colVis.min.js') }}"></script>
<!-- Cropper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<!-- dropzonejs -->
<script src="{{ asset('/assets/admin-assets/js/dropzone.min.js') }}"></script>
<!-- Vendor Scripts -->
@yield('vendor-scripts')
<!-- Custom JS -->
<script src="{{ asset('/assets/admin-assets/js/kit.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/kit-ui.js') }}"></script>
<script src="{{ asset('/assets/admin-assets/js/kit-functions.js') }}"></script>
<x-toaster-message></x-toaster-message>
