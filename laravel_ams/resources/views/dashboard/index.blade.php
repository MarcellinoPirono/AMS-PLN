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
                                    <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="",
                                        width="39px">
                                </span>
                                <div class="media-body">
                                    <p class="fs-14 mb-2">Pemasangan SP 1 Fasa</p>
                                    
                                    <span class="title text-black font-w600">123</span>
                                    
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
                                    <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="",
                                        width="39px">
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
                                    <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="",
                                        width="39px">
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
                                    <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="",
                                        width="39px">
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
                                    <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="",
                                        width="39px">
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
                                    <img src="{{ asset('/') }}./asset/frontend/images/bolt.svg" alt="",
                                        width="39px">
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
                <div class="card-header">
                    <div class="mr-auto pr-3 mb-sm-0 mb-3">
                        {{-- <h4 class="card-title">Basic Bar Chart</h4> --}}
                        <h4 class="text-black fs-20">Total Harga RAB</h4>
                    </div>
                    <div class="dropdown mb-3 show">

                        <button type="button" class="btn rounded btn-light" data-toggle="dropdown"
                            aria-expanded="true">
                            <i class="bi bi-credit-card-2-front-fill " style="color: rgb(42, 147, 165);"></i>
                            Pilih SPKK
                            <svg class="ml-2" width="14" height="8" viewBox="0 0 14 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 0.999999L7 7L13 1" stroke="#1EA7C5" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0);">SPKK 1</a>
                            <a class="dropdown-item" href="javascript:void(0);">SPKK 2</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="barChart_1"></canvas>
                </div>
            </div>
        </div>

        {{-- <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3 mb-sm-0 mb-3">
                                    <h4 class="text-black fs-20">Total Harga Jasa</h4>
                                    <p class="fs-13 mb-0 text-black">Lorem ipsum dolor sit amet, consectetur</p>
                                </div>
                                <div class="dropdown mb-3 show">
                                    <button type="button" class="btn rounded btn-light" data-toggle="dropdown" aria-expanded="true">
                                        <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip5)">
                                            <path d="M0.988957 17.0741C0.328275 17.2007 -0.104585 17.8386 0.0219823 18.4993C0.133362 19.0815 0.644694 19.4865 1.21678 19.4865C1.29272 19.4865 1.37119 19.4789 1.44713 19.4637L6.4592 18.5018C6.74524 18.4461 7.00091 18.2917 7.18316 18.0639L9.33481 15.3503L8.61593 14.9832C8.08435 14.7149 7.71475 14.2289 7.58818 13.6391L5.55804 16.1983L0.988957 17.0741Z" fill="#A02CFA"/>
                                            <path d="M18.84 6.49306C20.3135 6.49306 21.508 5.29854 21.508 3.82502C21.508 2.3515 20.3135 1.15698 18.84 1.15698C17.3665 1.15698 16.1719 2.3515 16.1719 3.82502C16.1719 5.29854 17.3665 6.49306 18.84 6.49306Z" fill="#A02CFA"/>
                                            <path d="M13.0179 3.15677C12.7369 2.86819 12.4762 2.75428 12.1902 2.75428C12.0864 2.75428 11.9826 2.76947 11.8712 2.79479L7.29203 3.88073C6.6592 4.03008 6.26937 4.66545 6.41872 5.29576C6.54782 5.83746 7.02877 6.20198 7.56289 6.20198C7.65404 6.20198 7.74514 6.19185 7.8363 6.16907L11.7371 5.24513C11.9902 5.52611 13.2584 6.90063 13.4888 7.14364C11.8763 8.87002 10.2639 10.5939 8.65137 12.3202C8.62605 12.3481 8.60329 12.3759 8.58049 12.4038C8.10966 13.0037 8.25397 13.9454 8.96275 14.3023L13.9064 16.826L11.3397 20.985C10.9878 21.5571 11.165 22.3064 11.7371 22.6608C11.9371 22.7848 12.1573 22.843 12.375 22.843C12.7825 22.843 13.1824 22.638 13.4128 22.2659L16.6732 16.983C16.8529 16.6919 16.901 16.34 16.8074 16.0135C16.7137 15.6844 16.4884 15.411 16.1821 15.2566L12.8331 13.553L16.3543 9.78636L19.0122 12.0393C19.2324 12.2266 19.5032 12.3177 19.7716 12.3177C20.0601 12.3177 20.3487 12.2114 20.574 12.0038L23.6243 9.16112C24.1002 8.71814 24.128 7.97392 23.685 7.49803C23.4521 7.24996 23.1383 7.12339 22.8244 7.12339C22.5383 7.12339 22.2497 7.22717 22.0245 7.43727L19.7412 9.56107C19.7386 9.56361 14.0178 4.18196 13.0179 3.15677Z" fill="#A02CFA"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip5">
                                            <rect width="24" height="24" fill="white"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                        Running
                                        <svg class="ml-2" width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 0.999999L7 7L13 1" stroke="#0B2A97" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-0">
                                <div id="chartBar"></div>
                            </div>
                        </div>
                    </div> --}}



        {{-- <div class="col-xl-6 col-xxl-12">
						<div class="card">
							<div class="card-header">
								<div class="mr-auto pr-3 mb-sm-0 mb-3">
									<h4 class="text-black fs-20">Plan List</h4>
									<p class="fs-13 mb-0 text-black">Lorem ipsum dolor sit amet, consectetur</p>
								</div>
								<div class="dropdown mb-3 show">
									<button type="button" class="btn rounded btn-light" data-toggle="dropdown" aria-expanded="true">
										<svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
											<g clip-path="url(#clip5)">
											<path d="M0.988957 17.0741C0.328275 17.2007 -0.104585 17.8386 0.0219823 18.4993C0.133362 19.0815 0.644694 19.4865 1.21678 19.4865C1.29272 19.4865 1.37119 19.4789 1.44713 19.4637L6.4592 18.5018C6.74524 18.4461 7.00091 18.2917 7.18316 18.0639L9.33481 15.3503L8.61593 14.9832C8.08435 14.7149 7.71475 14.2289 7.58818 13.6391L5.55804 16.1983L0.988957 17.0741Z" fill="#A02CFA"/>
											<path d="M18.84 6.49306C20.3135 6.49306 21.508 5.29854 21.508 3.82502C21.508 2.3515 20.3135 1.15698 18.84 1.15698C17.3665 1.15698 16.1719 2.3515 16.1719 3.82502C16.1719 5.29854 17.3665 6.49306 18.84 6.49306Z" fill="#A02CFA"/>
											<path d="M13.0179 3.15677C12.7369 2.86819 12.4762 2.75428 12.1902 2.75428C12.0864 2.75428 11.9826 2.76947 11.8712 2.79479L7.29203 3.88073C6.6592 4.03008 6.26937 4.66545 6.41872 5.29576C6.54782 5.83746 7.02877 6.20198 7.56289 6.20198C7.65404 6.20198 7.74514 6.19185 7.8363 6.16907L11.7371 5.24513C11.9902 5.52611 13.2584 6.90063 13.4888 7.14364C11.8763 8.87002 10.2639 10.5939 8.65137 12.3202C8.62605 12.3481 8.60329 12.3759 8.58049 12.4038C8.10966 13.0037 8.25397 13.9454 8.96275 14.3023L13.9064 16.826L11.3397 20.985C10.9878 21.5571 11.165 22.3064 11.7371 22.6608C11.9371 22.7848 12.1573 22.843 12.375 22.843C12.7825 22.843 13.1824 22.638 13.4128 22.2659L16.6732 16.983C16.8529 16.6919 16.901 16.34 16.8074 16.0135C16.7137 15.6844 16.4884 15.411 16.1821 15.2566L12.8331 13.553L16.3543 9.78636L19.0122 12.0393C19.2324 12.2266 19.5032 12.3177 19.7716 12.3177C20.0601 12.3177 20.3487 12.2114 20.574 12.0038L23.6243 9.16112C24.1002 8.71814 24.128 7.97392 23.685 7.49803C23.4521 7.24996 23.1383 7.12339 22.8244 7.12339C22.5383 7.12339 22.2497 7.22717 22.0245 7.43727L19.7412 9.56107C19.7386 9.56361 14.0178 4.18196 13.0179 3.15677Z" fill="#A02CFA"/>
											</g>
											<defs>
											<clipPath id="clip5">
											<rect width="24" height="24" fill="white"/>
											</clipPath>
											</defs>
										</svg>
										Running
										<svg class="ml-2" width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M1 0.999999L7 7L13 1" stroke="#0B2A97" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="javascript:void(0);">Edit</a>
										<a class="dropdown-item" href="javascript:void(0);">Delete</a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div id="chartBar"></div>
							</div>
						</div>
					</div> --}}

    </div>
@endsection
