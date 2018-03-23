@extends('templates.default')


@section('content')
    
@isset($statuses)

@include('templates.partials.status')
<div class="row">
    <div class="col-12">
        <div class="col-1 float-left"></div>
        <div class="col-2 text-left float-left"><h6><b>status</b></h6></div>
        <div class="col-2 text-left float-left"><h6><b>selecteerbaar voor leerlingen</b></h6></div>
        <div class="col-2 text-left float-left"><h6><b>selecteerbaar voor coaches</b></h6></div>
        <div class="col-1 text-left float-left"><h6><b>reden nodig</b></h6></div>
        <div class="col-3 text-left float-left"><h6><b>tekst</b></h6></div>
        <div class="col-1 text-left float-left"><h6><b>kleur</b></h6></div>
    </div>
</div>
@foreach($statuses as $status)
    <div class="row">
        <div class="col-12">
                
            <form name="form" action="{{ URL::to("/status/aanpassen/$status->id") }}" method="POST">
                 <div class="col-1 text-center float-left">
                    <button class="btn btn-sm btn-outline-danger text-center" onclick="this.value = 1; deleteConfirm(event, 'status');" name="delete"><i class="far fa-times-circle"></i></button>
                </div>
                <div class="col-2 text-left float-left">
                    {{ $status->status }}
                </div>
                
                <div class="col-2 text-center float-left">
                    <input onclick="this.form.submit()" name="student_selectable" class="form-check-input form-checkbox" type="checkbox" @if($status->student_selectable) checked @endif>
                </div>
                <div class="col-2 text-center float-left">
                    <input onclick="this.form.submit()" name="coach_selectable" class="form-check-input form-checkbox" type="checkbox" @if($status->coach_selectable) checked @endif>
                </div>
                <div class="col-1 text-center float-left">
                    <input onclick="this.form.submit()" name="reason_requierd" class="form-check-input form-checkbox" type="checkbox" @if($status->reason_requierd) checked @endif>
                </div>
                <div class="col-3 text-left float-left">
                    <input name="text" type="text" class="col-9 form-control form-control-sm float-left" value="{{ $status->text }}" onkeyup="this.nextElementSibling.classList.remove('hidden');"><button class="col-3 btn btn-sm btn-outline-success text-center float-left hidden" onclick="this.form.submit();"><i class="far fa-check-circle"></i></button>
                </div>

                <div class="col-1 text-center float-left">
                    <div class="form-control form-control-sm" style="background: {{ $status->color }}"></div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>        
@endforeach
@endisset
<div class="row">
    <div class="col-12">
        <br>
        <h6><b>Nieuwe status aanmaken</b></h6>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form name="form" action="{{ URL::to('/status/aanmaken') }}" method="POST">
            <div class="col-1 text-center float-left">
                <button class="btn btn-sm btn-outline-success text-center" onclick="this.form.submit();"><i class="far fa-check-circle"></i></button>
            </div>
            <div class="col-2 text-left float-left">
                <input name="status" type="text" class="form-control form-control-sm">
            </div>
            
            <div class="col-2 text-center float-left">
                <input name="student_selectable" class="form-check-input form-checkbox" type="checkbox">
            </div>
            <div class="col-2 text-center float-left">
                <input name="coach_selectable" class="form-check-input form-checkbox" type="checkbox">
            </div>
            <div class="col-1 text-center float-left">
                <input name="reason_requierd" class="form-check-input form-checkbox" type="checkbox">
            </div>
             <div class="col-3 text-left float-left">
                    <input name="text" type="text" class="col-9 form-control form-control-sm float-left">
                </div>
            <div class="col-1 text-center float-left">
                <input name="color" type="color" class="form-control form-control-sm" value="#ffffff">
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>

@endsection