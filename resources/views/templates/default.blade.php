<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>De Vallei</title>

    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">  
        
</head>
<body>
    @if(Auth::user())
        @include('templates.partials.nav-bar')
    @endif
    <div class="container-fluid">
            <div class="row">
                @if(Auth::user())
                    <div class="col-0 col-sm-3 col-md-2" style="padding: 0;">
                        @include('templates.partials.side-menu')
                    </div>
                @endif
                <div class="{{ Auth::user() ? 'col-12 col-sm-9 col-md-10' : 'col-12' }}">
                    @include('templates.partials.messages')
                    <div id="app">
                        @yield('content')   
                    </div>
                </div>
            </div>
        </div>
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('javascript')
    

</body>
</html>