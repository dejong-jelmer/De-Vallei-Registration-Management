@extends('templates.default')

@section('content')

@include('templates.partials.coach')


@isset($coaches)
@isset($statuses)
<div class="row">
    <div class="col-12">
        <div class="col-2 offset-1 text-left float-left"><h6><b>alle coaches</b></h6></div>
        <div class="col-3 text-left float-left"><h6><b>status</b></h6></div>
        <div class="col-3 text-left float-left"><h6><b>reden invoer (optioneel)</b></h6></div>
        <div class="col-1 text-left float-left"><h6><b>wijzigen</b></h6></div>
        <div class="col-2 text-left float-left"><h6><b>reden</b></h6></div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form id="submitMultipleForm" action="{{ URL::to('/coaches/statuses') }}" method="POST">
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
            <input type="hidden" name="coach" id="submitIds">
            {{ csrf_field() }}
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <br>
        <div class="col-2 offset-1 text-left float-left"><h6><b>per coach</b></h6></div>
        <br>
    </div>
</div>
@foreach($coaches as $coach)

<div class="row">
    <div class="col-12">
        <form name="form" action='{{ URL::to("/coach/$coach->id/status") }}' method="POST">
            <div class="col-2 offset-1 float-left">
                <div class="col-2 text-left">
                    <input type="checkbox" class="idCheckbox form-check-input form-checkbox" value="{{ $coach->id }}">
                </div>
                <div class="col-8 offset-2 text-left">
                    {{ $coach->coach }}
                </div>
            </div>
            <div class="col-3 text-center float-left">
                <select onchange="this.form.action = setSubmitIdToUrl(this.form.action, this.value); addClassToElementByClassName({'class': 'hidden', 'classnames':['status-reason', 'status-submit']}); this.parentElement.nextElementSibling.classList.remove('hidden'); this.parentElement.nextElementSibling.nextElementSibling.classList.remove('hidden');" id="statusSelect" class="form-control form-control-sm" name="status">
                        @foreach($statuses as $status)
                            <option @if($coach->status->id == $status->id) selected @endif value="{{ $status->id }}">{{ $status->status }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-3 text-center float-left status-reason hidden">
                <input name="reden" type="text" class="form-control form-control-sm">
            </div>
             <div class="col-1 text-left float-left status-submit hidden">
                <button type="submit" class="btn btn-sm btn-outline-success text-center"><i class="far fa-check-circle"></i></button>
            </div>
            <div class="col-2 text-left float-left">
                {{ $coach->reason['reason'] }}
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>


@endforeach


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