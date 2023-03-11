@if (Session::has('success'))
    <script>
        showMessage('success', '{{ Session::get('success') }}');
    </script>
@elseif(Session::has('error'))
    <script>
        showMessage('success', '{{ Session::get('error') }}');
    </script>
@elseif(Session::has('warning'))
    <script>
        showMessage('success', '{{ Session::get('warning') }}');
    </script>
@elseif(Session::has('info'))
    <script>
        showMessage('success', '{{ Session::get('info') }}');
    </script>
@endif
