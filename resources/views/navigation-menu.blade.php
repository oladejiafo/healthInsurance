<!-- Header -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>insurAce</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

    <style>
        .mdi {
            color: #000;
        }
        .text-info {
        color: #db190b !important;
    }
        body {
            width: 100%;
        }

        .sidebar .nav.sub-menu .nav-item .nav-link {
            font-size: 13px !important;
        }
        .sidebar .nav .nav-item .nav-link .menu-title {
            font-size: 15px !important;
        }
    </style>
</head>

<body>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
</form>
@auth
    @php
session_start();

    $usr = Auth::user();
    $lastActivity = session('lastActivityTime', 0);
    $timeoutMinutes = 10;
    $timeoutSeconds = $timeoutMinutes * 60;
    $now = time();

    if ($usr && ($now - $lastActivity) > $timeoutSeconds) {

    } else {
        session(['lastActivityTime' => $now]);
    }

        $user = auth()->user();
        $role = $user->role;
    @endphp


    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}"><img
                        src="{{ asset('images/logo-plain.png') }}" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img src="images/logo-mini.png"
                        alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle " src="{{ asset('assets/images/faces/face15.jpg') }}" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal" style="color:#fff">{{ Auth::user()->name }}</h5>
                                <span>{{ $role->name }}</span>
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i
                                class="mdi mdi-dots-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                            aria-labelledby="profile-dropdown">

                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-onepassword  text-info"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                                </div>
                            </a>

                        </div>
                    </div>
                </li>
                <!-- <li class="nav-item menu-items">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li> -->

                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#dashboard" aria-expanded="true"
                        aria-controls="dashboard">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Dashboards</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard') }}"> Basic Insights</a></li>
                            @if ($role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='cfo')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('claimsDashboard') }}"> Claims Insights</a></li>
                            @endif
                            @if ($role->slug =='medical_head' || $role->slug =='underwriting_head' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='claim_officer')
                            <li class="nav-item"> <a class="nav-link" href="{{ route('providersDashboard') }}"> Providers Insights</a></li>
                            @endif
                            @if ($role->slug =='underwriting_head' || $role->slug =='client_relation' || $role->slug =='admin' || $role->slug =='super_admin')
                            <li class="nav-item"> <a class="nav-link" href="#"> Enrollment Insights</a></li>
                            @endif
                            @if ($role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='cfo')
                            <li class="nav-item"> <a class="nav-link" href="#"> Financial Insights</a></li>
                            @endif
                            @if ($role->slug =='medical_head' || $role->slug =='underwriting_head' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='cfo')
                            <li class="nav-item"> <a class="nav-link" href="#"> Utilization Insights</a></li>
                            @endif
                            @if ($role->slug =='medical_head' || $role->slug =='underwriting_head' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='cfo')
                            <li class="nav-item"> <a class="nav-link" href="#"> Operational Insights</a></li>
                            @endif
                        </ul>
                    </div>
                </li>

                @if ($role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='claim_officer' || $role->slug =='cfo')
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#claims" aria-expanded="false"
                        aria-controls="claims">
                        <span class="menu-icon">
                            <i class="mdi mdi-recycle" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Claims</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="claims">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('createClaims') }}">Add New Claim</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('claimsSummary') }}">Manage
                                    Claims</a></li>
                            <li class="nav-item"> <a class="nav-link" href="#">Capitation</a></li>
                        </ul>
                    </div>
                </li>

                @endif
                
                @if ($role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='underwriting_head' || $role->slug =='claim_officer' || $role->slug =='client_relation' || $role->slug =='client_management' || $role->slug =='enrollment_officer')

                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#registers" aria-expanded="false"
                        aria-controls="registers">
                        <span class="menu-icon">
                            <i class="mdi mdi-file-document-box" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Registers</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="registers">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('providers') }}"> Providers
                                </a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('clients') }}"> Clients
                                </a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('enrollees') }}"> Enrollees
                                </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Provider
                                    Manifest </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Client
                                    Manifest </a></li>
                        </ul>
                    </div>
                </li>
                @endif
                
                @if ($role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='underwriting_head' || $role->slug =='claim_officer' || $role->slug =='client_relation' || $role->slug =='client_management' || $role->slug =='enrollment_officer')
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#requests" aria-expanded="false"
                        aria-controls="requests">
                        <span class="menu-icon">
                            <i class="mdi mdi-repeat" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Request</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="requests">
                        <ul class="nav flex-column sub-menu">
                        @if ($role->slug !='enrollment_officer' && $role->slug !='client_management' && $role->slug !='client_relation')
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Claims
                                    Request </a></li>
                        @endif
                
                        @if ($role->slug !='enrollment_officer' && $role->slug !='client_management' && $role->slug !='underwriting_head' && $role->slug !='client_relation')
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html">
                                    Authorization Codes </a></li>
                        @endif
                
                        @if ($role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='underwriting_head' || $role->slug =='claim_officer' || $role->slug =='client_relation')
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Complaints
                                </a></li>
                        @endif
                
                        @if ($role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='underwriting_head' )        
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Enrollee
                                    Applications </a></li>
                        @endif
                
                        @if ($role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='underwriting_head' || $role->slug =='client_relation')        
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Clients
                                    Requests </a></li>
                        @endif
                        </ul>
                    </div>
                </li>
                @endif
                
                @if ($role->slug =='cfo' || $role->slug =='accountant' || $role->slug =='super_admin' || $role->slug =='enrollment_officer')
                <li class="nav-item menu-items">
                    <a class="nav-link" href="pages/forms/basic_elements.html">
                        <span class="menu-icon">
                            <i class="mdi mdi-receipt" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Accounts</span>
                    </a>
                </li>
                @endif
                
                @if ($role->slug =='cfo' || $role->slug =='accountant' || $role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='underwriting_head' || $role->slug =='claim_officer')
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{ route('tariffs') }}">
                        <span class="menu-icon">
                            <i class="mdi mdi-library" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Tariff</span>
                    </a>
                </li>
                @endif
                
                @if ($role->slug =='cfo' || $role->slug =='accountant' || $role->slug =='medical_head' || $role->slug =='hmo_supervisor' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='underwriting_head')
                <li class="nav-item menu-items">
                    <a class="nav-link" href="pages/charts/chartjs.html">
                        <span class="menu-icon">
                            <i class="mdi mdi-chart-bar" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Reports</span>
                    </a>
                </li>
                @endif

                @if ($role->slug =='client_management' || $role->slug =='enrollment_officer' || $role->slug =='client_relation' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='underwriting_head')
                <li class="nav-item menu-items">
                    <a class="nav-link"
                        href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
                        <span class="menu-icon">
                            <i class="mdi mdi-message-processing" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Messaging</span>
                    </a>
                </li>

                @endif

                @if ($role->slug =='cfo' || $role->slug =='admin' || $role->slug =='super_admin' || $role->slug =='medical_head')
 
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#cpanel" aria-expanded="false"
                        aria-controls="cpanel">
                        <span class="menu-icon">
                            <i class="mdi mdi-server-security" style="color:#fff;"></i>
                        </span>
                        <span class="menu-title">Control Panel</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="cpanel">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('viewUser') }}"> Manage Users </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html">
                                    Settings </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> Logs
                                </a></li>
                            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Backup & Restore </a></li>
                            
                        </ul>
                    </div>
                </li>

                @endif
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/logo-mini.svg') }}"
                            alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">
                        <li class="nav-item w-100">
                            <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                <input type="text" class="form-control" placeholder="Search products">
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">

                        <li class="nav-item nav-settings d-none d-lg-block">
                            <a class="nav-link" href="#">
                                <i class="mdi mdi-view-grid"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                                data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-email"></i>
                                <span class="count bg-success"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="messageDropdown">
                                <h6 class="p-3 mb-0">Messages</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image"
                                            class="rounded-circle profile-pic">
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                                        <p class="text-muted mb-0"> 1 Minutes ago </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="{{ asset('assets/images/faces/face2.jpg') }}" alt="image"
                                            class="rounded-circle profile-pic">
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                                        <p class="text-muted mb-0"> 15 Minutes ago </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="{{ asset('assets/images/faces/face3.jpg') }}" alt="image"
                                            class="rounded-circle profile-pic">
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                                        <p class="text-muted mb-0"> 18 Minutes ago </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <p class="p-3 mb-0 text-center">4 new messages</p>
                            </div>
                        </li>
                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown"
                                href="#" data-toggle="dropdown">
                                <i class="mdi mdi-bell"></i>
                                <span class="count bg-danger"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                <h6 class="p-3 mb-0">Notifications</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-calendar text-success"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Event today</p>
                                        <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event
                                            today </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Settings</p>
                                        <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-link-variant text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Launch Admin</p>
                                        <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <p class="p-3 mb-0 text-center">See all notifications</p>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="{{ asset('assets/images/faces/face15') }}.jpg"
                                        alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Manage Account</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="{{ route('profile.show') }}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-success"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Profile</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a class="dropdown-item preview-item" href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-dark rounded-circle">
                                                <i class="mdi mdi-logout text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <p class="preview-subject mb-1">
                                               
                                                {{ __('Log Out') }}
                                              
                                            </p>
                                        </div>
                                    </a>
                                </form>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            
@endauth

</body>

</html>
