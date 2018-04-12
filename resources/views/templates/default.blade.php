<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>De Vallei</title>
    
    {{-- pulling in Bootstrap 4 CSS --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">

    {{-- pulling in custom styles.css --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script type="text/javascript" src="{{ asset('js/fontawesome/fontawesome-all.js') }}"></script>

    {{-- pulling in jQeury 3.2.1 --}}
    <script type="text/javascript" src="{{ asset('js/jquery/jquery-3.2.1.js') }}"></script>

    {{-- pulling in Bootstrap 4 JS --}}
    <script type="text/javascript" src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

    {{-- pulling in custom JS --}}
    {{-- <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script> --}}

    {{-- pulling in Axios --}}
    {{-- <script src="js/axios/axios.js"></script>     --}}

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
                <div class="container">
                    @include('templates.partials.messages')
                    @yield('content')
                </div>
                    
            </div>
        </div>
    </div>
    <script src="{{ asset('js/all.js') }}"></script>

    @yield('javascript')

    {{-- pulling in Vue.JS 2.5.13 --}}
    {{-- <script src="{{ asset('js/vue/vue.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/vue/main.js') }}"></script> --}}
</body>
</html>