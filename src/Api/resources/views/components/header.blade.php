@vite(['resources/scss/header.scss'])

<nav class="social-media">
    <a href="mailto:{{ $email }}" class="email">{{ $email }}</a>
    <hr>

    @foreach ($socialMedia as $media)
        <a href="{{ $media['link'] }}" target="_blank" class="social-media-item">
            <i class="icon fa-brands {{ $media['icon'] }}"></i>
        </a>
    @endforeach
</nav>

<nav class="navbar">
    <div class="menu-nav">
        <div class="menu" onclick="toggleMenu()">
            <span class="menuburger"></span>
        </div>

        <div class="menu-nav-item">
            <a href="{{ URL::route('home') }}" class="menu-nav-link">Home</a>

            <a href="{{ URL::route('about-us') }}" class="menu-nav-link">Over Ons</a>
        </div>

        <div class="menu-nav-item">
            <div class="menu-nav-img">
                <img src="{{ Vite::asset('/resources/images/logo.png') }}" title="logo van het berdijf">
            </div>
        </div>

        <div class="menu-nav-item">
            <a href="{{ URL::route('reservation') }}" class="menu-nav-link">Reserveer</a>

            @if (Auth::check())
                <a href="{{ URL::route('user') }}" class="menu-nav-link" *ngIf="isLogged">Account</a>
            @else
                <a href="{{ URL::route('login') }}" class="menu-nav-link" *ngIf="!isLogged">Login</a>
            @endif
        </div>
    </div>
</nav>

<script>
    var menuOpen = false;
    var elements = document.querySelectorAll(".menu-nav-link");
    var max = 0;

    elements.forEach(element => {
        var width = element.clientWidth;
        if (width > max) max = width;
    });

    elements.forEach(element => {
        setWidth(element, max);
    });

    function setWidth(element, w) {
        element.style.width = w + 'px';
    }

    function toggleMenu() {
        if (!menuOpen) {
            document.querySelectorAll(".menu-nav")?.forEach(element => {
                element.classList.add("expanded");
            });

            menuOpen = true
        } else {
            document.querySelectorAll(".menu-nav")?.forEach(element => {
                element.classList.remove("expanded");
            });

            menuOpen = false
        }
    }
</script>
