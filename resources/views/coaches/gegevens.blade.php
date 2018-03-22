@extends('templates.default')

@section('content')

@include('templates.partials.coach')



@isset($coachDatas)
    @if(!$coachDatas->count())
        <p>Geen coach gevonden.</p>
    @endif
@endisset

</div>
@isset($coachDatas)
@if($coachDatas->count())
<div class="row">
    <div class="col-12">    
        <form name="form" class="form-inline" action="{{ URL::to('/coach') }}" method="GET">
            <div class="form-group">
                <label class="form-inline" for="coaches">Coaches:</label>
                &nbsp;
                <select onchange="this.form.action = setSubmitIdToUrl(this.form.action, this.value);" class="form-control float-left" name="coaches">
                    <option value="">-- Coaches --</option>
                    @foreach($coachDatas as $coachData)
                        <option value="{{ $coachData->coach->id }}">
                            {{ $coachData->voornaam }} {{ $coachData->tussenvoegsel }} {{ $coachData->achternaam }}
                        </option>
                        @php {{unset($coachData);}} @endphp
                    @endforeach
                </select>
                &nbsp;
                <button type="submit" class="btn btn-info float-left">Selecteren</button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endif
@endisset
@isset($coach) 
@isset($coachData) 

<div class="row">
    <div class="col-8 float-left">   
        <h5>Gegevens van: {{ $coachData['voornaam'] }} {{ $coachData['tussenvoegsel'] }} {{ $coachData['achternaam'] }}</h5>
    </div>
    <div class="col-2 float-left">
        <button id="formSubmit" onclick="document.form.submit()" type="submit" class="btn btn-block btn-info hidden" >Doorvoeren</button>
    </div>
    <div class="col-2 float-left">
        <div class="form-check">
            <label class="form-check-label" for="deleteCheck">
               <input id="deleteCheck" name="deleteCheck" class="form-check-input" type="checkbox">
                Verwijderen? 
           </label>
        </div>
        <button id="deleteBtn" type="submit" hidden class="btn btn-block btn-danger" >Verwijderen</button>
    </div>
    <form name="deleteForm" action="{{ URL::to("coach/$coach->id/verwijderen") }}" method="POST">
        {{ csrf_field() }}
    </form>
</div>
<br>
<div class="row">
    <div class="col-12">
        <form id="form" name="form" class="" action="{{ URL::to("/coach/$coach->id/aanpassen") }}" method="POST">
            <br>
            <div class="row">
                <div class="col-6">
                <span class="col-5 float-left">
                    <label for="id" >Kleur:</label>
                </span>
                &nbsp;
                <span class="col-6 float-left">
                    <select class="form-control form-control-sm colorSelect" name="color_id" style="text-align: center; background: {{ $colors[$coach->color_id-1]->color}}">
                        <option value=""></option>
                        @foreach($colors as $color)
                            <option @if($coach->color_id == $color->id) selected @endif value="{{ $color->id }}" style="background:{{ $color->color }}">&nbsp;</option>
                        @endforeach
                    </select>
                </span>
            </div>
                @foreach($coachData as $name => $data)
                    @if(!(stripos($name, '_at') !== false) && !(stripos($name, 'delete') !== false)) 
                    <div class="col-6">
                        <span class="col-5 float-left">
                            <label for="id" >{{ ucfirst(str_replace('_','&nbsp;', $name)) }}:</label>
                        </span>
                        &nbsp;
                        <span class="col-6 float-left">
                            <input name="{{ $name }}"  @if($name == 'id' || $name == 'coach_id') readonly @endif name="id" class="form-control form-control-sm" type="text" value="{{ $data }}">   
                        </span>
                    </div>
                    @endif
                @endforeach
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>


@endisset
@endisset



@endsection