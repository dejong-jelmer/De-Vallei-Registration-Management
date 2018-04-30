<nav class="navbar-expand-sm bg-light navbar-light nav-side">
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul id="side-nav" class="nav flex-column nav-ul-side">
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ Route('dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ Route('aanwezigheid.index') }}">Aanwezigheid</a>
            </li>
            <li class="nav-item nav-side-btn dropdown">
                <a class="nav-link dropdown-toggle">Leerlingen</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ Route('leerlingen.index.update') }}">Zoeken/bewerken</a>
                    <a class="dropdown-item" href="{{ Route('leerlingen.index.create') }}">Aanmaken</a>
                    <a class="dropdown-item" href="{{ Route('leerlingen.status') }}">Status wijzigen</a>
                    <a class="dropdown-item" href="{{ Route('leerlingen.import') }}">Lijsten</a>
                </div>
            </li>
            <li class="nav-item nav-side-btn dropdown">
                <a class="nav-link dropdown-toggle">Coaches</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ Route('coaches.index.create') }}">Zoeken/bewerken</a>
                    <a class="dropdown-item" href="{{ Route('coaches.index.update') }}">Aanmaken</a>
                    <a class="dropdown-item" href="{{ Route('coaches.status') }}">Status wijzigen</a>
                </div>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ Route('status') }}">Status</a>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ Route('account') }}">Account</a>
            </li>
            <li class="nav-item nav-side-btn">
                <a class="nav-link" href="{{ Route('logout') }}"><i class="fa fa-power-off"></i>&nbsp;Uitloggen</a>
            </li>
        </ul>
    </div>
</nav>
<script>
    
    var body = document.body,
    html = document.documentElement;

    var height = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );

    document.getElementById('side-nav').height = height;
</script>

