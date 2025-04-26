<!DOCTYPE html>
<html lang="en">

@include('backend.layouts.header')

<body>
    <!-- Pre-loader start -->
    @include('backend.layouts.preloader')
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <!-- Nav Start -->
            @include('backend.layouts.nav')
            <!-- Nav End -->

            <!-- Sidebar chat start -->
            @include('backend.layouts.sidebar_chat')
            <!-- Sidebar inner chat start-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- Sidebar starts -->
                    @include('backend.layouts.sidebar')
                    <!-- Sidebar end -->
                    <div class="pcoded-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.layouts.footer')
</body>

</html>
