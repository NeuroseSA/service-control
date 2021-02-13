<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Up Tech - Soluções em TI</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">


    <style>
        body{
            padding: 20px;
        }

        .navbar{
            margin-bottom: 20px;
        }
    </style>
</head>

<body >

    <div class="container">
        @component('component.navbar', ["currentRoute" => $currentRoute])
            
        @endcomponent
        <main role="main">

            @hasSection ('body')
                @yield('body')                          
            @endif

        </main>
    </div>


<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
<script src="{{asset('js/service.js')}}" type="text/javascript"></script>

@hasSection ('javascript')
    @yield('javascript')  
@endif
    
</body>


</html>