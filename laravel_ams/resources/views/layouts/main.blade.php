<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>AMS - UP3 PLN Makassar</title>
    <!-- Favicon icon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/') }}./asset/frontend/images/icon.svg" />
    <link rel="stylesheet" href="{{ asset('/') }}./asset/frontend/vendor/chartist/css/chartist.min.css" />
    <link href="{{ asset('/') }}./asset/frontend/vendor/bootstrap-select/dist/css/bootstrap-select_dark.min.css"
        rel="stylesheet" />
    <link href="{{ asset('/') }}./asset/frontend/vendor/owl-carousel/owl.carousel.css" rel="stylesheet" />
    <link href="{{ asset('/') }}./asset/frontend/css/style.css" rel="stylesheet" />


    <!-- Form step -->
    <link href="{{ asset('/') }}./asset/frontend/vendor/wizard2/dist/css/smart_wizard_all.css" rel="stylesheet" />

    {{-- <link href="{{ asset('/') }}./asset/frontend/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css"
        rel="stylesheet" /> --}}

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" /> --}}

    <!-- Pickdate -->
    <link href="{{ asset('/') }}./asset/frontend/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/') }}./asset/frontend/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="{{ asset('/') }}./asset/frontend/vendor/pickadate/themes/default.date.css">

    <!-- Summernote -->
    <link href="{{ asset('/') }}./asset/frontend/vendor/summernote/summernote.css" rel="stylesheet">

    <link href="{{ asset('/') }}./asset/frontend/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="{{ asset('/') }}./asset/frontend/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>



    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>


    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/dashboard" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('/') }}./asset/frontend/images/ams-sq.svg" width="500" alt="">
                <img class="logo-compact" src="{{ asset('/') }}./asset/frontend/images/ams-sq.svg" width="500" alt="">
                <img class="brand-title" src="{{ asset('/') }}./asset/frontend/images/ams-lg2.svg" width="500" height="200" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->

        <!--**********************************
            Chat box End
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                {{ $title }}
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">


                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    <img src="{{ asset('/') }}./asset/frontend/images/profile/17.jpg" width="20"
                                        alt="" />
                                    <div class="header-info">
                                        <span class="text-white"><strong>Nama User</strong></span>
                                        <p class="text-warning fs-12 mb-0">Level User</p>
                                    </div>


                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="./page-login.html" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12">
                                            </line>
                                        </svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li><a class="nav-link" href="/dashboard">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <h5>
                        <p class="fs-12 ml-3 mt-4 mb-1 text-black">Anggaran</p>
                    </h5>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="bi bi-cash-coin"></i>
                            <span class="nav-text">SKK/PRK </span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a class="nav-link {{ Request::is('spkk*') ? 'active' : '' }}"
                                    href="/skk"><strong>SKK</strong></a>
                            </li>
                            <li><a class="nav-link {{ Request::is('prk*') ? 'active' : '' }}"
                                    href="/prk"><strong>PRK</strong></a>
                            </li>
                        </ul>
                    </li>

                    <h5>
                        <p class="fs-12 ml-3 mt-4 mb-1 text-black">KHS</p>
                    </h5>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            <span class="nav-text">KHS</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a class="nav-link {{ Request::is('po-khs*') ? 'active' : '' }}" href="/po-khs">
                                    <strong>Buat PO</strong>
                                </a>
                            </li>
                            {{-- <li>
                                <a class="nav-link {{ Request::is('detailkhs*') ? 'active' : '' }}" href="/detailkhs">
                                    Vendor KHS
                                </a>
                            </li> --}}
                            <li>
                                <a class="has-arrow ai-icon nav-link {{ Request::is('detailkhs*') ? 'active' : '' }}"
                                    href="javascript:void()">
                                    <strong>Detail KHS</strong>
                                </a>
                                <ul aria-expanded="false">
                                    <!-- <li><a class="" href="/categories">Kategori</a></li> -->
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/jenis-khs">&ensp; &ensp; Jenis KHS</a></li>
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/vendor-khs">&ensp; &ensp; Vendor KHS</a></li>
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/menu-item-khs">&ensp; &ensp; Item KHS</a></li>
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/kontrak-induk-khs">&ensp; &ensp; Kontrak Induk KHS</a></li>
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/addendum-khs">&ensp; &ensp; Addendum KHS</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <h5>
                        <p class="fs-12 ml-3 mt-4 mb-1 text-black">PO Non KHS</p>
                    </h5>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="bi bi-journal-text"></i>
                            <span class="nav-text">PO Non KHS</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a class="nav-link {{ Request::is('pokhs*') ? 'active' : '' }}" href="/pokhs">
                                    <strong>Buat PO</strong>
                                </a>
                            </li>
                            <li>
                                <a class="has-arrow ai-icon nav-link {{ Request::is('detailkhs*') ? 'active' : '' }}"
                                    href="javascript:void()">
                                    <strong>Detail Non KHS</strong>
                                </a>
                                <ul aria-expanded="false">
                                    <!-- <li><a class="" href="/categories">Kategori</a></li> -->
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/rincian">Vendor Non KHS</a></li>
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/rincian">Addendum Non KHS</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <h5>
                        <p class="fs-12 ml-3 mt-4 mb-1 text-black">Non PO</p>
                    </h5>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="bi bi-journal-bookmark-fill"></i>
                            <span class="nav-text">Non PO</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a class="nav-link {{ Request::is('pokhs*') ? 'active' : '' }}" href="/pokhs">
                                    <strong>Buat PO</strong>
                                </a>
                            </li>
                            <li>
                                <a class="has-arrow ai-icon nav-link {{ Request::is('detailkhs*') ? 'active' : '' }}"
                                    href="javascript:void()">
                                    <strong>Detail Non PO</strong>
                                </a>
                                <ul aria-expanded="false">
                                    <!-- <li><a class="" href="/categories">Kategori</a></li> -->
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/rincian">Vendor Non PO</a></li>
                                    <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                            href="/rincian">Addendum Non PO</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    {{-- <h5>
                        <p class="fs-12 ml-3 mt-4 mb-1 text-black"> Buat Kontrak (PO)</p>
                    </h5>
                    <li>
                        <a class="nav-link {{ Request::is('khs*') ? 'active' : '' }}" href="/po-khs"
                            aria-expanded="">
                            <i class="flaticon-381-notebook-2"></i>
                            <span class="nav-text">Buat Kontrak</span>
                        </a>
                    </li>
                    <h5>
                        <p class="fs-12 ml-3 mt-4 mb-1 text-black">Harga HPE</p>
                    </h5>
                    <li>
                        <a class="nav-link {{ Request::is('hpe*') ? 'active' : '' }}" href="/hpe"
                            aria-expanded="">
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            <span class="nav-text">HPE</span>
                        </a>
                    </li> --}}
                </ul>
                <div class="add-menu-sidebar" id="products">
                    <img src="{{ asset('/') }}./asset/frontend/images/calendar.png" alt=""
                        class="mr-2" />
                    <p class="font-w500 mb-0" id="reload" name="reload">{{ date('D, d-M-Y H:i:s') }} </p>
                </div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <!-- <div class="floating-container">
            <div class="floating-button">+</div>
            <div class="element-container">
                <span class="float-element">
                    <i class="material-icons">phone
                    </i>
                </span>
                <span class="float-element">
                    <i class="material-icons">Apa</i>
                </span>
                <span class="float-element">
                    <i class="material-icons">chat</i>
                </span>
            </div>
        </div> -->

        <!-- <a href="/buat-kontrak">
            <button class="btn-floating facebook">
                <img src="{{ asset('/') }}./asset/frontend/images/iconcreate.svg" width="85px" height="85px"
                    alt="">
                <span style="color: #5DCDE0"> Buat Kontrak </span>
            </button>
        </a> -->

        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://www.youtube.com/" target="_blank">....</a>
                    2022</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/global/global.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/custom.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/deznav-init.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/owl-carousel/owl.carousel.js"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/peity/jquery.peity.min.js"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/apexchart/apexchart.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/chartjs-init.js"></script>

    <script src="/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/chartjs-init.js"></script>


    <!-- Dashboard 1 -->
    <script src="{{ asset('/') }}./asset/frontend/js/dashboard/dashboard-1.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/dashboard/dashboard-1.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/jquery-validation/jquery.validate.min.js"></script>

    <!-- Form Steps -->

    {{-- <script src="{{ asset('/') }}./asset/frontend/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script> --}}
    <script src="{{ asset('/') }}./asset/frontend/vendor/wizard2/dist/js/jquery.smartWizard.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/jquery.validate-init.js"></script>
    {{-- <script src="{{ asset('/') }}./asset/frontend/js/tambah-field.js"></script> --}}
    {{-- <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script> --}}

    {{-- <script src="{{ asset('/') }}./asset/frontend/js/cascading-dropdown.js"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"
        integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    <script>
        document.getElementById("wrap").addEventListener("scroll", function() {
            var translate = "translate(0," + this.scrollTop + "px)";
            this.querySelector("thead").style.transform = translate;
        });
    </script>

    <script type="text/javascript">
        function updateDiv() {
            document.getElementById("reload").innerHTML = document.getElementById("reload").innerHTML;
        }
    </script>

    <script>
        $(document).ready(function() {
            // SmartWizard initialize
            $('#smartwizard').smartWizard();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        // $(document).ready(function() {
        //     setInterval(function() {
        //         $('#reload').load(window.location.href + " #reload");
        //     }, 1000);
        // });

        // var fixmeTop = $('.fixme').offset().top;
        // $(window).scroll(function() {
        //     var currentScroll = $(window).scrollTop();
        //     if (currentScroll >= fixmeTop) {
        //         $('.fixme').css({
        //             position: 'fixed',
        //             top: '0',
        //             left: '0'
        //         });
        //     } else {
        //         $('.fixme').css({
        //             position: 'static'
        //         });
        //     }
        // });
    </script>



    <!-- <script>
        $("input").on("change", function() {
            this.setAttribute(
                "data-date",
                moment(this.value, "YYYY-MM-DD")
                .format(this.getAttribute("data-date-format"))
            )
        }).trigger("change")
    </script> -->

    


    @yield('ajax')
    <!-- Summernote -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/summernote/js/summernote.min.js"></script>
    <!-- Summernote init -->
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/summernote-init.js"></script>

    <!-- pickdate -->
    <script src="{{ asset('/') }}./asset/frontend//vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/pickadate/picker.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/pickadate/picker.time.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/pickadate/picker.date.js"></script>

    <!-- Pickdate -->
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/material-date-picker-init.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/pickadate-init.js"></script>

    {{-- <script src="{{ asset('/') }}./asset/frontend/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/sweetalert.init.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/sweetalert-init.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/vendor/sweetalert/sweetalert.all.js"></script>

    <script src="{{ asset('./asset/frontend/js/plugins-init/sweetalert-init.js') }}"></script>
    <script src="{{ asset('./asset/frontend/js/plugins-init/sweetalert.init.js') }}"></script>
    <script src="{{ asset('./asset/frontend/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script> --}}
    <!-- Datatable -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>


    {{-- <script>
        function carouselReview() {
            /*  testimonial one function by = owl.carousel.js */
            jQuery(".testimonial-one").owlCarousel({
                loop: true,
                autoplay: true,
                margin: 30,
                nav: false,
                dots: false,
                left: true,
                navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                    '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
                ],
                responsive: {
                    0: {
                        items: 1,
                    },
                    484: {
                        items: 2,
                    },
                    882: {
                        items: 3,
                    },
                    1200: {
                        items: 2,
                    },

                    1540: {
                        items: 3,
                    },
                    1740: {
                        items: 4,
                    },
                },
            });
        }
        jQuery(window).on("load", function() {
            setTimeout(function() {
                carouselReview();
            }, 1000);
        });
    </script> --}}
</body>

</html>
