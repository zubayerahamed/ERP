        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2023 - {{ date('Y') }} <a href="https://zubayerahamed.com">Zubayer Ahamed</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('/assets/admin-assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/assets/admin-assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('/assets/admin-assets/js/toastr.min.js') }}"></script>
    <!-- Vendor Scripts -->
    @yield('vendor-scripts')
    <!-- Custom JS -->
    <script src="{{ asset('/assets/admin-assets/js/kit.js') }}"></script>
    <script src="{{ asset('/assets/admin-assets/js/kit-ui.js') }}"></script>
    <script src="{{ asset('/assets/admin-assets/js/kit-functions.js') }}"></script>
    <x-toaster-message></x-toaster-message>
    <!-- Custom Page Scripts -->
    @yield('custom-page-scripts')

</body>

</html>
