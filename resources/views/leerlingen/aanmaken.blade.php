@extends('templates.default')

@section('content')

@isset($columns)
<div class="row">
    <div class="col-12">
        <h1>Leerlingen</h1>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="formSubmit" class="col-2 offset-10 float-left hidden">
            <button id="formSubmit" onclick="document.form.submit()" class="btn btn-outline-success btn-block text-center"><i class="far fa-check-circle"></i></button>
        </div>
        <br>
        <br>
    </div>
</div>
<div class="row">

    <div class="col-12">
        <form id="form" name="form" class="" action="{{ URL::to('/leerlingen/aanmaken') }}" method="POST">
        <div class="row">
            <div class="col-6">
                <span class="col-5 float-left">
                    <label for="id" >Coachgroep:</label>
                </span>
                &nbsp;
                <span class="col-6 float-left">
                    <select class="form-control form-control-sm" name="coach_id" style="text-align: center;">
                        <option value="">-- Selecteer coach --</option>
                        @foreach($coaches as $coach)
                            <option @if(old('coach_id') == $coach->id) selected @endif value="{{ $coach->id }}">{{ $coach->coach }}</option>
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
                    <select class="form-control form-control-sm colorSelect" name="color_id" style="text-align: center; @if(null !== old('color_id')) background:{{ $colors[old('color_id')-1]->color }} @endif">
                        <option value="">-- selecteer kleur --</option>
                        @foreach($colors as $color)
                            <option @if(old('color_id') == $color->id) selected @endif value="{{ $color->id }}" style="background:{{ $color->color }}">&nbsp;</option>
                        @endforeach
                    </select>
                </span>
            </div>
            @foreach($columns as $column)
                @if(!(stripos($column, '_at') !== false) && !(strpos($column, 'delete') !== false) && $column != 'id' && $column != 'student_id' ) 
                <div class="col-6">
                    <span class="col-5 float-left">
                        <label for="id" >{{ ucfirst(str_replace('_','&nbsp;', $column)) }}:</label>
                    </span>
                    &nbsp;
                    <span class="col-6 float-left">
                        <input name="{{ $column }}"  name="id" class="form-control form-control-sm" type="text" value="{{ old($column) }}">   
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


@endsection
