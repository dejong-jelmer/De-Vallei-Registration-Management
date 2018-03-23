@extends('templates.default')

@section('content')

@include('templates.partials.leerling')


@isset($students)
@isset($statuses)
<div class="row">
    <div class="col-12">
        <div class="col-2 offset-1 text-left float-left"><h6><b>alle leerlingen</b></h6></div>
        <div class="col-3 text-left float-left"><h6><b>status</b></h6></div>
        <div class="col-3 text-left float-left"><h6><b>reden (optioneel)</b></h6></div>
        <div class="col-2 text-left float-left"><h6><b>wijzigen</b></h6></div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form id="submitMultipleForm" action="{{ URL::to('/leerlingen/statuses') }}" method="POST">
            <div class="col-2 offset-1 text-center float-left">
                <div class="col-2 text-left">
                    <input id="selectALlIds" name="selectCheckboxes" class="form-check-input" type="checkbox" @if(old('selectCheckboxes')) checked @endif>
                </div>
            </div>

            <div class="col-3 text-center float-left">
                <select class="form-control form-control-sm" name="status">
                    <option selected> -- Kies een status -- </option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 text-center float-left">
                <input name="reden" type="text" class="form-control form-control-sm">
            </div>


            <div class="col-2 text-left float-left">
                <button type="submit" class="btn btn-sm btn-outline-success text-center" onclick="this.form.submit();"><i class="far fa-check-circle"></i></button>
            </div>
            <input type="hidden" name="student" id="submitIds">
            {{ csrf_field() }}
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <br>
        <div class="col-2 offset-1 text-left float-left"><h6><b>per leerlingen</b></h6></div>
        <br>
    </div>
</div>
@foreach($students as $student)

<div class="row">
    <div class="col-12">
        <form name="form" action='{{ URL::to("/leerling/$student->id/status") }}' method="POST">
            <div class="col-2 offset-1 float-left">
                <div class="col-2 text-left">
                    <input type="checkbox" class="idCheckbox form-check-input form-checkbox" value="{{ $student->id }}">
                </div>
                <div class="col-8 offset-2 text-left">
                    {{ $student->naam }}
                </div>
            </div>
            <div class="col-3 text-center float-left">
                <select onchange="this.form.action = setSubmitIdToUrl(this.form.action, this.value); addClassToElementByClassName({'class': 'hidden', 'classnames':['status-reason', 'status-submit']}); this.parentElement.nextElementSibling.classList.remove('hidden'); this.parentElement.nextElementSibling.nextElementSibling.classList.remove('hidden');" id="statusSelect" class="form-control form-control-sm" name="status">
                        @foreach($statuses as $status)
                            <option @if($student->status->id == $status->id) selected @endif value="{{ $status->id }}">{{ $status->status }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-3 text-center float-left status-reason hidden">
                <input name="reden" type="text" class="form-control form-control-sm">
            </div>
             <div class="col-2 text-left float-left status-submit hidden">
                <button type="submit" class="btn btn-sm btn-outline-success text-center"><i class="far fa-check-circle"></i></button>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>


@endforeach





















{{-- <div class="row">
    <form id="submitMultipleForm" class="form-inline" action="{{ URL::to('/leerlingen/statuses') }}" method="POST">
        <div class="form-group">
            <label class="form-check-label" for="selectCheckboxes">
                <input id="selectALlIds" name="selectCheckboxes" class="form-check-input" type="checkbox" @if(old('selectCheckboxes')) checked @endif> Selecteer alle leerlingen
            </label>
            &nbsp;
            <select class="form-control form-control-sm float-left" name="status">
                <option selected> -- Kies een status -- </option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                @endforeach
            </select>
            &nbsp;
            <input name="reden" type="text" class="form-control float-left">
            <button type="submit" class="btn btn-success float-left">Status wijzigen</button>
        </div>
        <input type="hidden" name="student" id="submitIds">
        {{ csrf_field() }}
    </form>
</div> --}}

{{-- <div class="row">
    @foreach($students as $student)
        <form name="form" class="col-6" action='{{ URL::to("/leerling/$student->id/status") }}' method="POST">
            <input type="checkbox" class="col-1 idCheckbox form-check-input float-left form-checkbox" value="{{ $student->id }}">
            <div class="form-group">
                <label for="status" class="col-3 float-left">{{ $student->naam }}:</label>
                <select onchange="this.form.action = setSubmitIdToUrl(this.form.action, this.value); addClassToElementByClassName({'class':'hidden','classnames':['coach-status-submit', 'coach-status-reason']}); this.parentNode.children[3].classList.remove('hidden'); this.parentNode.children[4].classList.remove('hidden');" id="statusSelect" class="col-4 form-control form-control-sm float-left" name="status">
                        @foreach($statuses as $status)
                            <option @if($student->status->id == $status->id) selected @endif value="{{ $status->id }}">{{ $status->status }}</option>
                        @endforeach
                </select>
               
                    <span class="col-3 float-left" value="">@if($student->reason)  {{ $student->reason->reason }}  @endif</span>
                    <input name="reden" type="text" class="col-3 form-control form-control-sm float-left coach-status-reason hidden">
                    <button type="submit" class="col-1 btn btn-success btn-sm float-left coach-status-submit hidden"><i class="fa fa-check"></i></button>
            </div>
            {{ csrf_field() }}
        </form>
        <br>
    @endforeach 
</div> --}}
<br>
<br>


<script>
    var selectALlIds = document.querySelector('#selectALlIds');
    var idCheckbox = document.getElementsByClassName('idCheckbox');

    selectALlIds.addEventListener('click', function(){
        var event = new Event('click');
        
        if(this.checked) {
            for(var i = 0; i < idCheckbox.length; i++) {
                idCheckbox[i].checked = true;
                
                idCheckbox[i].dispatchEvent(event);
            } 
            
        } else {

            for(var i = 0; i < idCheckbox.length; i++) {
                idCheckbox[i].checked = false;
                
                idCheckbox[i].dispatchEvent(event);
            } 
        }
    });



</script>

@endisset
@endisset

@endsection