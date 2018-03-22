@extends('templates.default')

@section('content')

@isset($students)
@isset($statuses)

@include('templates.partials.leerling')
<div class="row">
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
</div>
<div class="row">
    <hr>
</div>
<div class="row">
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
</div>
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