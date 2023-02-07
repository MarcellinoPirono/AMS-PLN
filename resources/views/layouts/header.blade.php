<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        {{ $title }}
                    </div>
                </div>
                {{-- <div class="add-menu-sidebar" id="products">
                    <img style="width: 20px" src="{{ asset('/') }}./asset/frontend/images/calendar.png" alt=""
                        class="mr-2" />
                    <p style="font-size: 12px" class="font-w100 mb-0" id="reload" name="reload">{{ date('D, d-M-Y H:i:s') }} </p>
                </div> --}}
                <ul class="navbar-nav header-right">
                    <li class="nav-item">
                        <div class="add-menu-sidebar" id="products">
                            <img style="width: 20px" src="{{ asset('/') }}./asset/frontend/images/calendar.png" alt=""
                                class="mr-2" />
                            <p style="font-size: 12px" class="font-w100 mb-0" id="reload" name="reload">{{ date('D, d-M-Y H:i:s') }} </p>
                        </div>
                        {{-- <div class="d-xl-inline-flex d-none">
                        </div> --}}
                    </li>

                    @auth
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                @if (auth()->user()->pic_profile != null)
                                    <img width="20" height="20"
                                        src="{{ asset('/storage/' . auth()->user()->pic_profile . '') }}" alt="">
                                @else
                                    <img width="20" height="20"
                                        src="{{ asset('/asset/frontend/images/avatar/avatar.svg') }}" alt="">
                                @endif
                                <div class="header-info">
                                    <span class="text-white"><strong>{{ auth()->user()->username }}</strong></span>
                                    <p style="font-weight: bold" class="text-warning fs-12 mb-0">{{ auth()->user()->role }}
                                    </p>
                                </div>


                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form action="{{ route('user.edit_profile') }}" method="post">
                                    @csrf
                                    <input type="hidden" id="username" name="username"
                                        value="{{ auth()->user()->username }}">
                                    <button type="submit" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile </span>
                                    </button>
                                </form>
                                <button class="dropdown-item ai-icon btnpass">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" class="text-success"
                                        height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                        <path
                                            d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                    </svg>
                                    <span class="ml-2">Ganti Password </span>
                                </button>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item ai-icon">
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
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>
</div>

{{-- Modal EDIT --}}
<div class="modal fade" id="resetpassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="form_reset_password" id="form_reset_password" action="/check-password" method="post"
                method="post">
                @csrf
                {{-- @method('put') --}}
                <div class="modal-body">
                    {{-- <input type="hidden" class="edit_id" value="{{ $khs->jenis_khs }}"> --}}

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Masukkan Password Lama :</label>
                        <div class="input-group transparent-append" style="border-radius: 1.5rem">
                            <div class="input-group-append show-pass4" style="border-radius: 1.5rem">
                                <span class="input-group-text"
                                    style="border-top-left-radius: 1.5rem; border-bottom-left-radius: 1.5rem">
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" style="border-radius-right: 1.5rem"
                                placeholder="Password Lama" id="password_lama" name="password_lama">
                        </div>
                    </div>
                    <div class="form-group">
                        {{-- <input type="hidden" id="username" name="username"
                            value="{{ auth()->user()->username }}"> --}}
                        <label for="recipient-name" class="col-form-label">Masukkan Password Baru :</label>
                        <div class="input-group transparent-append" style="border-radius: 1.5rem">
                            <div class="input-group-append show-pass2" style="border-radius: 1.5rem">
                                <span class="input-group-text"
                                    style="border-top-left-radius: 1.5rem; border-bottom-left-radius: 1.5rem">
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" style="border-radius-right: 1.5rem"
                                placeholder="Password Baru" id="new_password" name="new_password">
                        </div>
                    </div>
                    {{-- <input type="hidden" class="edit_id" value="{{ $khs->nama_pekerjaan }}"> --}}
                    <div class="form-group">
                        <label class="col-form-label">Konfirmasi Password Baru :</label>
                        <div class="input-group transparent-append" style="border-radius: 1.5rem">
                            <div class="input-group-append show-pass3" style="border-radius: 1.5rem">
                                <span class="input-group-text"
                                    style="border-top-left-radius: 1.5rem; border-bottom-left-radius: 1.5rem">
                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" style="border-radius-right: 1.5rem"
                                placeholder="Konfirmasi Password" id="konfirmasi_password"
                                name="konfirmasi_password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

<script>
    jQuery(document).ready(function() {
        jQuery('.show-pass2').on('click', function() {
            // console.log(this);
            jQuery(this).toggleClass('active');
            if (jQuery('#new_password').attr('type') == 'password') {
                jQuery('#new_password').attr('type', 'text');
            } else if (jQuery('#new_password').attr('type') == 'text') {
                jQuery('#new_password').attr('type', 'password');
            }
        });
        jQuery('.show-pass4').on('click', function() {
            // console.log(this);
            jQuery(this).toggleClass('active');
            if (jQuery('#password_lama').attr('type') == 'password') {
                jQuery('#password_lama').attr('type', 'text');
            } else if (jQuery('#password_lama').attr('type') == 'text') {
                jQuery('#password_lama').attr('type', 'password');
            }
        });
        jQuery('.show-pass3').on('click', function() {
            jQuery(this).toggleClass('active');
            if (jQuery('#konfirmasi_password').attr('type') == 'password') {
                jQuery('#konfirmasi_password').attr('type', 'text');
            } else if (jQuery('#konfirmasi_password').attr('type') == 'text') {
                jQuery('#konfirmasi_password').attr('type', 'password');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        jQuery.validator.addMethod("uppercaseCheck",
            function(value, element, param) {
                return this.optional(element) || (value.match(/[A-Z]/));
            }, "Silakan Masukkan Minimal 1 Karakter Uppercase"
        )
        jQuery.validator.addMethod("nomorCheck",
            function(value, element, param) {
                return this.optional(element) || (value.match(/[0-9]/));
            }, "Silakan Masukkan Minimal 1 Karakter Numerik"
        )
        jQuery.validator.addMethod("spesialcharCheck",
            function(value, element, param) {
                return this.optional(element) || (value.match(/[●!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]/));
            }, "Silakan Masukkan Minimal 1 Spesial Karakter"
        )

        var password_lama = document.getElementById('password_lama').value;
        // console.log(password_lama);
        $('.btnpass').click(function(e) {
            $('#resetpassword').modal('show');


            $('#form_reset_password').validate({
                rules: {
                    password_lama: {
                        required: true,
                        // minlength: 5,
                        // uppercaseCheck: true,
                        // nomorCheck: true,
                        // spesialcharCheck: true,
                        remote: {
                            url: "/password-lama",
                            type: "post",
                        }
                    },
                    new_password: {
                        required: true,
                        minlength: 5,
                        uppercaseCheck: true,
                        nomorCheck: true,
                        spesialcharCheck: true,
                    },
                    konfirmasi_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    password_lama: {
                        required: "Silahkan Isi Terlebih Dahulu",
                        // minlength: "Minimal 5 Karakter",
                        remote: "Password Salah",

                    },
                    new_password: {
                        required: "Silahkan Isi Terlebih Dahulu",
                        minlength: "Minimal 5 Karakter",

                    },
                    konfirmasi_password: {
                        required: "Silahkan Isi Terlebih Dahulu",
                        minlength: "Minimal 5 Karakter",
                        equalTo: "Password Tidak Sama",
                    }
                },


            });

            // $.ajax({
            //     url: "{{ route('user.edit_password') }}",
            //     type: 'GET',
            //     success: function(response) {
            //         $('#resetpassword').modal('show');

            //         $('#form_reset_password').validate({
            //             rules:{
            //                 new_password:{
            //                     required :true,
            //                     minlength: 5,
            //                 },
            //                 konfirmasi_password:{
            //                     required :true,
            //                     minlength: 5,
            //                     equalTo: "#new_password"
            //                 }
            //             },
            //             messages: {
            //                 new_password: {
            //                     required: "Silahkan Isi Terlebih Dahulu",
            //                     minlength: "Minimal 5 Karakter",

            //                 },
            //                 konfirmasi_password: {
            //                     required: "Silahkan Isi Terlebih Dahulu",
            //                     minlength: "Minimal 5 Karakter",
            //                     equalTo: "Password Tidak Sama",
            //                 }
            //             },

            //             // submitHandler: function(form) {
            //             //     $.ajax({
            //             //         url: '/check-password',
            //             //         type: 'PUT',
            //             //         data: {
            //             //             new_password: $('#new_password').val(),
            //             //             konfirmasi_password: $('#konfirmasi_password').val(),
            //             //             username: $('#username').val(),

            //             //         },
            //             //         success: function(response) {
            //             //             swal({
            //             //                 title: "Password Diubah",
            //             //                 text: "Password Telah Berhasil Diubah",
            //             //                 icon: "success",
            //             //                 timer: 2e3,
            //             //                 buttons: false
            //             //             }).then((result) => {
            //             //                 location.reload();
            //             //             });
            //             //         }
            //             //     });
            //             // }
            //         });

            //     }
            // });
        });
    });
</script>
