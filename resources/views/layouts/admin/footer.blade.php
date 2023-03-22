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

    <!-- Loading Mask -->
    <div>
        <div id="loadingmask2" class="nodisplay">
            <div id="loadingdots" class="nodisplay">
                <div id="loadingdots_1" class="loadingdots nodisplay">L</div>
                <div id="loadingdots_2" class="loadingdots nodisplay">O</div>
                <div id="loadingdots_3" class="loadingdots nodisplay">A</div>
                <div id="loadingdots_4" class="loadingdots nodisplay">D</div>
                <div id="loadingdots_5" class="loadingdots nodisplay">I</div>
                <div id="loadingdots_6" class="loadingdots nodisplay">N</div>
                <div id="loadingdots_7" class="loadingdots nodisplay">G</div>
            </div>
        </div>
    </div>
    <!-- ./Loading Mask -->

    <!-- All Theme Related Scripts File -->
    <x-theme-scripts></x-theme-scripts>
    <!-- Custom Page Scripts -->
    @yield('custom-page-scripts')
</body>

</html>
