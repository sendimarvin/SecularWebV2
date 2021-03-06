@php
    if(!Auth::check()){
        redirect()->route('login');
        header('Location: '.'/login');
        dd("Not-Authenticated failed to redirect");
    } else {
        // dd("Authenticated");
    }
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Secular loans</title>
        @yield('custom_css')
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/">Secular Loans</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">&nbsp;</div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                        {{ Auth::check() ? Auth::user()->fullName : '' }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="/">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Application</div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/users">App Users</a>
                                    <a class="nav-link" href="/admins">Admins</a>
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Loans
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url("/loans/applications/pending")}}">Pending App.</a>
                                    <a class="nav-link" href="{{url("/loans/applications/processing")}}">Processing App.</a>
                                    <a class="nav-link" href="{{url("/loans/applications/approved")}}">Approved App.</a>
                                    <a class="nav-link" href="{{url("/loans/applications/disbursed")}}">Disbursed App.</a>
                                    <a class="nav-link" href="{{url("/loans/applications/declined")}}">Declined App.</a>
                                    <a class="nav-link" href="{{url("/loans/applications/paid")}}">Paid App.</a>
                                    <a class="nav-link" href="{{url("/loans/payments")}}">Payments</a>
                                    <a class="nav-link" href="{{url("/payments/application_fees")}}">Application Fees</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePayments" aria-expanded="false" aria-controls="collapsePayments">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Payments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePayments" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url("/subscriptions/payments")}}">Subscriptions</a>
                                    <a class="nav-link" href="/payments/events_tickets">Events Tickets</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseKadaama"
                               aria-expanded="false" aria-controls="collapseKadaama">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Kadaama
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseKadaama" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url("/kadaama/applications")}}">Applications</a>
                                    <a class="nav-link" href="{{url("/kadaama/payments")}}">Payment</a>
                                    <a class="nav-link" href="{{url("/kadaama/rescue_requests")}}">Rescue Requests</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSubscriptions"
                               aria-expanded="false" aria-controls="collapseSubscriptions">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Subscriptions
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSubscriptions" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url("/subscriptions/payments")}}">All</a>
                                    <a class="nav-link" href="{{url("/subscriptions/lifetime")}}">Lifetime</a>
                                </nav>
                            </div>

                            <a class="nav-link" href="/feedback">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Feedback
                            </a>

                            <a class="nav-link" href="{{url("notifications/send")}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Send Notification
                            </a>


                            <div class="sb-sidenav-menu-heading">Settings</div>
                            <a class="nav-link" href="/subscription/subscription_packages">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Subscription
                            </a>

                            <a class="nav-link" href="/events">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Events
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseqa" aria-expanded="false" aria-controls="collapseqa">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                QA & Assement
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseqa" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/question/categories">Categories</a>
                                    <a class="nav-link" href="/question/questions">Questions</a>
                                    <a class="nav-link" href="/question/question_mappings">Mappings</a>
                                    <a class="nav-link" href="{{url("/question/options")}}">Options</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseloansetup" aria-expanded="false" aria-controls="collapseloansetup">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Loans Setup
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseloansetup" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/loans/packages">Packages</a>
                                    <a class="nav-link" href="/loans/sub_packages">Sub-packages</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsetc" aria-expanded="false" aria-controls="collapsetc">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Others
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsetc" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/terms">Terms</a>
                                    <a class="nav-link" href="/policy">Policy</a>
                                    <a class="nav-link" href="/kadama_terms">Kadama Terms</a>
                                    <a class="nav-link" href="/application_fee">Application Fee</a>
                                    <a class="nav-link" href="/payments_setup">Payments Setup</a>
                                    <a class="nav-link" href="/system_backup">System Backup</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLocations" aria-expanded="false" aria-controls="collapseLocations">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Locations
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLocations" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/nationality">Nationalities</a>
                                    <a class="nav-link" href="/country">Countries</a>
                                    <a class="nav-link" href="/region">Regions</a>
                                    <a class="nav-link" href="/district">Districts</a>
                                    <a class="nav-link" href="/subcounty">Sub-county</a>
                                    <a class="nav-link" href="/parish">Parish</a>
                                    <a class="nav-link" href="/village">Village</a>
                                </nav>
                            </div>


                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Secular Loans 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
        @yield('custom_scripts')
    </body>
</html>
