@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/user">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $active1 }}</a></li>
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
                        <form name="valid_user" id="valid_user" action="#">
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
                                        placeholder="Nama">

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Email :</label>

                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">No. HP :</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                                        placeholder="No. HP" onkeypress="return onlyNumberKey(event)">
                                </div>
                                <div class="form group justify-content-center col-6">
                                    <label class="text-label">Pilih Role User :</label>
                                    <select id="role" name="role" class="form-control filter-role">
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="Manager">Manager
                                        </option>
                                        <option value="Keuangan">Keuangan
                                        </option>
                                        <option value="REN">REN
                                        </option>
                                        <option value="Supervisor">Supervisor
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" id="new_username" name="new_username"
                                            placeholder="Silahkan masukkan username...">
                                    </div>
                                    <!-- <label class="text-label">Username</label>
                                                            <div class="input-group">
                                                                {{-- <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                        </div> --}}
                                                                <input style="border-radius: 1.5rem" type="text" class="form-control"
                                                                    id="username" name="username" placeholder="Enter a Username..">
                                                                <i style="padding-top: 3px;" class="fa-solid fa-user"></i>
                                                            </div> -->
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Password</label>
                                    <div class="input-group transparent-append" style="border-radius: 1.5rem">
                                        <div class="input-group-append show-pass" style="border-radius: 1.5rem">
                                            <span class="input-group-text" style="border-top-left-radius: 1.5rem; border-bottom-left-radius: 1.5rem">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                        <input style="border-radius-right: 1.5rem" type="password" class="form-control" id="password"
                                            name="password" placeholder="Silahkan Masukkan Password... ">
                                    </div>

                                    <!-- <label class="text-label">Password *</label>
                                                                {{-- <div class="input-group transparent-append">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Choose a safe one..">
                                        <div class="input-group-append show-pass ">
                                            <span class="input-group-text ">
                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                        </div>
                                    </div> --}} -->
                                    <!-- <div class="input-group">

                                                                    <input style="border-radius: 1.5rem" type="password" class="form-control"
                                                                        placeholder="Password..." id="password" name="password">
                                                                    <div class="input-group-append show-pass ">
                                                                        <span class="input-group-text ">
                                                                            <i class="fa fa-eye-slash"></i>
                                                                            <i class="fa fa-eye"></i>
                                                                        </span>
                                                                    </div>
                                                                </div> -->

                                </div>


                                <div class="justify-content-end mt-5">
                                    <button type="submit" id="btntambah"
                                        class="btn btn-primary position-relative justify-content-end">Buat User</button>
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
    <script src='https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js'>
    </script>

    <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
    <script src='https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js'></script>


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
    </script>

    <script>
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


            const inputElement = document.querySelector('input[id="pic_profile"]');
            // const inputElement = document.querySelector('fieldset');
            // Create a FilePond instance
            const pond = FilePond.create(inputElement, {

                stylePanelLayout: 'compact circle',
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span><span class="merah"> (Max. 2MB)</spam>`,
                imagePreviewHeight: 170,
                imageCropAspectRatio: '1:1',
                // imageResizeTargetWidth: 200,
                // imageResizeTargetHeight: 200,
                styleLoadIndicatorPosition: 'center bottom',
                styleRetryItemProcessingPosition: 'center center',
                styleProgressIndicatorPosition: 'center bottom',
                styleButtonRemoveItemPosition: 'center bottom',
                imageCropAspectRatio: 1,



            });

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

            $('#valid_user').validate({
                rules: {
                    username: {
                        required: true,
                        remote: {
                            url: "/checkUsername",
                            type: "post"
                        }
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        uppercaseCheck: true,
                        nomorCheck: true,
                        spesialcharCheck: true,
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
                    password: {
                        required: "Silakan Isi Password",
                        minlength: "Minimal 5 Karakter"
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
                    var token = $('#csrf').val();
                    var new_username = $("#new_username").val();
                    // console.log(new_username);
                    var password = $("#password").val();
                    var name = $("#name").val();
                    var email = $("#email").val();
                    var no_hp = $("#no_hp").val();
                    var role = $("#role").val();
                    fd.append("_token", token);
                    fd.append("new_username", new_username);
                    fd.append("password", password);
                    fd.append("name", name);
                    fd.append("email", email);
                    fd.append("no_hp", no_hp);
                    fd.append("role", role);
                    // var pic_profile = pond.files;

                    // console.log(fd);


                    $.ajax({
                        type: 'POST',
                        url: "/user",
                        data: fd,
                        contentType: false,
                        processData: false,
                        dataType: 'json',

                        success: function(response) {

                            swal({
                                    title: "Data Telah Ditambah",
                                    text: "User Berhasil Ditambah",
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
            });

        });
    </script>
@endsection
