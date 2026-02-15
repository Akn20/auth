<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('partials.head')

    <style>
        .form-label {
            font-size: 14px;
            font-weight: 600;
        }

        .form-control,
        .form-select,
        textarea {
            font-size: 14px !important;
        }

        textarea.form-control {
            height: auto;
        }
    </style>

</head>

<body>

    @include('partials.sidebar')

    @include('partials.navbar')

    <main class="nxl-container">
        <div class="nxl-content px-4">
            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- ERROR MESSAGE --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

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