@extends('templates.default')


@section('content')

<div class="row">
    <div class="col-6 float-left">
        <h5>Aanwezigheid</h5>
        <canvas id="canvas" style="width: 100%;"></canvas>
        <p><br></p>
            @isset($statuses)
                @foreach($statuses as $status)
                <div class="col-2 col-lg-1 float-left" style="width: 100%; sheight: 1%; background-color: {{ $status->color }}">&nbsp;</div>
                <div class="col-10 col-lg-5 float-left text-left">{{ $status->status }}</div>
                @endforeach
            @endisset
        <div class="float-left text-center" style="margin-top: 5%">
            @foreach($statuses as $status)
                <div class="col-12 col-sm-6 float-left">
                    <a class="nav-link dropdown-toggle">{{ $status->status }}</a>
                    <div class="dropdown-menu">
                        @forelse($status->students as $student)
                    
                            <a class="dropdown-item">{{ $student->naam }}</a>
                        @empty
                            <a class="dropdown-item">Niemand</a>
                        @endforelse
                    </div>                        
                    
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-5 offset-1 float-right">
        <h5>Actuele statussen</h5>
        <div v-if="statuses">
            <div v-for="status in statuses">
                
                <div class="col-12 col-md-4 float-left">
                    <b>@{{ status.naam }}</b>
                </div>
                 <div class="col-12 col-md-8 float-left">
                   <small>Status: <b>@{{ status.status.status }}</b></small><small v-if="status.reason">->@{{ status.reason.reason  }}</small> <br>
                   <small>Tijd: @{{ status.status.updated_at }}</small>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('javascript')
    <script>

        
        openDiagram('{{ Route('dashboard.diagram') }}');

        setInterval(function () {
            openDiagram('{{ Route('dashboard.diagram') }}');

        },5000);

window.axios.create({
        baseURL: 'http://de_vallei.test/api/v1',
        timeout: 5000
    });

const app = new Vue({
    el: '#app',
    data: {
        statuses: false,
        uri: '/api/v1/dashboard/statuses'
    },

    methods: {
        getStatuses(uri) {
            self = this
            // console.log('Getting statuses:')

            axios.get(
                uri
                ).then(
                    function(response) {
                    // console.log('%c  success', 'color:green')
                        
                    self.statuses = response.data;
                    }
                ).catch(
                    function(error) {
                        console.error(error)
                   }
                );    
        }
    },

    mounted: 
     function() {
        self = this
        var uri = this.uri

        // console.log('Getting statuses:')
        self.getStatuses(uri)
        
        setInterval(function () {
            self.getStatuses(uri)
            
        },5000);
    }
});

        
    </script>
@endsection