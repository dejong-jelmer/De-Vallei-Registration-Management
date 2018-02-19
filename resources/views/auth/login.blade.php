@extends('templates.default')


@section('content')

<div class="col-sm-4 col-8 offset-2 offset-sm-4" style="margin-top: 15%;">
    <form action="{{ URL::to('/login') }}" method="POST">
        <div class="form-group">
            <input name="email" class="form-control" type="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input name="password" class="form-control" type="password" placeholder="Wachtwoord">
        </div>
        <button class="btn btn-default float-right">Inloggen</button>
        {{ csrf_field() }}
    </form>
</div>

@endsection