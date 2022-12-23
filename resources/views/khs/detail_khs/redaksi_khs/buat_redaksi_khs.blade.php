@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/vendor-khs">{{$active}}</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$active1}}</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form {{ $active }}</h4>
            </div>

            <div class="m-auto" style="width:97%;">
                <div class="tab-content mt-3 tab-flex">

                </div>
                <div id="informasi_umum" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                    <form id="valid_redaksi" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="row m-auto">
                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label for="first-name" class="form-label">Input Nama Redaksi</label>
                                    <input type="text" class="form-control" id="nama_redaksi" name="nama_redaksi"
                                        value="{{ old('nama_redaksi') }}" placeholder="Nama Redaksi" required autofocus>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label class="text-label">Input Deskripsi Redaksi</label>
                                    <textarea type="text"
                                        class="form-control"
                                        name="deskripsi_redaksi" id="deskripsi_redaksi"
                                        placeholder="Deskripsi Redaksi" required autofocus
                                        value="{{ old('deskripsi_redaksi') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="text-label">Input Sub Deskripsi (Optional)</label>
                            </div>
                        </div>
                        <table class="table table-responsive-sm height-100" width="100%"
                            id="tabel_sub_deskripsi">
                            <!-- <tr align="center" valign="middle" class="">
                                <th style="width:5%;" align="center" valign="middle">No.</th>
                                <th align="center" valign="middle">Sub Deskripsi</th>
                                <th style="width:10%;" align="center" valign="middle">Aksi</th>
                            </tr>
                            <tr>
                                <td><strong id="nomor">1</strong></td>
                                <td>
                                    <textarea type="text" class="form-control lokasi" id="sub_deskripsi_id[1]" name="sub_deskripsi_id" placeholder="Sub Deskripsi" required>{{ old('sub_deskripsi_id') }}</textarea>
                                </td>
                                <td><button onclick="deleteRow2(this)"
                                        class="btn btn-danger shadow btn-xs sharp"><i
                                            class='fa fa-trash'></i></button></td>
                            </tr> -->
                        </table>
                        <div class="col-lg-12 mb-2">
                            <div class="position-relative justify-content-center float-center">
                                <a type="button" id="tambah-pekerjaan"
                                    class="btn btn-primary position-relative justify-content-end"
                                    onclick="updatelokasi()" required>Tambah</a>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-2">
                            <div class="position-relative float-right" style="float: right !important">
                                <button type="submit" id="btntambah"
                                    class="btn btn-primary position-relative justify-content-end">Tambah Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>

<script>
    var clicksubdeskripsi = 0;

function updatelokasi() {
    var tabel_sub_deskripsi = document.getElementById('tabel_sub_deskripsi');
    clicksubdeskripsi++;

    var input1 = document.createElement("textarea");
    input1.setAttribute("type", "text");
    input1.setAttribute("class", "form-control pekerjaan");
    input1.setAttribute("id", "sub_deskripsi_id[" + clicksubdeskripsi + "]");
    input1.setAttribute("name", "sub_deskripsi_id["+ clicksubdeskripsi +"]");
    input1.setAttribute("placeholder", "Sub Deskripsi");
    input1.setAttribute("required", true);
    input1.setAttribute("data-rule-required", true);

    var button = document.createElement("button");
    button.innerHTML = "<i class='fa fa-trash'></i>";
    button.setAttribute("onclick", "deleteRow2(this)");
    button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");

    var row = tabel_sub_deskripsi.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    cell1.innerHTML = "1";
    cell2.appendChild(input1);
    cell3.appendChild(button);

    reindex2();
// alert("HALOOOO");
}

// function deleteRow2(r) {
//     var table = r.parentNode.parentNode.rowIndex;
//     document.getElementById("tabel_sub_deskripsi").deleteRow(table);
//     clicksubdeskripsi--;

//     var select_id_sub_deskripsi = document.querySelectorAll("#tabel_sub_deskripsi tr td:nth-child(2) textarea");
//     for (var i = 0; i < select_id_sub_deskripsi.length; i++) {
//         select_id_sub_deskripsi[i].id = "sub_deskripsi_id[" + (i + 1) + "]";
// }

// reindex2();

function deleteRow2(r) {
    var table = r.parentNode.parentNode.rowIndex;
    document.getElementById("tabel_sub_deskripsi").deleteRow(table);
    clicksubdeskripsi--;

    var select_id_sub_deskripsi = document.querySelectorAll("#tabel_sub_deskripsi tr td:nth-child(2) textarea");
    for (var i = 0; i < select_id_sub_deskripsi.length; i++) {
        select_id_sub_deskripsi[i].id = "sub_deskripsi_id[" + (i + 1) + "]";

    reindex2();

    // if (clickpaket == 0) {
    //     updatePaket();
    // }

}

// if (clicksubdeskripsi == 0) {
//     updatelokasi();
// }
}

function reindex2() {
    const ids = document.querySelectorAll("#tabel_sub_deskripsi tr > td:nth-child(1)");
    ids.forEach((e, i) => {
        e.innerHTML = "<strong id=nomor1[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
        nomor_tabel_sub_deskripsi = i + 1;
    });
}

    $(document).ready(function() {

        $('#valid_redaksi').validate({
            rules:{
                nama_redaksi:{
                    required: true
                },
                deskripsi_redaksi:{
                    required:true
                },
                'sub_deskripsi_id[]':{
                    required:true
                },
            },
            messages:{
                nama_redaksi:{
                    required: "Silakan Isi Nama Redaksi"
                },
                deskripsi_redaksi:{
                    required: "Silakan Isi Deskripsi Redaksi"
                },
                'sub_deskripsi_id[]':{
                    required: "Silakan Isi Atau Hapus Sub Deskripsi"
                }
            },
            submitHandler: function(form) {
                    var token = $('#csrf').val();
                    var nama_redaksi = $("#nama_redaksi").val();
                    var deskripsi_redaksi = $("#deskripsi_redaksi").val();

                    var sub_deskripsi = [];

                    for (var i = 0; i < clicksubdeskripsi; i++) {
                        sub_deskripsi[i] = [document.getElementById('sub_deskripsi_id[' + (i + 1) + ']').value];
                    }


                    var data = {
                        "_token": token,
                        "nama_redaksi": nama_redaksi,
                        "deskripsi_redaksi": deskripsi_redaksi,
                        "sub_deskripsi": sub_deskripsi,
                        "clicksubdeskripsi": clicksubdeskripsi
                    };

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('redaksi-khs') }}",
                        data: data,

                        success: function(response) {

                            swal({
                                    title: "Data Ditambah",
                                    text: "Data Berhasil Ditambah",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                })
                                .then((result) => {
                                    window.location.href = "/redaksi-khs";
                                });
                        }
                    });
                }
        });
    });
</script>
