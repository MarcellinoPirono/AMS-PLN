@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            @if (auth()->user()->role === 'Admin')
                <li class="breadcrumb-item"><a href="/user">{{ $active }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $active1 }}</a></li>
            @endif
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form name="edit_user" id="edit_user" action="#">
                            <input type="hidden" id="admin" name="admin" value="{{ auth()->user()->role }}">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-3">
                                    <div style="text-align: center" class="justify-content-center">
                                        <label style="text-align: center" class="text-label">Profile Picture:</label>
                                        <input type="file" class="filepond" name="pic_profile" id="pic_profile"
                                            data-max-file-size="2MB" accept="image/png, image/jpeg, image/gif" />

                                    </div>
                                </div>
                            </div>
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-6">
                                    <label class="text-label">Nama :</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="name" value="{{ old('name', $users->name) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Email :</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="email" value="{{ old('email', $users->email) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">No. HP :</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        placeholder="No. HP" value="{{ old('no_hp', $users->no_hp) }}"
                                        onkeypress="return onlyNumberKey(event)">
                                    <input type="hidden" class="form-control" id="old_pic_profile" name="old_pic_profile"
                                        value="{{ old('pic_profile', $users->pic_profile) }}">
                                </div>
                                @if (auth()->user()->role === 'Admin')
                                    @if ($users->role != 'Admin')
                                        <div class="form group justify-content-center col-6">
                                            <label class="text-label">Pilih Role User :</label>
                                            <select id="role" class="form-control filter-role">
                                                <option value="" disabled>Pilih Role</option>
                                                <option value="Manager" @if ($users->role == 'Manager') selected @endif>
                                                    Manager
                                                </option>
                                                <option value="Keuangan" @if ($users->role == 'Keuangan') selected @endif>
                                                    Keuangan
                                                </option>
                                                <option value="REN"
                                                    @if ($users->role == 'REN') selected @endif>REN
                                                </option>
                                                <option value="Supervisor" @if ($users->role == 'Supervisor') selected @endif>
                                                    Supervisor
                                                </option>
                                            </select>
                                        </div>
                                    @endif
                                @endif
                                <input type="hidden" id="role_user" value="{{ $users->role }}">
                                <div class="form-group col-md-6">
                                    <label class="text-label">Username</label>
                                    <div class="input-group">
                                        <input style="border-radius: 1.5rem" type="text" class="form-control"
                                            id="new_username" name="new_username" placeholder="Enter a username.."
                                            value="{{ old('new_username', $users->username) }}">
                                        <input type="hidden" id="old_username" name="old_username"
                                            value="{{ $old_username }}">
                                        {{-- <i style="padding-top: 3px;" class="fa-solid fa-user" ></i> --}}
                                    </div>
                                </div>
                                <!-- <div class="form-group col-md-6">
                                    <input type="hidden" id="username" name="username"
                                        value="{{ auth()->user()->username }}">
                                    <label for="recipient-name" class="col-form-label">Masukkan Password:</label>
                                    <div class="input-group transparent-append" style="border-radius: 1.5rem">
                                        <div class="input-group-append show-pass" style="border-radius: 1.5rem">
                                            <span class="input-group-text"
                                                style="border-top-left-radius: 1.5rem; border-bottom-left-radius: 1.5rem">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control" style="border-radius-right: 1.5rem"
                                            placeholder="Password Baru" id="new_password" name="new_password">
                                    </div>
                                </div> -->
                                <div class="col-md-12 d-flex justify-content-center">
                                    <a type="button" class="btn btn-danger mr-3"
                                        onclick="window.location.replace(document.referrer);">Back</a>
                                    <button type="submit" id="btntambah" class="btn btn-primary">Edit User</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src='https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js'></script>
    <script src='https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js'>
    </script>


    <script>
        jQuery(document).ready(function() {

            jQuery('.show-pass').on('click', function() {
                jQuery(this).toggleClass('active');
                if (jQuery('#password').attr('type') == 'password') {
                    jQuery('#password').attr('type', 'text');
                } else if (jQuery('#password').attr('type') == 'text') {
                    jQuery('#password').attr('type', 'password');
                }
            });
        });

        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>
    <script>
        $(document).ready(function() {
            FilePond.registerPlugin(
                FilePondPluginFileEncode,
                FilePondPluginFileValidateType,
                FilePondPluginImageExifOrientation,
                FilePondPluginImagePreview,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform,
                FilePondPluginImageEdit,
                FilePondPluginFileValidateSize,

            );

            let url = '{{ asset('/storage/' . $users->pic_profile . '') }}';
            let token = $('#csrf').val();
            let username = $('#username').val();

            const inputElement = document.querySelector('input[id="pic_profile"]');
            // const inputElement = document.querySelector('fieldset');
            // Create a FilePond instance

            FilePond.setOptions({
                server: {

                    load: (source, load, error, progress, abort, headers) => {

                        // now load it using XMLHttpRequest as a blob then load it.
                        let request = new XMLHttpRequest();
                        request.open('GET', source);
                        request.responseType = "blob";
                        request.onreadystatechange = () => request.readyState === 4 && load(request
                            .response);
                        request.send();
                    },
                }
            });
            const pond = FilePond.create(inputElement, {

                stylePanelLayout: 'compact circle',
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                imagePreviewHeight: 170,
                imageCropAspectRatio: '1:1',
                // imageResizeTargetWidth: 200,
                // imageResizeTargetHeight: 200,
                styleLoadIndicatorPosition: 'center bottom',
                styleRetryItemProcessingPosition: 'center center',
                styleProgressIndicatorPosition: 'center bottom',
                styleButtonRemoveItemPosition: 'center bottom',
                // imageCropAspectRatio: 1,

                acceptedFileTypes: ['image/png', 'image/jpeg'],
                files: [{
                    source: url,
                    options: {
                        type: 'local'

                    },
                }],
            });
            var old_username = document.getElementById('old_username').value;

            $('#edit_user').validate({
                rules: {
                    username: {
                        required: true,
                        remote: {
                            url: "/checkUsername_edit",
                            type: "post",
                            data: {
                                'old_username': old_username
                            }
                        }
                    },
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    role: {
                        required: true
                    },
                    no_hp: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    username: {
                        required: "Silakan Isi Username",
                        remote: "Username Sudah Ada"
                    },
                    name: {
                        required: "Silakan Isi Nama"
                    },
                    email: {
                        required: "Silakan Isi Email",
                        email: "Silakan Isi Email yang Valid"
                    },
                    role: {
                        required: "Silakan pilih Role"
                    },
                    no_hp: {
                        required: "Silakan Isi No. HP",
                        number: "Silakan Masukkan Nomor HP"
                    },
                },
                submitHandler: function(form) {
                    event.preventDefault();
                    var fd = new FormData();
                    // append files array into the form data
                    pondFiles = pond.getFiles();
                    for (var i = 0; i < pondFiles.length; i++) {
                        fd.append('file', pondFiles[i].file);
                    }
                    // console.log(fd);
                    var token = $('#csrf').val();
                    var username = $("#new_username").val();
                    var username_old = $("#old_username").val();

                    var name = $("#name").val();
                    var email = $("#email").val();
                    var no_hp = $("#no_hp").val();
                    var role = $("#role").val();
                    var role_lama = $("#role_user").val();
                    var old_pic_profile = $("#old_pic_profile").val();

                    fd.append("_token", token);
                    fd.append("username", username);
                    fd.append("username_old", username_old);

                    fd.append("name", name);
                    fd.append("email", email);
                    fd.append("no_hp", no_hp);
                    if (role_lama == "Admin") {
                        fd.append("role", role_lama);
                    } else {
                        if (document.getElementById("admin").value == "Admin") {
                            fd.append("role", role);
                        } else {
                            fd.append("role", role_lama);
                        }
                    }
                    fd.append("old_pic_profile", old_pic_profile);
                    // var pic_profile = pond.files;

                    // console.log(fd);

                    if (document.getElementById("admin").value == "Admin") {
                        if (role_lama == "Admin") {
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('user.update') }}",
                                data: fd,
                                contentType: false,
                                processData: false,
                                dataType: 'json',

                                success: function(response) {
                                    swal({
                                            title: "Data User Diedit ",
                                            text: "Telah Berhasil Diedit",
                                            icon: "success",
                                            timer: 2e3,
                                            buttons: false
                                        })
                                        .then((result) => {
                                            window.location.replace(document.referrer);
                                        });
                                }
                            });
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('user.update') }}",
                                data: fd,
                                contentType: false,
                                processData: false,
                                dataType: 'json',

                                success: function(response) {
                                    swal({
                                            title: "Data User Diedit ",
                                            text: "Telah Berhasil Diedit",
                                            icon: "success",
                                            timer: 2e3,
                                            buttons: false
                                        })
                                        .then((result) => {
                                            window.location.href = "/user";
                                        });
                                }
                            });
                        }
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('user.update') }}",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',

                            success: function(response) {
                                swal({
                                        title: "Data User Diedit ",
                                        text: "Telah Berhasil Diedit",
                                        icon: "success",
                                        timer: 2e3,
                                        buttons: false
                                    })
                                    .then((result) => {
                                        window.location.replace(document.referrer);
                                    });
                            }
                        });

                    }

                }
            });

        });
    </script>
@endsection
