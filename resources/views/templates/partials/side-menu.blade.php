<nav class="navbar navbar-expand-sm bg-light navbar-light nav-side">
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="nav flex-column nav-ul-side" style="width: 100%; height: 800px;">
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ URL::to('/aanwezigheid') }}">Aanwezigheid</a>
            </li>
            <li class="nav-item nav-side-btn dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Leerlingen</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ URL::to('/leerlingen/gegevens') }}">Gegevens zoeken/bewerken</a>
                    <a class="dropdown-item" href="{{ URL::to('/leerlingen/aanmaken') }}">Gegevens aanmaken</a>
                    <a class="dropdown-item" href="{{ URL::to('/leerlingen/status') }}">Status wijzigen</a>
                </div>
            </li>
            <li class="nav-item nav-side-btn dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Coaches</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ URL::to('/coaches/gegevens') }}">Gegevens zoeken/bewerken</a>
                    <a class="dropdown-item" href="{{ URL::to('/coaches/aanmaken') }}">Gegevens aanmaken</a>
                    <a class="dropdown-item" href="{{ URL::to('/coaches/status') }}">Status wijzigen</a>
                </div>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ URL::to('/status') }}">Status</a>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ URL::to('/logout') }}"><i class="fas fa-power-off"></i>&nbsp;Uitloggen</a>
            </li>
        </ul>
    </div>
</nav>
