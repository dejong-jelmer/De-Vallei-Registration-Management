@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Leerlinglijsten</h1>
            <hr>
        </div>
    </div>
    <div id="imp">
        
        <div class="row">
            <form action="{{ Route('leerlingen.import.upload') }}" method="POST" enctype="multipart/form-data">
                <label class="btn" style="color: lightblue;">
                    <u>Bestand openen</u> <input id="input" name="file" type="file" hidden v-on:change="setInputFileText()">
                </label>
                {{-- <input name="file" type="file" class="form-control"> --}}
                <button v-if='fileSelected' type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i></button>
                {{ csrf_field() }}
                <span v-html="input"></span>
            </form>
        </div>
    </div>

@endsection
@section('javascript')
<script>
    var imp = new Vue({
        el: '#imp',
        data: {
            input: '',
            fileSelected: false
        },
        methods: {
            setInputFileText() {

                var filePath = document.getElementById('input').value
                filePath = filePath.split('\\')
                filePath = filePath.reverse()
                
                var ext = filePath[0].split('.')
                ext = ext.reverse()

                if(ext[0] != 'xls' && ext[0] != 'xlsx' && ext[0] != 'csv') {
                    this.input = '<small style="color:red">ongeldige bestands formaat, alleen .xls/.xlsx/.csv</small>'
                } else {

                    file = filePath[0]


                    this.input = '<small> geselecteerd bestand: ' + file + '</small>'

                    this.fileSelected = true
                }


            }
        }
    });
</script>
@endsection