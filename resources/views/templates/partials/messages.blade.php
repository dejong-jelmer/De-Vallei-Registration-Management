
<div class="row">
    <div class="col-8 offset-2"> 
        @if (session('info'))
            <div class="alert alert-info alert-dismissible" role="alert">
                {{ session('info') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @elseif (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div> 
        @elseif (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('status') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>             
        @endif
    </div>
</div>