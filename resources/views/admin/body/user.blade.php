<li class="dropdown user-menu">
    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        <img src="{{ Auth::user()->profile_photo_url }}" class="user-image" alt="User Image"/>
        <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-right">
        <!-- User image -->
        <li class="dropdown-header">
            <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle" alt="User Image"/>
            <div class="d-inline-block">
                {{ Auth::user()->name }} <small class="pt-1">{{ Auth::user()->email }}</small>
            </div>
        </li>

        <li>
            <a href={{ route('profile.show') }}>
                <i class="mdi mdi-account"></i> My Profile
            </a>
        </li>
        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
        <li>
            <a href="{{ route('api-tokens.index') }}">
                <i class="mdi mdi-account"></i> Api Tokens
            </a>
        </li>
        @endif



        <li class="dropdown-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('user.logout') }}">
                    <i class="mdi mdi-logout"></i> Log Out
                </a>
            </form>
        </li>

    </ul>
</li>
