<div class="sidebar">
    <div class="logo-details">
        <a href="{{ route('about_us') }}" class="text-decoration-none fw-bold text-white">
            <div class="logo_name ms-2">DEV HOME
                < />
            </div>
        </a>
        <i class='bi bi-list' id="btn"></i>
    </div>
    <ul class="nav-list p-0">
        <li>
            <a href="{{ route('profile.index') }}" class="text-decoration-none fw-bold text-white">
                <i class='bi bi-person-gear'></i>
                <span class="links_name">profile</span>
            </a>
            <span class="tooltip">profile</span>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="text-decoration-none fw-bold text-white">
                <i class='bi bi-people'></i>
                <span class="links_name">Users</span>
            </a>
            <span class="tooltip">Users</span>
        </li>
        @auth
            @if(\App\Models\Admin::where('user_id', auth()->id())->exists())
                <li>
                    <a href="{{ route('admin.panel') }}" class="text-decoration-none fw-bold text-white">
                        <i class="bi bi-shield-lock-fill fs-4"></i>
                        <span class="ms-3 nav-text">Admin Panel</span>
                    </a>
                    <span class="tooltip">Admin Panel</span>
                </li>
            @endif
        @endauth
        <li>
            <a href="{{ route("home") }}" class="text-decoration-none fw-bold text-white w-100">
                <i class='bi bi-house'></i>
                <span class="links_name">HOME</span>
            </a>
            <span class="tooltip">HOME</span>
            <i class='bi bi-chevron-down arrow-btn ms-2 p-2' id="drop-btn"></i>
        <li class="nav-item">
            <ul class="sub-menu list-unstyled ps-4 py-2" style="display: none; background: #1d1b31;">
                <li><a href="{{ route("home") }}"
                        class="text-white-50 text-decoration-none py-1 d-block small">Repository</a></li>
                <li><a href="{{ route("posts.index") }}"
                        class="text-white-50 text-decoration-none py-1 d-block small">Posts</a>
                </li>
            </ul>
        </li>
        </li>
        <li class="profile">
            <div class="profile-details ">
                <img src="{{ asset(Auth::user()->profile_image) }}" alt="profileImg">
                <div class="name_job">
                    <div class="name text-white">{{ Auth::user()->username ?? 'Guest' }}</div>
                </div>
            </div>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bi bi-box-arrow-in-left' id="log_out"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>