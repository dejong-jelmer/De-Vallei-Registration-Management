@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Aanwezigheid</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-1"> 
            @if ($errors->any())
                <div class="text-danger">
                    <h5>Het volgende ging fout:</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <form name="form" action="{{ URL::to('/aanwezigheid') }}" method="POST">
        <div class="row">
                @isset($students)
                @isset($statuses)
                    <div class="col-12">
                        <div class="col-4 float-left"> 
                            <div class="form-group">
                                <label for="student"><h5>Leerlingen:</h5></label>
                                <select class=form-control id="studentSelect" name="students[]" multiple size="{{ $statuses->count() }}">
                                    @foreach($students as $student)
                                       <option value="{{ $student->id }}">{{ $student->naam }}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3 offset-1 float-left">
                            <label><h5>Status:</h5></label>

                            @foreach($statuses as $status)
                                <div class="form-check">
                                    <label class="form-check-label" for="{{ $status->status }}">
                                       <input name="{{ str_replace(' ', '_', $status->status) }}" class="form-check-input" type="checkbox" value="{{ $status->id }}"> {{ $status->status }}
                                   </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-4 float-left">
                            <div class="form-group">
                                <label for="datum">vanaf datum:</label>
                                <input class="form-control" type="date" name="van_datum">
                            </div>
                            <div class="form-group">
                                <label for="datum">tot datum:</label>
                                <input class="form-control" type="date" name="tot_datum">
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="datum">Maand:</label>
                                    <select class="form-control" type="date" name="maand">
                                        <option value="">Kies maand</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="datum">Jaar:</label>
                                    <span style="display: none;">{{ $date = Carbon::now() }}</span>
                                    <select class="form-control" type="date" name="jaar">
                                        <option value="">Kies jaar</option>
                                        @for($i = 2012; $i <= $date->year; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>                        
                            </div>
                        </div>
                       
                    </div>
                @endisset
                @endisset
        </div>
        <div class="row">
            <div class="col-12">
                <div class="col-4 float-left">
                    <div class="form-check">
                       <label class="form-check-label" for="selecteer_alle">
                       <input id="selecteer_alle" name="selecteer_alle" class="form-check-input" type="checkbox"> Selecteer alle leerlingen
                    </div>
                </div>
                <div class="col-4 offset-4 float-left">
                    <button class="btn btn-info btn-block">Zoeken</button>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </form>
    @isset($attendances)
    
        @foreach($attendances as $attendance)
            Naam: {{ $attendance->student->naam }} <br>
            Status: {{ $attendance->status->status }} <br>
            Van: {{ $attendance->start_tijd }} <br>
            Tot: {{ $attendance->eind_tijd }} <br>
        @endforeach

    @endisset


    <script>
        var selectAll = document.querySelector('#selecteer_alle');
        var students = document.querySelector('#studentSelect').options;

        selectAll.addEventListener('click', function(){
            if(this.checked) {
                for(var i = 0; i < students.length; i++) {
                    students[i].selected = true;
                }
            } else {
                for(var i = 0; i < students.length; i++) {
                    students[i].selected = false;
                }
            }
        });
    </script>
@endsection