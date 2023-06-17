<!DOCTYPE html>

<html lang="en">


<head>

@include('layout.partials.head')

</head>


<body>

<div class="container-scroller">

  @include('layout.partials.nav')

  <div class="container-fluid page-body-wrapper">

    @include('layout.partials.sidebar')

    <div class="main-panel">

      @yield('content-wrapper')

      <!-- content-wrapper ends -->

    </div>

    <!-- main-panel ends -->

  </div>

  <!-- page-body-wrapper ends -->

</div>

<!-- container-scroller -->

@include('layout.partials.footer-scripts')

@yield('page-script')

</body>

</html>
