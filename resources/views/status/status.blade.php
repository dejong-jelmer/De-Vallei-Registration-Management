@extends('templates.default')


@section('content')
    
    @isset($statuses)
        <form name="form" class="form-inline" action="#" method="POST">
            <label class="form-inline" for="statuses">Statusen:</label>
            &nbsp;
            <select onchange="document.form.action += '/' + this.value" class=form-control name="statuses">
                <option value="">-- Statusen --</option>
                @foreach($statuses as $status)
                   <option value="{{ $status->id }}">{{ $status->status }}</option> 

                @endforeach
            </select>
        </form>
    @endisset

@endsection