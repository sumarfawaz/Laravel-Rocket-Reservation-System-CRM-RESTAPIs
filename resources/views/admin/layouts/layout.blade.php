<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="ROCKETX">
    <meta name="keywords" content="ROCKETX, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.ROCKETX.io/pages-blank.html" />

    <title>{{ $title ?? 'Default Title' }}</title>

    @livewireStyles
    <link href="{{asset('admin_asset/css/app.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    


    <style>
        .sidebar-content {
            background-color: #000000; /* Change this to your desired color */
        }
    
        .sidebar-item.active {
            background-color: #2980b9; /* Active item color */
        }
    
        .sidebar-item a {
            color: rgb(54, 159, 230); /* Change text color */
        }

        .sidebar-item a {
            background-color: rgb(48, 46, 46); /* Change text color */
        }
    
        .sidebar-item a:hover {
            background-color: #2980b9; /* Hover color */
        }

        table {
        margin-top: 0px; /* Adjust as needed */
        width: 100%; /* Ensure full width */
    }

    .modal-dialog {
        max-width: 500px; /* Adjust modal width as needed */
    }

    </style>
    
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar"  class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">ROCKETX</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">Controls</li>

                    <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ url('dashboard') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('manage-users') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ url('manage-users') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('sign-in') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ url('sign-in') }}">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('sign-up') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ url('sign-up') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('blank') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ url('blank') }}">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Tools & Components</li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-buttons.html">
                            <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-forms.html">
                            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-cards.html">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-typography.html">
                            <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Plugins & Addons</li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="charts-chartjs.html">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="maps-google.html">
                            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                        </a>
                    </li>
                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">
                        <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                        <div class="mb-3 text-sm">
                            Are you looking for more components? Check out our premium version.
                        </div>
                        <div class="d-grid">
                            <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">4 New Notifications</div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.</div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">4 New Messages</div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-1.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Vanessa Tucker</div>
                                                <div class="text-muted small mt-1">Vestibulum ante ipsum primis in faucibus.</div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">William Harris</div>
                                                <div class="text-muted small mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Christina Parker">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Christina Parker</div>
                                                <div class="text-muted small mt-1">Nunc euismod libero non dolor tincidunt, in accumsan nisl.</div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Sharon Lessman</div>
                                                <div class="text-muted small mt-1">Duis sagittis purus in sapien aliquet, nec varius quam.</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="profileDropdown" data-bs-toggle="dropdown">
                                <div class="d-flex align-items-center">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <img class="rounded-circle me-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" style="width: 32px; height: 32px;">
                                    @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                                    @endif
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <!-- Account Management -->
                                <div class="dropdown-header">
                                    <strong>{{ __('Manage Account') }}</strong>
                                </div>

                                <a href="{{ route('profile.show') }}" class="dropdown-item">
                                    <i class="align-middle" data-feather="user"></i> {{ __('Profile') }}
                                </a>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <a href="{{ route('api-tokens.index') }}" class="dropdown-item">
                                        <i class="align-middle" data-feather="key"></i> {{ __('API Tokens') }}
                                    </a>
                                @endif

                                <div class="dropdown-divider"></div>

                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a href="#" class="dropdown-item" @click.prevent="$root.submit();">
                                        <i class="align-middle" data-feather="log-out"></i> {{ __('Log Out') }}
                                    </a>
                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <!-- Place the dynamic content here -->
                    @yield('admin_layout')
                    
                </div>
            </main>
        </div>
    </div>

    <script src="{{asset('admin_asset/js/app.js')}}"></script>
    
    <script src="{{asset('admin_asset/js/analytics.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
        
    @livewireScripts
</body>

</html>
