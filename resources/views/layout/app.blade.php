<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Up Tech - Soluções em TI</title>

        <!-- Custom styles for this template-->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }

            body {
                padding: 100px;
            }

            .container {
                max-width: 960px;
            }

            .pricing-header {
                max-width: 700px;
            }

        </style>

    </head>

    <body>

        @component('component.navbar', ['currentRoute' => $currentRoute])
        @endcomponent

        <main class="container">

            @hasSection ('body')
                @yield('body')
            @endif

            @component('component.footer')
            @endcomponent

        </main>
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/service.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/order.js') }}" type="text/javascript"></script>

        @hasSection ('javascript')
            @yield('javascript')
        @endif

    </body>
</html>
