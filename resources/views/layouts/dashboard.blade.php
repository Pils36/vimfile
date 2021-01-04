
<!DOCTYPE html>
<html>
@include('includes.dashtop')

<body class="hold-transition skin-blue sidebar-mini">



@include('includes.message')
@include('includes.dashmodal')



  <main class="py-4">
    @yield('dashContent')
  </main>


@include('includes.dashfooterjs')

</body>
</html>

