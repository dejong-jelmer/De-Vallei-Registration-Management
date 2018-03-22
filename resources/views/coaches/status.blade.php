@extends('templates.default')

@section('content')

@isset($coaches)
@isset($statuses)

@include('templates.partials.coach')

<div class="row">
    @foreach($coaches as $coach)
        <form name="form" class="col-6" action='{{ URL::to("/coach/$coach->id/status") }}' method="POST">
            <input type="checkbox" class="idCheckbox form-check-input float-left form-checkbox" value="{{ $coach->id }}">
            <div class="form-group">
            <div id="statuses">
                <label for="status" class="col-3 float-left">{{ $coach->coach }}:</label>
                <select onchange="this.form.action = setSubmitIdToUrl(this.form.action, this.value); setBtnClassHidden(); this.nextElementSibling.classList.remove('hidden')" id="statusSelect" class="col-4 form-control form-control-sm float-left" name="status">
                        
                        @foreach($statuses as $status)
                            <option @if($coach->status->id == $status->id) selected @endif value="{{ $status->id }}">{{ $status->status }}</option>
                        @endforeach
                </select>
                <button type="submit" class="col-3 offset-1 hidden btn btn-success btn-sm float-left coachStatusSubmit">Status wijzigen</button>
            </div>
            </div>
            {{ csrf_field() }}
        </form>
        <br>
    @endforeach 
</div>
<br>
<br>
<div class="row">
        
    <form id="submitMultipleForm" class="form-inline" action="{{ URL::to('/coaches/statuses') }}" method="POST">
        <div class="form-group">
            <label class="form-check-label" for="selectCheckboxes">
                <input id="selectALlIds" name="selectCheckboxes" class="form-check-input" type="checkbox" @if(old('selectCheckboxes')) checked @endif> Selecteer alle coaches
           </label>
            &nbsp;
            <select class="form-control form-control-sm float-left" name="status">
                <option selected> -- Kies een status -- </option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->status }}</option>
                @endforeach
            </select>
            &nbsp;
            <button type="submit" class="btn btn-success float-left">Status wijzigen</button>
        </div>
        <input type="hidden" name="coach" id="submitIds">
        {{ csrf_field() }}
    </form>
</div>
<script>
</script>
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