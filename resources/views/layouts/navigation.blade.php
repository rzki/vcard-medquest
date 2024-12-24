<ul>
    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" wire:navigate>
            <span class="icon">
                <i class="fas fa-grip"></i>
            </span>
            <span class="text">{{ __('Dashboard') }}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('contacts.*') ? 'active' : '' }}">
        <a href="{{ route('contacts.index') }}" wire:navigate>
            <span class="icon">
                <i class="fas fa-circle-user"></i>
            </span>
            <span class="text">{{ __('Contacts') }}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}" wire:navigate>
            <span class="icon">
                <i class="fas fa-users"></i>
            </span>
            <span class="text">{{ __('Users') }}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}" wire:navigate>
            <span class="icon">
                <i class="fas fa-user-cog"></i>
            </span>
            <span class="text">{{ __('Roles') }}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('divisions.*') ? 'active' : '' }}">
        <a href="{{ route('divisions.index') }}" wire:navigate>
            <span class="icon">
                <i class="fas fa-address-card"></i>
            </span>
            <span class="text">{{ __('Divisions') }}</span>
        </a>
    </li>

    <li class="nav-item nav-item-has-children">
        <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#ddmenu_1"
           aria-controls="ddmenu_1" aria-expanded="true" aria-label="Toggle navigation">
            <span class="icon">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M12.8334 1.83325H5.50008C5.01385 1.83325 4.54754 2.02641 4.20372 2.37022C3.8599 2.71404 3.66675 3.18036 3.66675 3.66659V18.3333C3.66675 18.8195 3.8599 19.2858 4.20372 19.6296C4.54754 19.9734 5.01385 20.1666 5.50008 20.1666H16.5001C16.9863 20.1666 17.4526 19.9734 17.7964 19.6296C18.1403 19.2858 18.3334 18.8195 18.3334 18.3333V7.33325L12.8334 1.83325ZM16.5001 18.3333H5.50008V3.66659H11.9167V8.24992H16.5001V18.3333Z">
                    </path>
                </svg>
            </span>
            <span class="text">Two-level menu</span>
        </a>
        <ul id="ddmenu_1" class="dropdown-nav collapse" style="">
            <li>
                <a href="#">Child menu</a>
            </li>
        </ul>
    </li>
</ul>
