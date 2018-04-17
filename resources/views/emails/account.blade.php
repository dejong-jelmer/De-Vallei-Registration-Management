Beste {{ $naam }},


<p>er is een account voor je aangemaakt voor het administratie systeem va de Vallei met de volgende gegevens:</p>
<ul>
    <li>Je email-adres: {{ $email }}</li>
    <li>Je wachtwoord is: {{ $wachtwoord }}</li>
</ul>
<a href="{{ route('login') }}">{{ route('login') }}</a>
<p>Groeten,</p>

<p>{{ Auth::user()->naam }}</p>