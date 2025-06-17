<!-- https://wowdash.wowtheme7.com/demo/index.html -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/remixicon.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/prism.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @stack('styles')
</head>
<body>
    <aside class="sidebar">
        <button type="button" class="sidebar-close-btn">
            <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
        </button>
        <div>
            <a href="{{ route('home') }}" class="sidebar-logo">
                <img src="{{ asset('img/logo.png') }}" alt="site logo" class="light-logo">
                <img src="{{ asset('img/logo-light.png') }}" alt="site logo" class="dark-logo">
                <img src="{{ asset('img/logo-icon.png') }}" alt="site logo" class="logo-icon">
            </a>
        </div>
        <div class="sidebar-menu-area">
            <ul class="sidebar-menu" id="sidebar-menu">
                <li>
                    <a href="{{ route('home') }}">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('venue')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-list-indefinite text-xl me-14 d-flex menu-icon"></i>
                        <span>Venue</span>
                    </a>
                    <ul class="sidebar-submenu">
                        @can('create venue')
                        <li>
                            <a href="{{ route('venues.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add Venue
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('venues.index') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Venue List
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('item')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
                        <span>Items</span>
                    </a>
                    <ul class="sidebar-submenu">
                        @can('create item')
                        <li>
                            <a href="{{ route('items.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add Item
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('items.index') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Item List
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('employee')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                        <span>Employees</span>
                    </a>
                    <ul class="sidebar-submenu">
                        @can('create employee')
                        <li>
                            <a href="{{ route('employees.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add Employee
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('employees.index') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Employee List
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('event')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-lock-star-fill text-xl me-14 d-flex menu-icon"></i>
                        <span>Events</span>
                    </a>
                    <ul class="sidebar-submenu">
                        @can('create event')
                        <li>
                            <a href="{{ route('events.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add Event
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('events.index') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Event List
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('template')
                <li>
                    <a href="{{ route('templates.index') }}">
                        <i class="ri-lock-star-line text-xl me-14 d-flex menu-icon"></i>
                        <span>Templates</span>
                    </a>
                </li>
                @endcan
                @can('portfolio')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-image-circle-fill text-xl me-14 d-flex menu-icon"></i>
                        <span>Portfolios</span>
                    </a>
                    <ul class="sidebar-submenu">
                        @can('create portfolio')
                        <li>
                            <a href="{{ route('portfolios.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add Portfolio
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('portfolios.index') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Portfolio List
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('role')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <i class="ri-user-settings-line text-xl me-14 d-flex w-auto"></i>
                        <span>Roles</span>
                    </a>
                    <ul class="sidebar-submenu">
                        @can('create role')
                        <li>
                            <a href="{{ route('roles.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add Role
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('roles.index') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Role List
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('user')
                <li class="dropdown">
                    <a href="javascript:void(0)">
                        <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                        <span>Users</span>
                    </a>
                    <ul class="sidebar-submenu">
                        <li>
                            <a href="{{ route('users.create') }}">
                                <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add User
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}">
                                <i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> User List
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('assign-event')
                <li>
                    <a href="{{ route('event.index') }}">
                        <i class="ri-lock-star-fill text-xl me-14 d-flex menu-icon"></i>
                        <span>Events</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </aside>
    <main class="dashboard-main">
        <div class="navbar-header">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <button type="button" class="sidebar-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                            <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                        </button>
                        <button type="button" class="sidebar-mobile-toggle">
                            <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
                        <div class="dropdown">
                            <button class="has-indicator w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown">
                                <iconify-icon icon="iconoir:bell" class="text-primary-light text-xl"></iconify-icon>
                            </button>
                            <div class="dropdown-menu to-top dropdown-menu-lg p-0">
                                <div class="m-16 py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                    <div>
                                        <h6 class="text-lg text-primary-light fw-semibold mb-0">Notifications</h6>
                                    </div>
                                    <span class="text-primary-600 fw-semibold text-lg w-40-px h-40-px rounded-circle bg-base d-flex justify-content-center align-items-center">{{ count(auth()->user()->unreadNotifications) }}</span>
                                </div>
                                <div class="max-h-400-px overflow-y-auto scroll-sm pe-4">
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ $notification->data['url'] }}?notification_id={{$notification->id}}" class="px-24 py-12 d-flex align-items-start gap-3 mb-2 justify-content-between">
                                        <div class="text-black hover-bg-transparent hover-text-primary d-flex align-items-center gap-3">
                                            <span class="w-44-px h-44-px bg-success-subtle text-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                                                <iconify-icon icon="bitcoin-icons:verify-outline" class="icon text-xxl"></iconify-icon>
                                            </span>
                                            <div>
                                                <h6 class="text-md fw-semibold mb-4">{{ $notification->data['title'] }}</h6>
                                                <p class="mb-0 text-sm text-secondary-light text-w-200-px">{{ $notification->data['body'] }}</p>
                                            </div>
                                        </div>
                                        <span class="text-sm text-secondary-light flex-shrink-0">{{ $notification->created_at->diffForHumans() }}</span>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Notification dropdown end -->
                        <div class="dropdown">
                            <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('img/user.png') }}" alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle">
                            </button>
                            <div class="dropdown-menu to-top dropdown-menu-sm">
                                <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                                    <div>
                                        <h6 class="text-lg text-primary-light fw-semibold mb-2">{{ Auth::user()->name }}</h6>
                                        <span class="text-secondary-light fw-medium text-sm">{{ Auth::user()->email }}</span>
                                    </div>
                                    <button type="button" class="hover-text-danger">
                                        <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                                    </button>
                                </div>
                                <ul class="to-top-list">
                                    <li>
                                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="view-profile.html">
                                            <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon>
                                            My Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon>
                                            Log Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Profile dropdown end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-main-body">
            @yield('content')
        </div>
        <footer class="d-footer">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <p class="mb-0">© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All Rights Reserved.</p>
                </div>
                <div class="col-auto">
                    <p class="mb-0">Made by <span class="text-primary-600">Designs365</span></p>
                </div>
            </div>
        </footer>
    </main>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/iconify-icon.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/prism.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function(){
            if($('#dataTable').length != 0){
                var table = $('#dataTable').DataTable({order:[[0,"desc"]]});
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
