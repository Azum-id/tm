@php
    // random warning, info, danger, success
    $alert = ['warning', 'info', 'danger', 'success'];
    $alert = $alert[rand(0, 3)];
    $nama = auth()->user()->name;
    $kata = explode(' ', $nama);
    $result = '';

    // Ambil 1 huruf pertama dari setiap kata pada maksimal 2 kata pertama
    foreach (array_slice($kata, 0, 2) as $k) {
        $result .= substr($k, 0, 1);
    }
    $panjangMax = 10; // Tentukan panjang maksimal yang diinginkan
    $namaSingkat = strlen($nama) > $panjangMax ? substr($nama, 0, $panjangMax) . '...' : $nama;

    $admin = Str::ucfirst(auth()->user()->role);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} | Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/images/logo/favicon.ico">

    <!-- page css -->
    <link href="/assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Core css -->
    <link href="/assets/css/app.min.css" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="/assets/fontawesome/css/font-awesome.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <!-- MomentJS -->
    <script src="/assets/js/moment.min.js"></script>

    @yield('azs_css')

</head>

<body>
    <div class="layout">
        <div class="vertical-layout">
            <!-- Header START -->
            <div class="header-nav layout-vertical header-text-light" style="background-color: rgb(17, 161, 253);">
                <div class="header-nav-wrap">
                    <div class="header-nav-left">
                        <div class="header-nav-item desktop-toggle">
                            <div class="header-nav-item-select cursor-pointer">
                                <i class="nav-icon feather icon-menu icon-arrow-right"></i>
                            </div>
                        </div>
                        <div class="header-nav-item mobile-toggle">
                            <div class="header-nav-item-select cursor-pointer">
                                <i class="nav-icon feather icon-menu icon-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="header-nav-right">
                        <div class="header-nav-item">
                            <div class="dropdown header-nav-item-select nav-profile">
                                <div class="toggle-wrapper" id="nav-profile-dropdown" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-text bg-warning">
                                        <span>{{ $result }}</span>
                                    </div>
                                    <span class="fw-bold mx-1">{{ $namaSingkat }}</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="nav-profile-header">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-text bg-warning">
                                                <span>{{ $result }}</span>
                                            </div>
                                            <div class="d-flex flex-column ms-1">
                                                <span class="fw-bold text-dark">{{ auth()->user()->name }}</span>
                                                <span class="font-size-sm">{{ $admin }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button class="dropdown-item" type="submit">
                                            <div class="d-flex align-items-center"><i class="font-size-lg me-2 feather icon-power"></i>
                                                <span>Sign Out</span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header END -->

            @include('partials.navbar')

            <!-- Content START -->
            <div class="content">
                <div class="main">
                    <div class="page-header">
                        <div class="breadcrumb">
                            <span class="me-1 text-gray"><i class="feather icon-home"></i></span>
                            <div class="breadcrumb-item"><a href="index.html"> Home </a></div>
                            <div class="breadcrumb-item"><a href="v-form-elements.html"> Tiket Masuk </a></div>
                        </div>
                    </div>
                    @yield('content')
                </div>
                <!-- Footer START -->
                <div class="footer">
                    <div class="footer-content">
                        <p class="mb-0">Copyright © 2021 Azusa-ID. All rights reserved.</p>
                        <span>
                            <a href="" class="text-gray me-3">Term &amp; Conditions</a>
                            <a href="" class="text-gray">Privacy &amp; Policy</a>
                        </span>
                    </div>
                </div>
                <!-- Footer End -->
            </div>
            <!-- Content END -->

            <!-- Quick View START -->
            <div class="modal modal-right fade quick-view" id="quick-view">
                <div class="modal-dialog right">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title pull-left">Theme Config</h4>
                            <button type="button" class="close pull-right" data-bs-dismiss="modal">
                                <span>×</span>
                            </button>
                        </div>
                        <div class="modal-body scrollable">
                            <div class="mb-4">
                                <h5 class="mb-0">Header Color</h5>
                                <p>Config header background color</p>
                                <div class="theme-configurator d-flex mt-2">
                                    <div class="radio">
                                        <input id="header-default" name="header-theme" type="radio" checked value="#ffffff">
                                        <label for="header-default"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-primary" name="header-theme" type="radio" value="#11a1fd">
                                        <label for="header-primary"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-success" name="header-theme" type="radio" value="#00c569">
                                        <label for="header-success"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-info" name="header-theme" type="radio" value="#5a75f9">
                                        <label for="header-info"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-warning" name="header-theme" type="radio" value="#ffc833">
                                        <label for="header-warning"></label>
                                    </div>
                                    <div class="radio">
                                        <input id="header-danger" name="header-theme" type="radio" value="#f46363">
                                        <label for="header-danger"></label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="mb-0">Side Nav Dark</h5>
                                <p>Change Side Nav to dark</p>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="side-nav-theme-toggle" id="side-nav-theme-toggle">
                                    <label class="form-check-label" for="side-nav-theme-toggle"></label>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="mb-0">Folded Menu</h5>
                                <p>Toggle Folded Menu</p>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="side-nav-fold-toogle" id="side-nav-fold-toogle">
                                    <label class="form-check-label" for="side-nav-fold-toogle"></label>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <h5 class="mb-0">Horizontal Layout</h5>
                                <p>Set Horizontal Layout</p>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary active" aria-current="page">Vertical</a>
                                    <a href="h-index.html" class="btn btn-outline-primary">Horizontal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Quick View END -->
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="/assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Core JS -->
    <script src="/assets/js/app.min.js"></script>
    @yield('azs_js')

</body>

</html>
