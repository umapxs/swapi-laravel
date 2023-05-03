<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>



<div class="c-wrapper c-fixed-components sticky top-0 z-50">

    <header class="header header-sticky" style="background-color: #f8f9fa;">
        <div class="container-fluid">
            <button id="hamburguer" class="header-toggler px-md-0 me-md-3"
                    type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()" data-cf-modified-aa23ac249e87884f28a6bec2-="">

                <svg class="icon icon-lg">
                    <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                </svg>
            </button>

            <a class="header-brand d-md-none" href="/dashboard">
                <h1 class="flex justify-center font-bold text-blackflex justify-center font-bold text-black
    ">Star Wars API</h1>
            </a>

            <ul class="header-nav d-none d-md-flex">
                <li class="nav-item hover:underline text-sm">
                    <a class="nav-link" href="/dashboard">Dashboard
                    </a>
                </li>

                <li class="nav-item hover:underline text-sm">
                    <a class="nav-link" href="/logs">Logs
                    </a>
                </li>

                <li class="nav-item hover:underline text-sm">
                    <a class="nav-link" href="/fetch">Fetch
                    </a>
                </li>

                <li class="nav-item hover:underline text-sm">
                    <a class="nav-link" href="/table">Tables
                    </a>
                </li>
            </ul>

            <ul class="header-nav ms-auto">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bell') }} "></use>
                        </svg>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list-rich') }}"></use>
                        </svg>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <svg class="icon icon-lg">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
                        </svg>
                    </a>
                </li> --}}
            </ul>
            <ul class="header-nav ms-3">
                <li class="nav-item dropdown">
                    <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md"><img class="avatar-img" src="{{ asset('assets/img/avatars/11.jpg') }}" alt="Profile Bubble"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <div class="dropdown-header bg-light py-2 bg-white">
                        <div class="fw-semibold">Account</div>
                    </div>
                    {{-- <svg class="icon me-2">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-bell') }}"></use>
                    </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item" href="#">
                    <svg class="icon me-2">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-envelope-open') }}"></use>
                    </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
                    <svg class="icon me-2">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-task') }}"></use>
                    </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item" href="#">
                    <svg class="icon me-2">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-comment-square') }}"></use>
                    </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
                <div class="dropdown-header bg-light py-2">
                    <div class="fw-semibold">Settings</div>
                </div>--}}
                <a class="dropdown-item hover:bg-red-600 hover:text-white" href="/profile">
                    <svg class="icon me-2">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                    </svg> Profile
                </a>


                <div class="dropdown-divider">
                </div>
                    <form method="POST" class="dropdown-item hover:bg-red-600 hover:text-white cursor-pointer" action="{{ route('logout') }}">
                        @csrf
                        <svg class="icon me-2">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}">
                            </use>
                        </svg>
                        <a :href="route('logout')" onclick="event.preventDefault();
                            this.closest('form').submit();">Logout</a>
                    </form>
                </div>
            </li>
            </ul>
        </div>
    </header>
    <div class="c-body">
    <main class="c-main">
</div>
