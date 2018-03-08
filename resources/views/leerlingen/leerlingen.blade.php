@extends('templates.default')

@section('content')

<div class="row">
    <div class="col-8">
        <h1>Zoek resultaat</h1>
        <hr>
        @if(!isset($student) && !count($students))
            <p>Niets gevonden.</p>
        @endif
        @isset(($student))
            {{ $student }}
            {{ $student->studentData }}

        @endisset
    
        @isset($students)
            @if($students->count() > 1)
                <form name="form" class="form-inline" action="{{ URL::to('/zoeken') }}" method="POST">
                    <label class="form-inline" for="students">Resultaten:</label>
                    &nbsp;
                    <select onchange="document.form.action += '/' + this.value" class=form-control name="students">
                        <option value="">-- Resultaten --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">
                                {{ $student->voornaam }} {{ $student->tussenvoegsel }} {{ $student->achternaam }}
                            </option>
                        @endforeach
                    </select>
                    {{ csrf_field() }}
                </form>
                <button onclick="document.form.submit()" class="btn btn-info float-right">Selecteren</button>
            @endif
        @endisset
    </div>
</div>



@endsection