<div class="header">
    @csrf
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <!-- <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" href="/login">Logout</button>
                    </form> -->
                    <div class="dashboard_bar">
                        {{ $title }}
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    @auth
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                @if (auth()->user()->pic_profile != null)
                                <img width="20" height="20" src="{{ asset('/storage/'.auth()->user()->pic_profile.'') }}" alt="">

                                @else
                                <img width="20" height="20" src="{{ asset('/storage/storage/Image-profile/avatar.svg') }}" alt="">
                                @endif
                            <div class="header-info">
                                <span class="text-white"><strong>{{ auth()->user()->username }}</strong></span>
                                <p style="font-weight: bold" class="text-warning fs-12 mb-0">{{ auth()->user()->role }}</p>
                            </div>


                        </a>
                        <input type="hidden" id="username" name="username" value="{{ auth()->user()->username }}">
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/" class="dropdown-item ai-icon btnprofile" >
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                    width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ml-2">Profile </span>
                            </button>
                            <button class="dropdown-item ai-icon btnpass" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" class="text-success"
                                    height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                    <path
                                        d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                                <span class="ml-2">Ubah Password </span>
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


<script>
    $(document).ready(function() {
        var username = $('#username').val();
        $('.btnprofile').click(function(e) {
                $.ajax({
                    url:  "{{ route('user.edit_profile') }}",
                    type: 'GET',
                    data: {
                        username: username
                    },
                    success:function (response){
                        console.log(response);

                    }

                });
            });

        $('.btnpass').click(function(e) {
                $.ajax({
                    url: 'edit-password/' + username,
                    type: 'GET',
                    success: function(response) {
                        $('#category_form').modal('show');

                        $('#edit_valid_khs').validate({
                            rules: {
                                edit_jenis_khs: {
                                    required: true,
                                    remote: {
                                        url: "/checkJenisKhs/edit",
                                        type: "post"
                                    }
                                },
                                edit_nama_pekerjaan: {
                                    required: true
                                }
                            },
                            messages: {
                                edit_jenis_khs: {
                                    required: "Silakan Isi Jenis KHS",
                                    remote: "Jenis KHS Sudah Ada"
                                },
                                edit_nama_pekerjaan: {
                                    required: "Silakan Isi Nama Pekerjaan"
                                }
                            },

                            // console.log();
                            submitHandler: function(form) {
                                $.ajax({
                                    url: 'jenis-khs/' + id,
                                    type: 'PUT',
                                    data: {
                                        jenis_khs: $('#edit_jenis_khs')
                                            .val(),
                                        nama_pekerjaan: $(
                                                '#edit_nama_pekerjaan')
                                            .val(),

                                    },
                                    success: function(response) {
                                        swal({
                                            title: "Data Diedit",
                                            text: "Data Berhasil Diedit",
                                            icon: "success",
                                            timer: 2e3,
                                            buttons: false
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    }
                                })
                            }
                        });

                    }
                });
            });
    });
</script>
