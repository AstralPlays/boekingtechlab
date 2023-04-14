@vite(['resources/scss/side-bar.scss'])

<div class="sidebar" id="sidebar">
    <div class="sidebar-menu">
        <ul>
            <li class="sidebar-menu-item">
                <a href="{{ URL::route('admin-dashboard') }}">Dashboard</a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ URL::route('admin-bookings') }}">Boekingen</a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ URL::route('admin-accounts') }}">Accounts</a>
            </li>
            <li class="sidebar-menu-item">
                <a href="{{ URL::route('admin-settings') }}">Settings</a>
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
