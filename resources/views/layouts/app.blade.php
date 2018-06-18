<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>
</head>
<body>
    <div id="app">
       
       @include('partials.menu')

       <div class="container">
           <div class="row">
               <div class="col-md-8 col-md-offset-2">
                 @include('partials.flash')
               </div>
           </div>
       </div>

       @yield('content')
    </div>
<br><br><br><br><hr>
    <div class="container">
           
               <div class="col-md-8">
              
               @include('partials.footer')
                 
               
           </div>
       </div>
    

    <!-- Scripts -->
    @yield('javascripts')
    <script src="{{ asset('js/app.js') }}"></script>
   
</body>
</html>
