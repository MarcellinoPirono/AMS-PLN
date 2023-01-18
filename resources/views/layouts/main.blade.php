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
    {{-- <link href="{{ asset('/') }}./asset/frontend/vendor/bootstrap-select/dist/css/bootstrap-select_dark.min.css"
        rel="stylesheet" /> --}}
    <link href="{{ asset('/') }}./asset/frontend/vendor/owl-carousel/owl.carousel.css" rel="stylesheet" />
    <link href="{{ asset('/') }}./asset/frontend/css/style.css" rel="stylesheet" />
    <link href="{{ asset('/') }}./asset/frontend/css/amsify.select.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/') }}./asset/frontend/vendor/select2/css/select2.min.css">


    <!-- Form step -->
    <link href="{{ asset('/') }}./asset/frontend/vendor/wizard2/dist/css/smart_wizard_all.css" rel="stylesheet" />
    {{--
    <link href="{{ asset('/') }}./asset/frontend/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css"
        rel="stylesheet" /> --}}

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet" />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" /> --}}


    <!-- Pickdate -->
    <link
        href="{{ asset('/') }}./asset/frontend/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/') }}./asset/frontend/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="{{ asset('/') }}./asset/frontend/vendor/pickadate/themes/default.date.css">

    <!-- Summernote -->
    <link href="{{ asset('/') }}./asset/frontend/vendor/summernote/summernote.css" rel="stylesheet">

    <link href="{{ asset('/') }}./asset/frontend/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css"/> --}}


    <link href="{{ asset('/') }}./asset/frontend/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}./asset/frontend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css"
        rel="stylesheet">

    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/pemisah_titik.js"></script>


    <!-- select/search -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->

    <link rel="stylesheet" href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css">

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <style>
        .filepond--file [data-align*=right] {
            right: calc(50% - 0.5em);
            bottom: calc(50% - 1em);
            left: calc(50% - 1em);
        }
    </style>





</head>

<body>



    <!--*******************
        Preloader start
    ********************-->



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
                <img class="logo-abbr" src="{{ asset('/') }}./asset/frontend/images/logo-sq.png" width="700"
                    alt="">
                <img class="logo-compact" src="{{ asset('/') }}./asset/frontend/images/logo-sq.png" width="700"
                    alt="">
                <img class="brand-title" src="{{ asset('/') }}./asset/frontend/images/logo-ls2.png"
                    style="height:40px;" alt="">
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
        @include('layouts.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layouts.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid" id="body_baru">
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
        @include('layouts.footer')
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
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>



    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->

    {{-- <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/jquery.smartWizard.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/wizard.js"></script> --}}


    <script src="{{ asset('/') }}./asset/frontend/vendor/global/global.min.js">
    </script>
    <script src = "{{ asset('/') }}./asset/frontend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" >
    </script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/custom.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/deznav-init.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/jquery.amsifyselect.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/owl-carousel/owl.carousel.js"></script>

    <!-- Chart piety plugin files -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/peity/jquery.peity.min.js"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/apexchart/apexchart.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/chartjs-init.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/chartjs-init.js"></script>


    <!-- Dashboard 1 -->
    <script src="{{ asset('/') }}./asset/frontend/js/dashboard/dashboard-1.js"></script>
    {{-- <script src="{{ asset('/') }}./asset/frontend/js/dashboard/dashboard-1.js"></script> --}}

    <script src="{{ asset('/') }}./asset/frontend/vendor/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/vendor/jquery-validation/jquery.validate.min.js"></script>

    <!-- Form Steps -->

    {{-- <script src="{{ asset('/') }}./asset/frontend/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script> --}}
    <script src="{{ asset('/') }}./asset/frontend/vendor/wizard2/dist/js/jquery.smartWizard.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/select2-init.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/jquery.validate-init.js"></script>
    {{-- <script src="{{ asset('/') }}./asset/frontend/js/tambah-field.js"></script> --}}
    {{-- <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script> --}}

    {{-- <script src="{{ asset('/') }}./asset/frontend/js/cascading-dropdown.js"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"
        integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}



    {{-- <script>
        document.getElementById("wrap").addEventListener("scroll", function() {
            var translate = "translate(0," + this.scrollTop + "px)";
            this.querySelector("thead").style.transform = translate;

        });
    </script>

    <script type="text/javascript">
        function updateDiv() {
            document.getElementById("reload").innerHTML = document.getElementById("reload").innerHTML;
        }

    </script> --}}

    <script>
        var expanded = false;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
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



    <!-- Summernote -->
    <script src="{{ asset('/') }}./asset/frontend/vendor/summernote/js/summernote.min.js"></script>
    <!-- Summernote init -->
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/summernote-init.js"></script>

    <!-- pickdate -->
    <script
        src="{{ asset('/') }}./asset/frontend//vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
    </script>

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
    {{-- <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script> --}}

    {{-- <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script> --}}


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

    <!-- include jQuery library -->

</body>

</html>
