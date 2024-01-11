@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Overview</h4>
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="text-center py-3 border-end">
                                <h5>$43,669</h5>
                                <span class="text-muted">Total Earning</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center py-3 border-end">
                                <h5>$3,639</h5>
                                <span class="text-muted">Average Earning</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center py-3 border-end">
                                <h5>$30,277</h5>
                                <span class="text-muted">Total Expense </span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="text-center py-3">
                                <h5>$2,523</h5>
                                <span class="text-muted">Average Expense</span>
                            </div>
                        </div>
                    </div>
                    <div id="overview-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3>$168.90</h3>
                            <span class="text-muted fw-semibold">This Month</span>
                        </div>
                        <div class="text-success fw-bold font-size-lg">+18%</div>
                    </div>
                    <div class="mt-4" id="monthly-revenue" style="max-width: 250px;"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-muted mb-2">This Quarter</div>
                    <h3>$3,936.80</h3>
                    <span class="text-muted fw-semibold">Total Revenue</span>
                    <div class="mt-4">
                        <h4 class="mb-1">88</h4>
                        <div class="text-muted d-flex justify-content-between mb-2">
                            <span>Online Revenue</span>
                            <span>70%</span>
                        </div>
                        <div class="progress-sm progress">
                            <div class="progress-bar bg-info" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="mb-1">69</h4>
                        <div class="text-muted d-flex justify-content-between mb-2">
                            <span>Offline Revenue</span>
                            <span>50%</span>
                        </div>
                        <div class="progress-sm progress">
                            <div class="progress-bar bg-success" style="width: 50%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="row">
                    <div class="col-md-8 border-end">
                        <div class="p-3">
                            <div id="region-data-map" style="width: 100%; height: 535px"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-center mt-5 pt-3">
                            <div id="region-data-chart"></div>
                        </div>
                        <div class="mt-5 mx-auto" style="max-width: 200px;">
                            <div class="mt-5 mx-auto" style="max-width: 200px;">
                                <div class="d-flex align-item-center justify-content-between mb-3">
                                    <div>
                                        <span class="badge-dot" style="background-color: rgb(17, 161, 253);"></span>
                                        <span class="text-dark fw-bolder ms-2">Texas</span>
                                    </div>
                                    <span>4447100</span>
                                </div>
                                <div class="d-flex align-item-center justify-content-between mb-3">
                                    <div>
                                        <span class="badge-dot" style="background-color: rgb(0, 197, 105);"></span>
                                        <span class="text-dark fw-bolder ms-2">Georgia</span>
                                    </div>
                                    <span>626932</span>
                                </div>
                                <div class="d-flex align-item-center justify-content-between mb-3">
                                    <div>
                                        <span class="badge-dot" style="background-color: rgb(255, 200, 51);"></span>
                                        <span class="text-dark fw-bolder ms-2">Utah</span>
                                    </div>
                                    <span>5130632</span>
                                </div>
                                <div class="d-flex align-item-center justify-content-between mb-3">
                                    <div>
                                        <span class="badge-dot" style="background-color: rgb(90, 117, 249);"></span>
                                        <span class="text-dark fw-bolder ms-2">Nebraska</span>
                                    </div>
                                    <span>5130632</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
