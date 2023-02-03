<!doctype html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
            <!-- Page Title -->
            <title>@yield('title')  |  Bridget's Station</title>

            <!-- Icon -->
            <link rel="icon" type="image/x-icon" href="{{ asset('dist/images/logo_bridget_station.png') }}" />

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            <!-- Icons -->
            <link rel="stylesheet" href="{{ asset('dist/css/boxicons.css') }}" />

            <!-- Datatable CSS -->
            <link rel="stylesheet" href="{{ asset('dist/css/datatables.css') }}" type="text/css" >

            <!-- Vendors CSS -->
            <link rel="stylesheet" href="{{ asset('dist/css/apex-charts.css') }}" />

            <!-- Styles -->
            <link rel="stylesheet" href="{{ asset('dist/output.css') }}" >
            @vite('resources/css/app.css')
        </head>
        <body>

            @guest
                <!-- Login Route -->
                @if (Route::has('login'))
                    @yield('login_content')
                @endif
                @else
                    <!-- Admin User -->
                    @if( Auth::user()->user_type == 'Admin')
                        @yield('modal')
                        @include('admin.navbar')
                        <div class="flex overflow-hidden bg-gray-800 pt-16">
                            @include('admin.sidebar')
                            <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
                            <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
                                @yield('admin_content')
                                @include('admin.footer')
                            </div>
                        </div>

                    <!-- Staff User -->
                    @elseif( Auth::user()->user_type == 'Staff')
                        @yield('modal')
                        @yield('staff_content')
                        @include('staff.footer')
                @endif
            @endguest

            <!-- Vendors JS -->
            <script src="{{ asset('dist/js/apexcharts.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
            <script src="{{ asset('dist/js/jquery.js') }}"></script>
            <script src="{{ asset('dist/js/pages-account-settings-account.js') }}"></script>

            <!-- Bootbox scripts -->
            <script src="{{ asset('dist/js/bootbox.min.js')}}"></script>

            <!-- POST & GET Request scripts -->
            <script src="{{ asset('dist/js/core.js') }}"></script>

            <!-- Download HTML to PDF scripts -->
            <script src="{{ asset('dist/js/html2pdf.bundle.min.js') }}" type="text/javascript"></script>
            
            <!-- Data Table scripts -->
            <script src="{{ asset('dist/js/datatables.js') }}" type="text/javascript" charset="utf8"></script>  
            <script src="https://momentjs.com/downloads/moment-with-locales.min.js" type="text/javascript" ></script>

            <script async defer src="https://buttons.github.io/buttons.js"></script>
            <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>

            <!-- Generate PDF -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

    @yield('scripts')
        </body>
    </html>
