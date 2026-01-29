<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name ms-2">DEV HOME
            < />
        </div>
        <i class='bi bi-list' id="btn"></i>
    </div>
    <ul class="nav-list p-0">
        <li>
            <i class='bi bi-search'></i>
            <input type="text" placeholder="Search..." class="form-control border-0 text-white shadow-none bg-white">
            <span class="tooltip">Search</span>
        </li>
        <li>
            <a href="#" class="text-decoration-none fw-bold text-white w-100">
                <i class='bi bi-house'></i>
                <span class="links_name">Home</span>
            </a>
            <span class="tooltip">Home</span>
        </li>
        <li>
            <a href="#" class="text-decoration-none fw-bold text-white">
                <i class='bi bi-person'></i>
                <span class="links_name">Users</span>
            </a>
            <span class="tooltip">Users</span>
        </li>
        <li>
            <a href="#" class="text-decoration-none fw-bold text-white">
                <i class='bi bi-gear'></i>
                <span class="links_name">Setting</span>
            </a>
            <span class="tooltip">Setting</span>
        </li>
        <li class="profile">
            <div class="profile-details ">
                @if(Auth::user()->profile_image)
                <img src="{{ asset('images/' . Auth::user()->profile_image) }}" alt="profileImg">
                @else
                <img src="{{ asset('images/default-profile.jpg') }}" alt="profileImg">
                @endif
                <div class="name_job">
                    <div class="name text-white">{{ Auth::user()->username ?? 'Misafir' }}</div>
                    <div class="job text-white">Web Developer</div>
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