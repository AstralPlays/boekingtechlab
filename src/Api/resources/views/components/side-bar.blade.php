@vite(['resources/scss/side-bar.scss'])

<div class="sidebar" id="sidebar">
    <div class="sidebar-menu">
        <ul>
            <li class="sidebar-menu-item">
                <a href="{{ URL::route('admin-dashboard') }}">Dashboard</a>
            </li>

            <li class="sidebar-menu-item">
                @if (session()->get('role') == 'Admin')
                    <a href="{{ URL::route('admin-reservations') }}">Reserveringen</a>
                @else
                    <a href="{{ URL::route('user-reservations') }}">Reserveringen</a>
                @endif
            </li>

            <li class="sidebar-menu-item">
                <a href="{{ URL::route('admin-accounts') }}">Accounts</a>
            </li>

            <li class="sidebar-menu-item">
                @if (session()->get('role') == 'Admin')
                    <a href="{{ URL::route('admin-settings') }}">Instellingen</a>
                @else
                    <a href="{{ URL::route('user-settings') }}">Instellingen</a>
                @endif
            </li>

            @if (session()->get('role') == 'Admin')
                <li class="sidebar-menu-item">
                    <a href="{{ URL::route('admin-manage-rooms') }}">Lokaal beheren</a>
                </li>
            @endif

            @if (session()->get('role') == 'Admin')
                <li class="sidebar-menu-item">
                    <a href="{{ URL::route('admin-manage-materials') }}">Materiaal beheren</a>
                </li>
            @endif

            <li class="sidebar-menu-item">
                <a href="{{ URL::route('logout') }}">uitloggen</a>
            </li>
        </ul>
    </div>

    <div class="sidebar-chevron" id="sidebar-btn">
        <i class="fa-solid fa-chevron-right fa-xl" id="sidebar-chevron"></i>
    </div>
</div>

<script>
    const button = document.getElementById("sidebar-btn")
    const sidebar = document.getElementById("sidebar")
    const chevron = document.getElementById("sidebar-chevron")

    button.addEventListener("click", open)

    function open() {
        if (sidebar.classList.contains("open")) {
            sidebar.classList.remove("open")
            chevron.style.transform = "rotate(0deg)"
        } else {
            sidebar.classList.add("open")
            chevron.style.transform = "rotate(180deg)"
        }
    }
</script>
