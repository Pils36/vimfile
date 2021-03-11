    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('success'))
        <script>
            swal('Good', '{{ session("success") }}', 'success');
        </script>

    @elseif(session('warning'))

        <script>
            swal('Oops', '{{ session("warning") }}', 'error');
        </script>

    @elseif(session('info'))

        <script>
            swal('Oops', '{{ session("info") }}', 'info');
        </script>

    @endif