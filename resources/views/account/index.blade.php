@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Account</h1>
        <hr>
    </div>
</div>
<div class="row">
     
    <div class="col-5 offset-1 float-left">
        <form action="{{ Route('account.create') }}" method="POST">
            <div class="form-group">
                <label for="naam">Voer de gebruikersnaam in:</label>
                <input name="naam" class="form-control" type="naam" placeholder="naam">
            </div>
            <div class="form-group">
                <label for="email">Voer het email-adres in:</label>
                <input name="email" class="form-control" type="email" placeholder="Email">
            </div>
            <button class="btn btn-default float-right">Aanmaken</button>
            {{ csrf_field() }}
        </form>
        
    </div>
    <div class="col-5 offset-1 float-left">
        @if(null !== session('user'))
            <form action="{{ Route('account.send', ['id' => session('user')->id ]) }}" method="POST">
                <input type="hidden" name="wachtwoord" value="{{ session('wachtwoord') }}">
                <p><u>Gebruiker aangemaakt</u></p>
                <p>
                    Voor: <b>{{ session('user')->naam }}</b><br>
                    met email: <b>{{ session('user')->email }}</b><br>
                    met wachtwoord: <b>{{ session('wachtwoord') }}</b>
                </p>
                Gebruiker inloggegevens
                <button class="btn btn-sm btn-success" type="submit">sturen</button>
                {{ csrf_field() }}

            </form>

        
    @endif
    </div>


</div>

@endsection