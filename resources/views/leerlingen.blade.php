<html lang="en">

<head>

    <title>Leerlingen uploaden / downloaden</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    
    <style>
        [hidden] {
            display: none !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-default">

        <div class="container-fluid">

            <div class="navbar-header">

                <a class="navbar-brand" href="#">Leerlingen uploaden / downloaden</a>

            </div>

        </div>

    </nav>

    <div class="container">

        <a href="{{ URL::to('/export/leerlingen/xls/leerlingen') }}"><button class="btn btn-success">Download leerlingen xls</button></a>

        <a href="{{ URL::to('/export/leerlingen/xlsx/leerlingen') }}"><button class="btn btn-success">Download leerlingen xlsx</button></a>

        <a href="{{ URL::to('/export/leerlingen/csv/leerlingen') }}"><button class="btn btn-success">Download leerlingen CSV</button></a>
        <br>
        <br>
        <a href="{{ URL::to('/export/leerlingen/xls/aanwezigheid') }}"><button class="btn btn-success">Download aanwezigheid xls</button></a>
        <a href="{{ URL::to('/export/leerlingen/xlsx/aanwezigheid') }}"><button class="btn btn-success">Download aanwezigheid xlsx</button></a>
        <a href="{{ URL::to('/export/leerlingen/csv/aanwezigheid') }}"><button class="btn btn-success">Download aanwezigheid CSV</button></a>
        
        <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('/import/leerlingen') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
            {{-- <label class="btn btn-default"> --}}
                {{-- Zoek bestand: <input type="file" hidden> --}}
            {{-- </label> --}}
            <input type="file" name="file">

            <button class="btn btn-primary">Bestand importeren</button>
            {{ csrf_field() }}

        </form>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

    </div>

</body>

</html>