@extends('layouts.main')

@section('content')
<div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-warning mr-md-4 mr-3">
                                                <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="", width="39px">
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-14 mb-2">Pemasangan SP 1 Fasa</p>
                                                <span class="title text-black font-w600">323</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height:5px;">
                                            <div class="progress-bar bg-primary" style="width: 100%; height:5px;" role="progressbar">
                                                <span class="sr-only">42% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="effect bg-primary"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-warning mr-md-4 mr-3">
                                                <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="", width="39px">
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-14 mb-2">Pemasangan/Penarikan SP 3 Fasa</p>
                                                <span class="title text-black font-w600">241</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height:5px;">
                                            <div class="progress-bar bg-primary" style="width: 100%; height:5px;" role="progressbar">
                                                <span class="sr-only">42% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="effect bg-primary"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-warning mr-md-4 mr-3">
                                                <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="", width="39px">
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-14 mb-2">Pembongkaran</p>
                                                <span class="title text-black font-w600">433</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height:5px;">
                                            <div class="progress-bar bg-primary" style="width: 100%; height:5px;" role="progressbar">
                                                <span class="sr-only">42% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="effect bg-primary"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-warning  mr-md-4 mr-3">
                                                <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="", width="39px">
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-14 mb-2">Pemeliharaan</p>
                                                <span class="title text-black font-w600">271</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height:5px;">
                                            <div class="progress-bar bg-primary" style="width: 100%; height:5px;" role="progressbar">
                                                <span class="sr-only">42% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="effect bg-primary"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-warning mr-md-4 mr-3">
                                                <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="", width="39px">
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-14 mb-2">Pekerjaan Jasa Lainnya</p>
                                                <span class="title text-black font-w600">134</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height:5px;">
                                            <div class="progress-bar bg-primary" style="width: 100%; height:5px;" role="progressbar">
                                                <span class="sr-only">42% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="effect bg-primary"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card avtivity-card">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <span class="activity-icon bgl-warning   mr-md-4 mr-3">
                                                <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="", width="39px">
                                            </span>
                                            <div class="media-body">
                                                <p class="fs-14 mb-2">Material</p>
                                                <span class="title text-black font-w600">297</span>
                                            </div>
                                        </div>
                                        <div class="progress" style="height:5px;">
                                            <div class="progress-bar bg-primary" style="width: 100%; height:5px;" role="progressbar">
                                                <span class="sr-only">42% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="effect bg-primary"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3 mb-sm-0 mb-3">
                                    <h4 class="text-black fs-20">Total Harga Jasa</h4>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-0">
                                <div id="chartBar"></div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
