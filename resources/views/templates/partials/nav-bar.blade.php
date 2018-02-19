  
<nav class="row navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <div class="col-1">
        <a class="btn btn-success" href="{{ URL::to('/home') }}"><i class="fas fa-home"></i></a>
    </div>
    <div class="col-8 offset-0 col-sm-4 offset-sm-7">
        <form class="form-inline" action="{{ URL::to('/zoeken')  }}" method="POST">
            <input name="zoeken" class="col-8 form-control" type="text" placeholder="Zoeken" style="margin-right: 1%">
            <button class="col-2 btn btn-success" type="submit"><i class="fas fa-search"></i></button>
            {{ csrf_field() }}
        </form>
    </div>

</nav>
