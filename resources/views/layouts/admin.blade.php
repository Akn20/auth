<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('partials.head')
</head>

<body>

    @include('partials.sidebar')

    @include('partials.navbar')

    <main class="nxl-container">
       <div class="nxl-content px-4">
        @yield('content')
    </div>

        <!-- [ Footer ] start -->
        @include('partials.footer')
        <!-- [ Footer ] end -->
    </main>
<!-- hello -->
    <!--! BEGIN: Vendors JS !-->
    @include('partials.scripts')
    <!--! END: Theme Customizer !-->
</body>

</html>
