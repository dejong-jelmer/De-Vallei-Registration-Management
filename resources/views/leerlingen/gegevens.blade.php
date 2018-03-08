@extends('templates.default')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Leerlingen</h1>
        <hr>
        @isset($studentDatas)
        @if(!isset($studentDatas) && !count($studentDatas))
            <p>Niets gevonden.</p>
        @endif
        @endisset
    </div>
</div>
@isset($students)
@if($students->count())
<div class="row">
    <div class="col-12">    
        <form name="form" class="form-inline" action="{{ URL::to('/leerling/zoeken') }}" method="POST">
            <div class="form-group">
                <label class="form-inline" for="students">Leerlingen:</label>
                &nbsp;
                <select class="form-control float-left" name="students">
                    <option value="">-- Leerlingen --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->student_id }}">
                            {{ $student->voornaam }} {{ $student->tussenvoegsel }} {{ $student->achternaam }}
                        </option>
                        @php {{unset($student);}} @endphp
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
@isset($student) 
@isset($coaches)
@isset($studentData) 

<div class="row">
    <div class="col-10 float-left">   
        <h5>Gegevens van: {{ $studentData['voornaam'] }} {{ $studentData['tussenvoegsel'] }} {{ $studentData['achternaam'] }}</h5>
    </div>
    <div class="col-2 float-left">
        <button id="studentFormSubmit" onclick="document.studentForm.submit()" type="submit" class="btn btn-light disabled" >Aanpassen</button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <form id="studentForm" name="studentForm" class="" action="{{ URL::to('/leerling/'.$studentData['student_id']. '/aanpassen') }}" method="POST">
            <br>
            <div class="row">
                <div class="col-6">
                    <span class="col-5 float-left">
                        <label for="id" >Coachgroep:</label>
                    </span>
                    &nbsp;
                    <span class="col-6 float-left">
                        <select class="form-control form-control-sm" name="coach_id">
                            @foreach($coaches as $coach)
                                <option @if($coach->id == $student->coach->id) selected @endif value="{{ $coach->id }}">{{ $coach->coach }}</option>
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
                    <select id="colorSelect" class="form-control form-control-sm" name="color_id" style="text-align: center; background: {{ $colors[$student->color_id-1]->color}}">
                        <option value="">-- selecteer kleur --</option>
                        @foreach($colors as $color)
                            <option @if($student->color_id == $color->id) selected @endif value="{{ $color->id }}" style="background:{{ $color->color }}">&nbsp;</option>
                        @endforeach
                    </select>
                </span>
            </div>
                @foreach($studentData as $name => $data)
                    @if(!(stripos($name, '_at') !== false) && !(strpos($name, 'delete') !== false)) 
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
<script>
    var studentForm = document.querySelector('#studentForm');
    studentForm.addEventListener('change', function() {
        var studentFormSubmit = document.querySelector('#studentFormSubmit');

        console.log(studentFormSubmit);
        studentFormSubmit.classList.remove('btn-light');
        studentFormSubmit.classList.remove('disabled');
        studentFormSubmit.classList.add('btn-danger');

    } );

    var colorSelect = document.querySelector('#colorSelect');
    
    colorSelect.addEventListener('change', function() {
        console.log(this.selectedOptions[0].style.background);
        colorSelect.style.background = this.selectedOptions[0].style.background;
    });
</script>

@endisset
@endisset
@endisset



@endsection