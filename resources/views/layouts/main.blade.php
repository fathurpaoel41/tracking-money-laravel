<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    @include('partials.head')
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('partials.sidebar')
            
            <div class="layout-page">
                @include('partials.navbar')
                
                <div class="content-wrapper">
                    @yield('content')
                    
                    @include('partials.footer')
                    
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    
    <!-- Core JS -->
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
    
    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    
    <!-- Main JS -->
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    
    <!-- Page JS -->
    @yield('page-scripts')
    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>