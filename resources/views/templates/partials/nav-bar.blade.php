  
<nav class="row navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <div class="col-1">
        <a class="btn btn-success" href="{{ Route('dashboard') }}"><i class="fa fa-home"></i></a>
    </div>
    <div class="col-1">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="col-8 offset-0 col-sm-4 offset-sm-6">
        <form class="form-inline" action="{{ Route('leerlingen.search') }}" method="POST">
            <input name="zoeken" class="col-8 form-control" type="text" placeholder="Zoeken" style="margin-right: 1%">
            <button class="col-2 col-sm-3 btn btn-success" type="submit"><i class="fa fa-search"></i></button>
            {{ csrf_field() }}
        </form>
    </div>

</nav>
