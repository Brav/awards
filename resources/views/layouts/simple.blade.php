<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">


        <title>{{ config('app.name', 'VetPartners') }}</title>

        <meta name="description" content="Complaint Form">
        <meta name="author" content="dushan887mob3">
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ asset('css/dashmix.css') }}">

        <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
        <link rel="stylesheet" id="css-theme" href="{{ asset('css/themes/xinspire.css') }}">
        @yield('css_after')

        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-G98990XJNN"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-G98990XJNN');
        </script>
    </head>
    <body>
        <!-- Page Container -->
        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="row no-gutters justify-content-center bg-body-dark">
                    <div class="hero-static col-sm-12 col-md-10 col-xl-8 align-items-center p-2 px-sm-0 bg-body-white">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-{{ session('status.type') }}" role="alert">
                                    {{ session('status.message') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <!-- Home Page start -->
                            <h1>AWARDS NOMINATION</h1>
                            <h4>Submit a nomination below by clicking in the award you wish to nominate for </h4>
                        </div>
                        @yield('content')
                    </div>

                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        @include('modals/small')
        @include('modals/big')

        <!-- Dashmix Core JS -->
        <script src="{{ asset('js/dashmix.app.js') }}"></script>

        <!-- Laravel Scaffolding JS -->

        @yield('js_after')
    </body>
</html>
