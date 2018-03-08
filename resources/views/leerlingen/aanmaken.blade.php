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
    <div class="col-2 offset-10 float-left form-group">
        <button id="studentFormSubmit" onclick="document.studentForm.submit()" type="submit" class="btn btn-success hidden">Aanmaken</button>
    </div>
</div>
<div class="row">

    <div class="col-12">
        <form id="studentForm" name="studentForm" class="" action="{{ URL::to('/leerlingen/aanmaken') }}" method="POST">
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
                            <option value="{{ $coach->id }}">{{ $coach->coach }}</option>
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
                    <select id="colorSelect" class="form-control form-control-sm" name="color_id" style="text-align: center;">
                        <option value="">-- selecteer kleur --</option>
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}" style="background:{{ $color->color }}">&nbsp;</option>
                        @endforeach
                    </select>
                </span>
            </div>
            @foreach($columns as $column)
                @if(!(stripos($column, '_at') !== false) && !(strpos($column, 'delete') !== false)) 
                <div class="col-6">
                    <span class="col-5 float-left">
                        <label for="id" >{{ ucfirst(str_replace('_','&nbsp;', $column)) }}:</label>
                    </span>
                    &nbsp;
                    <span class="col-6 float-left">
                        <input name="{{ $column }}"  @if($column == 'id' || $column == 'student_id') readonly @endif name="id" class="form-control form-control-sm" type="text">   
                    </span>
                </div>
                @endif
            @endforeach
            
        </div>
        {{ csrf_field() }}
        </form>
    </div>
</div>
<script>
    var studentForm = document.querySelector('#studentForm');
    
    studentForm.addEventListener('change', function() {
        var studentFormSubmit = document.querySelector('#studentFormSubmit');

        studentFormSubmit.classList.remove('hidden');

    } );

    var colorSelect = document.querySelector('#colorSelect');
    
    colorSelect.addEventListener('change', function() {
        console.log(this.selectedOptions[0].style.background);
        colorSelect.style.background = this.selectedOptions[0].style.background;
    });

</script>

@endisset


@endsection
