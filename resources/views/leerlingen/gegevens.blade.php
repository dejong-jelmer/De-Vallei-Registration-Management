@extends('templates.default')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Leerlingen</h1>
        <hr>
        @isset($studentDatas)
        @if(!$studentDatas->count())
            <p>Geen leerlingen gevonden.</p>
        @endif
        @endisset
    </div>
</div>
@isset($studentDatas)
@if($studentDatas->count())
<div class="row">
    <div class="col-12">    
        <div class="col-2 float-left">
            <h6><p>Leerlingen:</p></h6>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">    
        <form id="form" name="form" action="{{ URL::to('/leerling') }}" method="GET">           
            <div class="col-6 float-left">
                <select onchange="this.form.action = setSubmitIdToUrl(this.form.action, this.value);"class="form-control float-left" name="students">
                    <option value=""> Selecteer een leerling </option>
                    @foreach($studentDatas as $studentData)
                        <option value="{{ $studentData->student->id }}">
                            {{ $studentData->voornaam }} {{ $studentData->tussenvoegsel }} {{ $studentData->achternaam }}
                        </option>
                        @php {{unset($studentData);}} @endphp
                    @endforeach
                </select>
            </div>
            <div class="col-2 float-left">
                <button id="formSubmit" onclick="this.form.submit()" class="btn btn-outline-success text-center hidden"><i class="far fa-check-circle"></i></button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endif
@endisset
@isset($student) 
@isset($coaches)
@isset($studentData) 

<div class="row">
    <div class="col-12">
        <div class="col-8 float-left">   
            <h5>Gegevens van: {{ $studentData['voornaam'] }} {{ $studentData['tussenvoegsel'] }} {{ $studentData['achternaam'] }}</h5>
        </div>
        <div id="formSubmit" class="col-2 float-left hidden">
            <button onclick="document.form.submit()" class="btn btn-outline-success btn-block text-center"><i class="far fa-check-circle"></i></button>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <form id="form" name="form" class="" action="{{ URL::to("/leerling/$student->id/aanpassen") }}" method="POST">
            <br>
            <div class="row">
                <div class="col-6">
                    <span class="col-5 float-left">
                        <label for="id">Coachgroep:</label>
                    </span>
                    &nbsp;
                    <span class="col-6 float-left">
                        <select class="form-control form-control-sm" name="coach_id">
                            @if(null == $student->coach) <option selected> Geen coachgroep </option>>@endif
                            @foreach($coaches as $coach)
                                <option @isset($student->coach) @if($coach->id == $student->coach->id) selected @endif @endisset value="{{ $coach->id }}">{{ $coach->coach }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
                <div class="col-6">
                <span class="col-5 float-left">
                    <label for="id" >Kleur:</label>
                </span>
                &nbsp;
                <span class="col-6 float-left">
                    <select class="form-control form-control-sm colorSelect" name="color_id" style="text-align: center; background: {{ $colors[$student->color_id-1]->color}}">
                        <option value=""></option>
                        @foreach($colors as $color)
                            <option @if($student->color_id == $color->id) selected @endif value="{{ $color->id }}" style="background:{{ $color->color }}">&nbsp;</option>
                        @endforeach
                    </select>
                </span>
            </div>
                @foreach($studentData as $name => $data)
                    @if(!(stripos($name, '_at') !== false) && !(stripos($name, 'delete') !== false)) 
                    <div class="col-6">
                        <span class="col-5 float-left">
                            <label for="id" >{{ ucfirst(str_replace('_','&nbsp;', $name)) }}:</label>
                        </span>
                        &nbsp;
                        <span class="col-6 float-left">
                            <input name="{{ $name }}"  @if($name == 'id' || $name == 'student_id') readonly @endif name="id" class="form-control form-control-sm" type="text" value="{{ $data }}">   
                        </span>
                    </div>
                    @endif
                @endforeach
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="col-2 offset-10 float-left">
            <br>
            <br>
            <div class="form-check">
                <label class="form-check-label" for="deleteCheck">
                   <input id="deleteCheck" name="deleteCheck" class="form-check-input" type="checkbox">
                    Verwijderen? 
               </label>
            </div>
            <form name="deleteForm" action="{{ URL::to("leerling/$student->id/verwijderen") }}" method="POST">
                <button id="deleteBtn" onclick="deleteConfirm(event, 'de gegevens van {{ $student->naam }}');" hidden class="btn btn-block btn-outline-danger text-center" ><i class="far fa-times-circle"></i></button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>


@endisset
@endisset
@endisset



@endsection