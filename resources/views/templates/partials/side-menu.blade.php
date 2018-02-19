<nav class="navbar navbar-expand-sm bg-light navbar-light nav-side">
    <button class="navbar-toggler offset-10" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="nav flex-column nav-ul-side" style="width: 100%;">
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="#">Leerlingen</a>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="#">Export</a>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ URL::to('/status') }}">Status</a>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ URL::to('/aanwezigheid') }}">Aanwezigheid</a>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ URL::to('/logout') }}"><i class="fas fa-power-off"></i>&nbsp;Uitloggen</a>
            </li>
        </ul>
    </div>
</nav>
