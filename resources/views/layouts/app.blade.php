<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!--    Document Title-->
    <title> @yield('title', 'Shirin Travel Agency Landing Page')</title>


    <!--    Favicons-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">

    <!--    Stylesheets-->
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Volkhov:wght@700&display=swap"
        rel="stylesheet">

    @stack('styles') {{-- ← сюда будут добавляться CSS конкретной страницы --}}

</head>

<body>

    <!--    Main Content-->
    <main class="main" id="top">

        {{-- Навигация --}}
        <x-navbar />

        {{-- Контент страницы , надо сделать отступ с верху что бы не перекрывался --}}

        <div style="padding-top: @yield('page-offset', '7rem')">
            @yield('content')
        </div>


        {{-- Футер --}}
        <x-footer />
    </main>

    <!--    End of Main Content-->


    <!-- JavaScript -->

    <script src="{{ asset('assets/vendors/@popperjs/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    @stack('scripts') {{-- ← сюда будут добавляться JS конкретной страницы --}}

</body>


</html>