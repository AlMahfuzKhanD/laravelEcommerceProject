<!DOCTYPE html>
<html lang="en">

@include('dashboard::layouts.header')

<body>
    <!-- Pre-loader start -->
    @include('dashboard::layouts.preloader')
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <!-- Nav Start -->
            @include('dashboard::layouts.nav')
            <!-- Nav End -->

            <!-- Sidebar chat start -->
            @include('dashboard::layouts.sidebar_chat')
            <!-- Sidebar inner chat start-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- Sidebar starts -->
                    @include('dashboard::layouts.sidebar')
                    <!-- Sidebar end -->
                    <div class="pcoded-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard::layouts.footer')
</body>

</html>
