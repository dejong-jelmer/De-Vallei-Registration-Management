@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Aanwezigheid</h1>
            <hr>
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
                                       <option value="{{ $student->id }}" @if(null !== old('students')) @if(in_array($student->id, old('students'))) selected @endif @endif>{{ $student->naam }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3 offset-1 float-left">
                            <label><h5>Status:</h5></label>
                            <div id="statuses">
                                @foreach($statuses as $status)
                                    <div class="form-check">
                                        <label class="form-check-label" for="{{ $status->status }}">
                                           <input name="{{ str_replace(' ', '_', $status->status) }}" class="form-check-input" type="checkbox" value="{{ $status->id }}" {{ $status->id == old(str_replace(' ', '_', $status->status)) ? 'checked' : '' }}> {{ $status->status }}
                                       </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-4 float-left">
                            <div class="form-group">
                                <label for="datum">vanaf datum:</label>

                                <input class="form-control" type="date" name="van_datum" value="{{ old('van_datum') }}">
                            </div>
                            <div class="form-group">
                                <label for="datum">t/m datum:</label>
                                <input class="form-control" type="date" name="tot_datum" value="{{ old('tot_datum') }}">
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="datum">Maand:</label>
                                    <select class="form-control" type="date" name="maand">
                                        <option value="">Kies maand</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option {{ $i == old('maand') ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="datum">Jaar:</label>
                                    <span style="display: none;">{{ $date = Carbon::now() }}</span>
                                    <select class="form-control" type="date" name="jaar">
                                        <option value="">Kies jaar</option>
                                        @for($i = 2012; $i <= $date->year; $i++)
                                            <option {{ $i == old('jaar') ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
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
                       <label class="form-check-label" for="allStudents">
                           <input id="allStudents" name="allStudents" class="form-check-input" type="checkbox" @if(old('students')) checked @endif> Selecteer alle leerlingen
                       </label>
                    </div>
                </div>
                <div class="col-3 offset-1 float-left">
                    <div class="form-check">
                       <label class="form-check-label" for="allStatuses">
                           <input id="allStatuses" name="allStatuses" class="form-check-input" type="checkbox" @if(old('allStatuses')) checked @endif> Selecteer alle statusen
                       </label>
                    </div>
                </div>

                <div class="col-2 float-left">
                    @isset($attendances)
                    @if($attendances->count())
                        <button class="btn btn-success btn-block" name="export" value="true">Exporteren</button>
                    @endif
                    @endisset
                </div>  
                <div class="col-2 float-left">
                    <button class="btn btn-info btn-block">Zoeken</button>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </form>
    <br>
    @isset($attendances)
    <h2>Gevonden aanwezigheid</h2>
    @if(!$attendances->count())
        <p>Geen aanwezigheid gevonden</p>
    @else
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Leerling</th>
                    <th>Status</th>
                    <th>Vanaf datum / tijd</th>
                    <th>Tot datum / tijd</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                    <td>{{ $attendance->student->naam }}</td>
                    <td>{{ $attendance->status->status }}</td>
                    <td>{{ $attendance->start_tijd }}</td>
                    <td>{{ $attendance->eind_tijd }}</td>
                </td>

                @endforeach
            </tbody>
        </table>
    </div>    
    @endif
    @endisset


    <script>
        var selectAllStudents = document.querySelector('#allStudents');
        var selectAllStatuses = document.querySelector('#allStatuses');
        var students = document.querySelector('#studentSelect').options;

        selectAllStudents.addEventListener('click', function(){
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

        var allStatusesDivs = document.querySelector('#statuses').children;

        selectAllStatuses.addEventListener('click', function(){
            if(this.checked) {
                for(var a = 0; a < allStatusesDivs.length; a++) {
                    var allStatusesLabels = allStatusesDivs[a].children;

                    for(var b = 0; b < allStatusesLabels.length; b++) {
                        var allStatusesInput = allStatusesLabels[b].children;
                        
                        for(var c = 0; c < allStatusesLabels.length; c++) {
                            allStatusesInput[c].checked = true;
                        }
                    } 
                }
            } else {
                for(var a = 0; a < allStatusesDivs.length; a++) {
                    var allStatusesLabels = allStatusesDivs[a].children;

                    for(var b = 0; b < allStatusesLabels.length; b++) {
                        var allStatusesInput = allStatusesLabels[b].children;
                        
                        for(var c = 0; c < allStatusesLabels.length; c++) {
                            allStatusesInput[c].checked = false;
                        }
                    } 
                }
            }

        });

    </script>
@endsection