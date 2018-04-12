@extends('templates.default')


@section('content')

<div id="app">
    <div class="row">
        <div class="col-6 text-center float-left">
            <h5>Aanwezigheid</h5>
            <canvas id="canvas" width="250%" height="250%"></canvas>
            <p><br></p>
            <div class="col-10 offset-2 float-left">
                @isset($statuses)
                    @foreach($statuses as $status)
                    <div class="col-1 float-left" style="height: 1%; background-color: {{ $status->color }}">&nbsp;</div>
                    <div class="col-5 float-left text-left">{{ $status->status }}</div>
                    @endforeach
                @endisset
            </div>
        </div>
        <div class="col-5 offset-1 float-right">
            <h5>Actuele statussen</h5>
            <div v-if="statuses">
                <table class="table-responsive">
                    <tbody v-for="status in statuses">
             
                        <td><b>@{{ status.naam }}</b></td>
                        <td>
                            <table class="table-sm">
                                <tr>
                                    <td><small>Status: <b>@{{ status.status.text }}</b></small><small v-if="status.reason">->@{{ status.reason.reason  }}</small></td>
                                </tr>
                                <tr>
                                    <td><small>Tijd: @{{ status.status.updated_at }}</small></td>
                                </tr>
                            </table>
                        </td>             
                    </tbody>
                </table>                    
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

        
        openDiagram('{{ Route('dashboard.diagram') }}');

        setInterval(function () {
            openDiagram('{{ Route('dashboard.diagram') }}');

        },5000);



        
    </script>
@endsection