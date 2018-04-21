@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Importeren</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <form action="{{ Route('leerlingen.import.upload') }}" method="POST" enctype="multipart/form-data">
            <label class="btn btn-default">
                Zoek bestand: <input name="file" type="file" hidden>
            </label>
            {{-- <input name="file" type="file" class="form-control"> --}}
            <input type="submit" class="btn btn-success" value="importeren">
            {{ csrf_field() }}
        </form>
    </div>
@endsection