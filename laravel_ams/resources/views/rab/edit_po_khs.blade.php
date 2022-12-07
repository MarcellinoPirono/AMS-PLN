@extends('layouts.main')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/po-khs">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a  href=""> {{ $active1 }}</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-dua">
                    <div class="card-header">
                        <h4 class="card-title">Edit Form step {{ $active }}</h4>
                    </div>
                    <div class="m-auto" style="width:97%;">
                        <div id="smartwizard" dir="rtl-" class="mt-4">
                            <ul class="nav nav-progress">
                                <li class="nav-item">
                                    <a class="nav-link default done non-active" href="#daftar_rab">
                                        <div class="num">1</div>
                                        Informasi Umum
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link default active" href="#daftar_rab">
                                        <span class="num">2</span>
                                        Daftar RAB
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#redaksi">
                                        <span class="num">3</span>
                                        Redaksi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#isi_kontrak">
                                        <span class="num">4</span>
                                        Review PO-KHS
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content mt-3 tab-flex">
                                <div id="daftar_rab" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Daftar RAB</h4>
                                                    </div>
                                                    <div class="card-header justify-content-start">
                                                        <h5 id="pagu_prk" class="card-title" style="font-size: 14px;"></h5>
                                                    </div>
                                                    <div class="row ml-2">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelRAB">
                                                                <thead>
                                                                    <tr align="center" valign="middle" class="">
                                                                        <th align="center" valign="middle">No.</th>
                                                                        <th align="center" valign="middle">Pekerjaan</th>
                                                                        <th align="center" valign="middle">Kategori
                                                                            Pekerjaan</th>
                                                                        <th align="center" valign="middle">Satuan</th>
                                                                        <th align="center" valign="middle">Volume</th>
                                                                        <th align="center" valign="middle">Harga Satuan
                                                                        </th>
                                                                        <th align="center" valign="middle">Jumlah</th>
                                                                        <th align="center" valign="middle">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-kategori">
                                                                    <tr>
                                                                        <td><strong id="nomor"
                                                                                value="1">1</strong></td>
                                                                        <td><select name="item_id" id="item_id[1]"
                                                                                class="form-control input-default"
                                                                                onchange="change_item(this)" required>
                                                                                <option value="" selected disabled
                                                                                    required>Pilih Pekerjaan</option>
                                                                            </select></td>
                                                                        <td><input type="text"
                                                                                class="form-control kategory_id"
                                                                                id="kategory_id[1]" name="kategory_id"
                                                                                placeholder="Kategori" value=""
                                                                                disabled readonly required></td>
                                                                        <td><input type="text"
                                                                                class="form-control satuan" id="satuan[1]"
                                                                                name="satuan" placeholder="Satuan"
                                                                                value="" disabled readonly required>
                                                                        </td>
                                                                        <td><input type="text"
                                                                                class="form-control volume" id="volume[1]"
                                                                                name="volume" placeholder="volume"
                                                                                value="" onblur="blur_volume(this)"
                                                                                onkeydown="return numbersonly(this, event);"
                                                                                onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                required></td>
                                                                        <td><input type="text"
                                                                                class="form-control harga_satuan"
                                                                                id="harga_satuan[1]" name="harga_satuan"
                                                                                placeholder="Harga Satuan" value=""
                                                                                disabled readonly required></td>
                                                                        <td><input type="text"
                                                                                class="form-control harga" id="harga[1]"
                                                                                name="harga" placeholder="Jumlah"
                                                                                value="" disabled readonly required>
                                                                        </td>
                                                                        <td><button onclick="deleteRow(this)"
                                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                                    class='fa fa-trash'></i></button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="col-lg-12 mb-2">
                                                                <div
                                                                    class="position-relative justify-content-end float-left">
                                                                    <a type="button" id="tambah-pekerjaan"
                                                                        class="btn btn-primary position-relative justify-content-end"
                                                                        onclick="updateform()" required>Tambah</a>
                                                                </div>
                                                            </div>
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelRAB1">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th style="width: 204.73px">Jumlah:</th>
                                                                        <th style="width: 204.73px" id="jumlah"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th style="width: 204.73px">PPN 11%:</th>
                                                                        <th style="width: 204.73px" id="pajak"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th style="width: 204.73px">Total Harga:</th>
                                                                        <th style="width: 204.73px" id="total"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="redaksi" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <form id="form-3" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Redaksi</h4>
                                                    </div>
                                                    <div class="row ml-2">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelRedaksi">
                                                                <thead>
                                                                    <tr align="center" valign="middle" class="">
                                                                        <th>No.</th>
                                                                        <th>Redaksi</th>
                                                                        <th>Deskripsi</th>

                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-redaksi">
                                                                    <tr align="center" valign="middle">
                                                                        <td><strong id="nomor1"
                                                                                value="1">1</strong></td>
                                                                        <td><select name="redaksi_id" id="redaksi_id[1]"
                                                                                class="form-control input-default"
                                                                                onchange="change_redaksi(this)" required>
                                                                                <option value="" selected disabled
                                                                                    required>Pilih Redaksi</option>
                                                                                @foreach ($redaksis as $redaksi)
                                                                                    <option value="{{ $redaksi->id }}">
                                                                                        {{ $redaksi->nama_redaksi }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select></td>
                                                                        <td>
                                                                            <textarea type="text" class="form-control deskripsi_id" id="deskripsi_id[1]" name="deskripsi_id"
                                                                                placeholder="Deskripsi" value="" disabled required></textarea>
                                                                        </td>

                                                                        <td><button onclick="deleteRow1(this)"
                                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                                    class='fa fa-trash'></i></button></td>
                                                                    </tr>
                                                                </tbody>

                                                            </table>
                                                            <div class="col-lg-12 mb-2">
                                                                <div
                                                                    class="position-relative justify-content-end float-left">
                                                                    <a type="button" id="tambah-pekerjaan"
                                                                        class="btn btn-primary position-relative justify-content-end"
                                                                        onclick="updateRedaksi()">Tambah</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="isi_kontrak" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                    <form id="form-4" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Review Hasil Isi Kontrak</h4>
                                                    </div>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 1: Informasi Umum</h5>
                                                        <table class="uprightTbl noborder" style="width:100%;"
                                                            id="rincian" cellspacing="3" cellpadding="3">
                                                            <tr class="noborder">
                                                                <td style="width:20%;">No. Purchase Order
                                                                </td>
                                                                <td style="width:1%">:</td>
                                                                <td style="width:84%" id="po_4">
                                                                </td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. Kontrak Induk</td>
                                                                <td>:</td>
                                                                <td id="kontrak_induk_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Judul Pekerjaan</td>
                                                                <td>:</td>
                                                                <td id="judul_pekerjaan_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Lokasi</td>
                                                                <td>:</td>
                                                                <td id="lokasi_4">
                                                                </td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Start Date</td>
                                                                <td>:</td>
                                                                <td id="start_date_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>End Date</td>
                                                                <td>:</td>
                                                                <td id="end_date_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. Addendum</td>
                                                                <td>:</td>
                                                                <td id="addendum_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. SKK</td>
                                                                <td>:</td>
                                                                <td id="no_skk_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. PRK</td>
                                                                <td>:</td>
                                                                <td id="no_prk_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Direksi Pekerjaan</td>
                                                                <td>:</td>
                                                                <td id="direksi_pekerjaan_4"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>Pengawas Pekerjaan</td>
                                                                <td>:</td>
                                                                <td id="pengawas_pekerjaan_4"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 2: Daftar RAB</h5>
                                                        <div class="col-xl-12 col-xxl-12">
                                                            <div class="table-responsive">
                                                                <div class="wrapword" id="firstTable">
                                                                    <table id="daftar_rabs" class="" width="100%"
                                                                        border="2" cellspacing="0" cellpadding="0"
                                                                        style="font-size: 12px;">
                                                                        <thead>
                                                                            <tr class="warna">
                                                                                <td style="width:4%;" rowspan="3"
                                                                                    align="center" valign="middle">No</td>
                                                                                <td rowspan="3" align="center"
                                                                                    valign="middle">Uraian Pekerjaan</td>
                                                                                <td style="width:11%;" rowspan="3"
                                                                                    align="center" valign="middle">Satuan
                                                                                </td>
                                                                                <td style="width:9%;" rowspan="3"
                                                                                    align="center" valign="middle">Volume
                                                                                </td>
                                                                                <td style="width:25%;" colspan="2"
                                                                                    align="center" valign="middle">Harga
                                                                                </td>
                                                                            </tr>

                                                                            <tr class="warna first4">
                                                                                <td style="width:11%;" align="center"
                                                                                    valign="middle">Satuan</td>
                                                                                <td style="width:11%;" align="center"
                                                                                    valign="middle">Jumlah</td>
                                                                            </tr>
                                                                            <tr class="warna first3">
                                                                                <td align="center" valign="middle">(RP)
                                                                                </td>
                                                                                <td align="center" valign="middle">(RP)
                                                                                </td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbody_jasa">
                                                                        </tbody>
                                                                        <tbody id="tbody_material">
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td rowspan="3" colspan="3"></td>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>Jumlah</b></td>
                                                                                <td id="td_jumlah"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>PPN 11%</b></td>
                                                                                <td id="td_ppn"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>TOTAL</b></td>
                                                                                <td id="td_total"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="first1"></td>
                                                                                <td class="first2" rowspan="2"
                                                                                    colspan="5" id="terbilang"
                                                                                    style="font-weight: bold; font-style:italic;">
                                                                                </td>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 3: Redaksi</h5>
                                                        <div class="col-xl-12 col-xxl-12">
                                                            <div class="wrapword" id="firstTable">
                                                                <table width="100%" border="2" cellspacing="0"
                                                                    cellpadding="1" style="font-size: 12px;">
                                                                    <thead align="center" valign="middle">
                                                                        <tr class="warna">
                                                                            <th style="width:4%;" align="center"
                                                                                valign="middle">No</th>
                                                                            <th style="width:25%;" align="center"
                                                                                valign="middle">Redaksi</th>
                                                                            <th align="center" valign="middle">Deskripsi
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody_redaksi">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Order Placed</h5>
                    <button type="button" class="btn-close" style="border: none; background-color: #fff;"
                        data-bs-dismiss="modal" aria-label="Close"> &#10006; </button>
                </div>
                <div class="modal-body">
                    Congratulations! Your order is placed.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeModal()">Ok, close and
                        reset</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- Bootrap for the demo page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- jQuery Slim 3.6  -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script> -->

    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/jquery.smartWizard.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/wizard.js"></script>

    <script type="text/javascript">
        const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));

        function onCancel() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");

            // Reset form
            // document.getElementById("form-1").reset();
            document.getElementById("form-2").reset();
            document.getElementById("form-3").reset();
            document.getElementById("form-4").reset();
        }

        function onConfirm() {
            let form = document.getElementById('form-4');
            if (form) {
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    $('#smartwizard').smartWizard("setState", [3], 'error');
                    $("#smartwizard").smartWizard('fixHeight');
                    return false;
                }

                $('#smartwizard').smartWizard("unsetState", [3], 'error');
                myModal.show();
            }
        }

        function closeModal() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");

            // Reset form
            // document.getElementById("form-1").reset();
            document.getElementById("form-2").reset();
            document.getElementById("form-3").reset();
            document.getElementById("form-4").reset();

            myModal.hide();
        }

        function showConfirm() {
            const name = $('#lokasi').val() + ' ' + $('#lokasi').val();
            const products = $('#lokasi').val();
            const shipping = $('#lokasi').val() + ' ' + $('#lokasi').val() + ' ' + $('#lokasi').val();
            let html = `
                  <div class="row">
                    <div class="col">
                      <h4 class="mb-3-">Customer Details</h4>
                      <hr class="my-2">
                      <div class="row g-3 align-items-center">
                        <div class="col-auto">
                          <label class="col-form-label">Name</label>
                        </div>
                        <div class="col-auto">
                          <span class="form-text-">${name}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col">
                      <h4 class="mt-3-">Shipping</h4>
                      <hr class="my-2">
                      <div class="row g-3 align-items-center">
                        <div class="col-auto">
                          <span class="form-text-">${shipping}</span>
                        </div>
                      </div>
                    </div>
                  </div>


                  <h4 class="mt-3">Products</h4>
                  <hr class="my-2">
                  <div class="row g-3 align-items-center">
                    <div class="col-auto">
                      <span class="form-text-">${products}</span>
                    </div>
                  </div>

                  `;
            $("#order-details").html(html);
            $('#smartwizard').smartWizard("fixHeight");
        }

        $(function() {
            // Leave step event is used for validating the forms
            $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIdx, nextStepIdx,
                stepDirection) {
                // Validate only on forward movement
                $('#start_date').removeAttr('readonly');
                $('#end_date').removeAttr('readonly');

                if (stepDirection == 'forward') {
                    let form = document.getElementById('form-' + (currentStepIdx + 1));
                    if (form) {
                        if (!form.checkValidity()) {
                            form.classList.add('was-validated');
                            $('#smartwizard').smartWizard("setState", [currentStepIdx], 'error');
                            $("#smartwizard").smartWizard('fixHeight');
                            return false;
                        }
                        $('#smartwizard').smartWizard("unsetState", [currentStepIdx], 'error');
                    }
                }
            });

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
                if (stepPosition === 'first') {
                    $("#prev-btn").addClass('disabled').prop('disabled', true);
                } else if (stepPosition === 'last') {
                    var po = $("#po").val();
                    var kontrak_induk = $("#kontrak_induk option:selected").text();
                    var pekerjaan = $("#pekerjaan").val();
                    var lokasi = $("#lokasi").val();
                    var start_date = $("#start_date").val();
                    var end_date = $("#end_date").val();
                    var addendum = $("#addendum").val();
                    var skk_id = $("#skk_id option:selected").text();
                    var prk_id = $("#prk_id option:selected").text();
                    var pejabat = $("#pejabat option:selected").text();
                    var pengawas = $("#pengawas").val();

                    $("#po_4").html(po);
                    $("#kontrak_induk_4").html(kontrak_induk);
                    $("#judul_pekerjaan_4").html(pekerjaan);
                    $("#lokasi_4").html(lokasi);
                    $("#start_date_4").html(start_date);
                    $("#end_date_4").html(end_date);
                    if (addendum == "") {
                        $("#addendum_4").html("-");
                    } else {
                        $("#addendum_4").html(addendum);
                    }
                    $("#no_skk_4").html(skk_id);
                    $("#no_prk_4").html(prk_id);
                    $("#direksi_pekerjaan_4").html(pejabat);
                    $("#pengawas_pekerjaan_4").html(pengawas);

                    baris = [];
                    baris_jasa = [];
                    baris_material = [];

                    var html_material = [""];

                    for (var i = 0; i < click; i++) {
                        baris[i] = [
                            document.getElementById("item_id[" + (i + 1) + "]").options[document
                                .getElementById("item_id[" + (i + 1) + "]").selectedIndex].text,
                            document.getElementById("kategory_id[" + (i + 1) + "]").value,
                            document.getElementById("satuan[" + (i + 1) + "]").value,
                            document.getElementById("volume[" + (i + 1) + "]").value,
                            document.getElementById("harga_satuan[" + (i + 1) + "]").value,
                            document.getElementById("harga[" + (i + 1) + "]").value
                        ]

                        if (baris[i][1] == "Jasa") {
                            baris_jasa[i] = [baris[i]];
                        } else {
                            baris_material[i] = [baris[i]];
                        }
                    }

                    const result_jasa = baris_jasa.filter(element => {
                        return element !== null;
                    });
                    const result_material = baris_material.filter(element => {
                        return element !== null;
                    });

                    if (result_jasa.length > 0) {
                        var html_jasa = [""]
                        var tbody = document.getElementById("tbody_jasa")
                        var panjang = result_jasa.length
                        for (var j = 0; j < panjang; j++) {
                            html_jasa += ("<tr> <td class='first' align='center' valign='middle'>" + (j +
                                1) + "</td> <td class='first' align='left' valign='middle'>" +
                                result_jasa[j][0][0] +
                                "</td> <td class='first' align='center' valign='middle'>" + result_jasa[
                                    j][0][2].match(/\(([^)]+)\)/)[1] +
                                "</td> <td class='first' align='center' valign='middle'>" + result_jasa[
                                    j][0][3] +
                                "</td> <td class='first' align='right' valign='middle'>" + result_jasa[
                                    j][0][4] +
                                "</td> <td class='first' align='right' valign='middle'>" + result_jasa[
                                    j][0][5] + "</td> </tr>")
                        }
                        document.getElementById("tbody_jasa").innerHTML =
                            "<tr> <td class='first' align='center' valign='middle'> </td> <td class='first' align='left' valign='middle' style='font-weight: bold'>JASA:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> </tr>" +
                            html_jasa;
                    }

                    if (result_material.length > 0) {
                        var html_material = [""]
                        var tbody = document.getElementById("tbody_material")
                        var panjang = result_material.length
                        for (var j = 0; j < panjang; j++) {
                            html_material += ("<tr> <td class='first' align='center' valign='middle'>" + (
                                    j + 1) + "</td> <td class='first' align='left' valign='middle'>" +
                                result_material[j][0][0] +
                                "</td> <td class='first' align='center' valign='middle'>" +
                                result_material[j][0][2] +
                                "</td> <td class='first' align='center' valign='middle'>" +
                                result_material[j][0][3] +
                                "</td> <td class='first' align='right' valign='middle'>" +
                                result_material[j][0][4] +
                                "</td> <td class='first' align='right' valign='middle'>" +
                                result_material[j][0][5] + "</td> </tr>")
                        }
                        document.getElementById("tbody_material").innerHTML =
                            "<tr> <td class='first' align='center' valign='middle'> </td> <td class='first' align='left' valign='middle' style='font-weight: bold'>MATERIAL:</td> <td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> </tr>" +
                            html_material;
                    }

                    document.getElementById("td_jumlah").innerHTML = document.getElementById("jumlah")
                        .innerHTML;
                    document.getElementById("td_ppn").innerHTML = document.getElementById("pajak")
                    .innerHTML;
                    document.getElementById("td_total").innerHTML = document.getElementById("total")
                        .innerHTML;

                    function terbilang(angka) {
                        var bilne = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan",
                            "Sembilan", "Sepuluh", "Sebelas"
                        ];

                        if (angka < 12) {
                            return bilne[angka];
                        } else if (angka < 20) {
                            return terbilang(angka - 10) + " Belas";
                        } else if (angka < 100) {
                            return terbilang(Math.floor(parseInt(angka) / 10)) + " Puluh " + terbilang(
                                parseInt(angka) % 10);
                        } else if (angka < 200) {
                            return "Seratus " + terbilang(parseInt(angka) - 100);
                        } else if (angka < 1000) {
                            return terbilang(Math.floor(parseInt(angka) / 100)) + " Ratus " + terbilang(
                                parseInt(angka) % 100);
                        } else if (angka < 2000) {
                            return "Seribu " + terbilang(parseInt(angka) - 1000);
                        } else if (angka < 1000000) {
                            return terbilang(Math.floor(parseInt(angka) / 1000)) + " Ribu " + terbilang(
                                parseInt(angka) % 1000);
                        } else if (angka < 1000000000) {
                            return terbilang(Math.floor(parseInt(angka) / 1000000)) + " Juta " + terbilang(
                                parseInt(angka) % 1000000);
                        } else if (angka < 1000000000000) {
                            return terbilang(Math.floor(parseInt(angka) / 1000000000)) + " Milyar " +
                                terbilang(parseInt(angka) % 1000000000);
                        } else if (angka < 1000000000000000) {
                            return terbilang(Math.floor(parseInt(angka) / 1000000000000)) + " Trilyun " +
                                terbilang(parseInt(angka) % 1000000000000);
                        }
                    }

                    var terbilang1 = document.getElementById("td_total").innerHTML;
                    terbilang1 = terbilang1.replace(/\Rp. /g, "");
                    terbilang1 = terbilang1.replace(/\./g, "");
                    terbilang1 = parseInt(terbilang1);
                    document.getElementById("terbilang").innerHTML = "Terbilang: " + terbilang(terbilang1) +
                        " Rupiah";

                    redaksi_line = [];

                    for (var i = 0; i < clickredaksi; i++) {

                        redaksi_line[i] = [
                            document.getElementById("redaksi_id[" + (i + 1) + "]").options[document
                                .getElementById("redaksi_id[" + (i + 1) + "]").selectedIndex].text,
                            document.getElementById("deskripsi_id[" + (i + 1) + "]").value
                        ]

                    }

                    if (redaksi_line.length > 0) {
                        var html_redaksi = [""];
                        var isi_redaksi = redaksi_line.length;
                        for (var j = 0; j < isi_redaksi; j++) {
                            html_redaksi += ("<tr> <td class='first' align='center' valign='middle'>" + (j +
                                    1) + "</td> <td class='first' align='left' valign='middle'>" +
                                redaksi_line[j][0] +
                                "</td> <td class='first' align='left' valign='middle'>" + redaksi_line[
                                    j][1] + "</td> </tr>")
                        }
                        document.getElementById("tbody_redaksi").innerHTML = html_redaksi;
                    }
                    $("#next-btn").addClass('disabled').prop('disabled', true);
                } else {
                    $("#prev-btn").removeClass('disabled').prop('disabled', false);
                    $("#next-btn").removeClass('disabled').prop('disabled', false);
                }

                // Get step info from Smart Wizard
                let stepInfo = $('#smartwizard').smartWizard("getStepInfo");
                $("#sw-current-step").text(stepInfo.currentStep + 1);
                $("#sw-total-step").text(stepInfo.totalSteps);

                if (stepPosition == 'last') {
                    showConfirm();
                    $("#btnFinish").prop('disabled', false);
                } else {
                    $("#btnFinish").prop('disabled', true);
                }

                // Focus first name
                if (stepIndex == 1) {
                    setTimeout(() => {
                        $('#first-name').focus();
                    }, 0);
                }
            });

            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                // autoAdjustHeight: false,
                theme: 'arrows', // basic, arrows, square, round, dots
                transition: {
                    animation: 'none'
                },
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    position: 'bottom', // none/ top/ both bottom
                    extraHtml: `<button class="btn btn-success" id="btnFinish" disabled onclick="onSubmitData()">Complete Order</button>
                              <button class="btn btn-danger" id="btnCancel" onclick="onCancel()">Cancel</button>`
                },
                anchor: {
                    enableNavigation: true, // Enable/Disable anchor navigation
                    enableNavigationAlways: false, // Activates all anchors clickable always
                    enableDoneState: true, // Add done state on visited steps
                    markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                    enableDoneStateNavigation: true // Enable/Disable the done state navigation
                },
            });

            $("#state_selector").on("change", function() {
                $('#smartwizard').smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$(
                    '#is_reset').prop("checked"));
                return true;
            });

            $("#style_selector").on("change", function() {
                $('#smartwizard').smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$(
                    '#is_reset').prop("checked"));
                return true;
            });

        });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#skk_id').change(function() {
                let skk_id = jQuery(this).val();
                jQuery.ajax({
                    url: '/getSKK',
                    type: 'POST',
                    data: 'skk_id=' + skk_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        jQuery('#prk_id').html(result)
                    }
                });
            })

            jQuery('#prk_id').change(function() {
                let prk_id = jQuery(this).val();
                jQuery.ajax({
                    url: '/getPRK',
                    type: 'POST',
                    data: 'prk_id=' + prk_id + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        var pemisah_titik = result;
                        pemisah_titik = pemisah_titik.toString();
                        pemisah_titik2 = "";
                        panjang = pemisah_titik.length;
                        j = 0;
                        for (i = panjang; i > 0; i--) {
                            j = j + 1;
                            if (((j % 3) == 1) && (j != 1)) {
                                pemisah_titik2 = pemisah_titik.substr(i - 1, 1) + "." + pemisah_titik2;
                            } else {
                                pemisah_titik2 = pemisah_titik.substr(i - 1, 1) + pemisah_titik2;
                            }
                        }
                        jQuery('#pagu_prk').html("Pagu PRK: <b>Rp.</b> <b id='rupiah'>" + pemisah_titik2 + "</b>")
                    }
                });
            })

            jQuery('#kontrak_induk').change(function() {
                let kontrak_induk = jQuery(this).val();
                jQuery('#addendum').val('');
                jQuery.ajax({
                    url: '/getAddendum',
                    type: 'POST',
                    data: 'kontrak_induk=' + kontrak_induk + '&_token={{ csrf_token() }}',
                    success: function(result) {
                        if (result.length > 0) {
                            jQuery('#addendum').val(result[0].nomor_addendum)
                        }
                    }
                });
            })

        });
    </script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/buat_po/step3_redaksi.js"></script>
@endsection

<script>
    var click = 1
    var nomor_tabel = 1
    var k = 0

    function updateform() {
        var kontrak_induk = document.getElementById('kontrak_induk').value;

        $.ajax({
            url: '/getKontrakInduk',
            type: "POST",
            data: 'kontrak_induk=' + kontrak_induk + '&_token={{ csrf_token() }}',
            success: function(response) {
                var item = [""]
                for (i = 0; i < response.length; i++) {
                    item += ("<option value='" + response[i].id + "'>" + response[i].nama_item +
                        "</option>")
                }

                var table = document.getElementById('tabelRAB');
                click++;

                var select1 = document.createElement("select");
                select1.innerHTML = "<option value='' selected disabled>Pilih Pekerjaan</option>" + item;
                select1.setAttribute("id", "item_id[" + click + "]");
                select1.setAttribute("name", "item_id");
                select1.setAttribute("class", "form-control input-default");
                select1.setAttribute("onchange", "change_item(this)");
                select1.setAttribute("required", true);

                var input1 = document.createElement("input");
                input1.setAttribute("type", "text");
                input1.setAttribute("class", "form-control kategory_id");
                input1.setAttribute("id", "kategory_id[" + click + "]");
                input1.setAttribute("name", "kategory_id");
                input1.setAttribute("placeholder", "Kategori");
                input1.setAttribute("value", "");
                input1.setAttribute("disabled", true);
                input1.setAttribute("required", true);

                var input2 = document.createElement("input");
                input2.setAttribute("type", "text");
                input2.setAttribute("class", "form-control satuan");
                input2.setAttribute("id", "satuan[" + click + "]");
                input2.setAttribute("name", "satuan");
                input2.setAttribute("placeholder", "Satuan");
                input2.setAttribute("value", "");
                input2.setAttribute("disabled", true);
                input2.setAttribute("required", true);

                var input3 = document.createElement("input");
                input3.setAttribute("type", "text");
                input3.setAttribute("class", "form-control volume");
                input3.setAttribute("id", "volume[" + click + "]");
                input3.setAttribute("name", "volume");
                input3.setAttribute("placeholder", "Volume");
                input3.setAttribute("value", "");
                input3.setAttribute("onblur", "blur_volume(this)");
                input3.setAttribute("onkeydown", "return numbersonly(this, event);");
                input3.setAttribute("onkeyup", "javascript:tandaPemisahTitik(this);");
                input3.setAttribute("required", true);

                var input4 = document.createElement("input");
                input4.setAttribute("type", "text");
                input4.setAttribute("class", "form-control harga_satuan");
                input4.setAttribute("id", "harga_satuan[" + click + "]");
                input4.setAttribute("name", "harga_satuan");
                input4.setAttribute("placeholder", "Harga Satuan");
                input4.setAttribute("value", "");
                input4.setAttribute("readonly", true);
                input4.setAttribute("disabled", true);
                input4.setAttribute("required", true);

                var input5 = document.createElement("input");
                input5.setAttribute("type", "text");
                input5.setAttribute("class", "form-control harga");
                input5.setAttribute("id", "harga[" + click + "]");
                input5.setAttribute("name", "harga");
                input5.setAttribute("placeholder", "Jumlah");
                input5.setAttribute("value", "");
                input5.setAttribute("readonly", true);
                input5.setAttribute("disabled", true);
                input5.setAttribute("required", true);

                var button = document.createElement("button");
                button.innerHTML = "<i class='fa fa-trash'></i>";
                button.setAttribute("onclick", "deleteRow(this)");
                button.setAttribute("class", "btn btn-danger shadow btn-xs sharp");

                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var cell8 = row.insertCell(7);
                cell1.innerHTML = "1";
                cell2.appendChild(select1);
                cell3.appendChild(input1);
                cell4.appendChild(input2);
                cell5.appendChild(input3);
                cell6.appendChild(input4);
                cell7.appendChild(input5);
                cell8.appendChild(button);

                reindex();
            }
        });
    }

    function deleteRow(r) {
        var table = r.parentNode.parentNode.rowIndex;
        document.getElementById("tabelRAB").deleteRow(table);
        click--;

        var select_id_item = document.querySelectorAll("#tabelRAB tr td:nth-child(2) select");
        for (var i = 0; i < select_id_item.length; i++) {
            select_id_item[i].id = "item_id[" + (i + 1) + "]";
        }

        var select_id_kategori = document.querySelectorAll("#tabelRAB tr td:nth-child(3) input");
        for (var i = 0; i < select_id_kategori.length; i++) {
            select_id_kategori[i].id = "kategory_id[" + (i + 1) + "]";
        }

        var select_id_satuan = document.querySelectorAll("#tabelRAB tr td:nth-child(4) input");
        for (var i = 0; i < select_id_satuan.length; i++) {
            select_id_satuan[i].id = "satuan[" + (i + 1) + "]";
        }

        var select_id_volume = document.querySelectorAll("#tabelRAB tr td:nth-child(5) input");
        for (var i = 0; i < select_id_volume.length; i++) {
            select_id_volume[i].id = "volume[" + (i + 1) + "]";
        }

        var select_id_harga_satuan = document.querySelectorAll("#tabelRAB tr td:nth-child(6) input");
        for (var i = 0; i < select_id_harga_satuan.length; i++) {
            select_id_harga_satuan[i].id = "harga_satuan[" + (i + 1) + "]";
        }

        var select_id_harga = document.querySelectorAll("#tabelRAB tr td:nth-child(7) input");
        for (var i = 0; i < select_id_harga.length; i++) {
            select_id_harga[i].id = "harga[" + (i + 1) + "]";
        }

        if (click == 0) {
            document.getElementById("jumlah").innerHTML = "";
            document.getElementById("pajak").innerHTML = "";
            document.getElementById("total").innerHTML = "";
        } else {
            var total_harga = [];

            for (var i = 0; i < click; i++) {
                total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
                total_harga[i] = total_harga[i].replace(/\./g, "");
                total_harga[i] = parseInt(total_harga[i])
            }

            var pagu_prk = document.getElementById("rupiah").innerHTML;
            pagu_prk = pagu_prk.replace(/\./g, "");
            pagu_prk = parseInt(pagu_prk);
            var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);

            if(pagu_prk >= total_harga_all) {
                total_harga_all = total_harga_all.toString();
                total_harga_all_2 = "";
                panjang_2 = total_harga_all.length;
                k = 0;
                for (i = panjang_2; i > 0; i--) {
                    k = k + 1;
                    if (((k % 3) == 1) && (k != 1)) {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                    } else {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                    }
                }
                document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
                total_harga_all = parseInt(total_harga_all);
                var ppn = total_harga_all * 11 / 100;
                ppn = Math.round(ppn);
                ppn = ppn.toString();
                ppn_2 = ""
                panjang_3 = ppn.length;
                l = 0;
                for (i = panjang_3; i > 0; i--) {
                    l = l + 1;
                    if (((l % 3) == 1) && (l != 1)) {
                        ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                    } else {
                        ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                    }
                }
                document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
                ppn = parseInt(ppn);
                var total = total_harga_all + ppn;
                total = Math.round(total);
                total = total.toString();
                total_2 = "";
                panjang_4 = total.length;
                m = 0;
                for (i = panjang_4; i > 0; i--) {
                    m = m + 1;
                    if (((m % 3) == 1) && (m != 1)) {
                        total_2 = total.substr(i - 1, 1) + "." + total_2;
                    } else {
                        total_2 = total.substr(i - 1, 1) + total_2;
                    }
                }
                document.getElementById("total").innerHTML = "Rp. " + total_2;
                document.getElementById("total").style.color = '#7E7E7E';
            } else {
                total_harga_all = total_harga_all.toString();
                total_harga_all_2 = "";
                panjang_2 = total_harga_all.length;
                k = 0;
                for (i = panjang_2; i > 0; i--) {
                    k = k + 1;
                    if (((k % 3) == 1) && (k != 1)) {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                    } else {
                        total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                    }
                }
                document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
                total_harga_all = parseInt(total_harga_all);
                var ppn = total_harga_all * 11 / 100;
                ppn = Math.round(ppn);
                ppn = ppn.toString();
                ppn_2 = ""
                panjang_3 = ppn.length;
                l = 0;
                for (i = panjang_3; i > 0; i--) {
                    l = l + 1;
                    if (((l % 3) == 1) && (l != 1)) {
                        ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                    } else {
                        ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                    }
                }
                document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
                ppn = parseInt(ppn);
                var total = total_harga_all + ppn;
                total = Math.round(total);
                total = total.toString();
                total_2 = "";
                panjang_4 = total.length;
                m = 0;
                for (i = panjang_4; i > 0; i--) {
                    m = m + 1;
                    if (((m % 3) == 1) && (m != 1)) {
                        total_2 = total.substr(i - 1, 1) + "." + total_2;
                    } else {
                        total_2 = total.substr(i - 1, 1) + total_2;
                    }
                }
                document.getElementById("total").innerHTML = "Rp. " + total_2;
                document.getElementById("total").style.color = 'red';
            }

        }

        reindex();

        if (click == 0) {
            updateform();
        }

    }

    function reindex() {
        const ids = document.querySelectorAll("#tabelRAB tr > td:nth-child(1)");
        ids.forEach((e, i) => {
            e.innerHTML = "<strong id=nomor[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
            nomor_tabel = i + 1;
        });
    }

    function change_item(c) {
        var change = c.parentNode.parentNode.rowIndex;
        var item_id = document.getElementById("item_id[" + change + "]").value;

        $.ajax({
            url: '/getItem',
            type: "POST",
            data: 'item_id=' + item_id + '&_token={{ csrf_token() }}',
            success: function(response) {
                document.getElementById("kategory_id[" + change + "]").value = response.kategori;
                document.getElementById("satuan[" + change + "]").value = response.kepanjangan + ' (' +
                    response.singkatan + ')';
                var harga_satuan = response.harga_satuan;
                harga_satuan = harga_satuan.toString();
                harga_satuan_2 = "";
                panjang = harga_satuan.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        harga_satuan_2 = harga_satuan.substr(i - 1, 1) + "." + harga_satuan_2;
                    } else {
                        harga_satuan_2 = harga_satuan.substr(i - 1, 1) + harga_satuan_2;
                    }
                }
                document.getElementById("harga_satuan[" + change + "]").value = harga_satuan_2;
                var volume = document.getElementById("volume[" + change + "]").value;
                harga_satuan = parseInt(harga_satuan);
                volume = volume.replace(/\./g, "");
                volume = parseInt(volume);
                var jumlah = volume * harga_satuan;
                jumlah = jumlah.toString();
                jumlah_2 = "";
                panjang_2 = jumlah.length;
                k = 0;
                for (i = panjang_2; i > 0; i--) {
                    k = k + 1;
                    if (((k % 3) == 1) && (k != 1)) {
                        jumlah_2 = jumlah.substr(i - 1, 1) + "." + jumlah_2;
                    } else {
                        jumlah_2 = jumlah.substr(i - 1, 1) + jumlah_2;
                    }
                }
                document.getElementById("harga[" + change + "]").value = jumlah_2;

                var total_harga = [];

                for (var i = 0; i < click; i++) {
                    total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
                    total_harga[i] = total_harga[i].replace(/\./g, "");
                    total_harga[i] = parseInt(total_harga[i])
                }              
                
                var pagu_prk = document.getElementById("rupiah").innerHTML;
                pagu_prk = pagu_prk.replace(/\./g, "");
                pagu_prk = parseInt(pagu_prk);
                var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);

                if(pagu_prk >= total_harga_all) {
                    total_harga_all = total_harga_all.toString();
                    total_harga_all_2 = "";
                    panjang_2 = total_harga_all.length;
                    k = 0;
                    for (i = panjang_2; i > 0; i--) {
                        k = k + 1;
                        if (((k % 3) == 1) && (k != 1)) {
                            total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                        } else {
                            total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                        }
                    }
                    document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
                    total_harga_all = parseInt(total_harga_all);
                    var ppn = total_harga_all * 11 / 100;
                    ppn = Math.round(ppn);
                    ppn = ppn.toString();
                    ppn_2 = ""
                    panjang_3 = ppn.length;
                    l = 0;
                    for (i = panjang_3; i > 0; i--) {
                        l = l + 1;
                        if (((l % 3) == 1) && (l != 1)) {
                            ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                        } else {
                            ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                        }
                    }
                    document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
                    ppn = parseInt(ppn);
                    var total = total_harga_all + ppn;
                    total = Math.round(total);
                    total = total.toString();
                    total_2 = "";
                    panjang_4 = total.length;
                    m = 0;
                    for (i = panjang_4; i > 0; i--) {
                        m = m + 1;
                        if (((m % 3) == 1) && (m != 1)) {
                            total_2 = total.substr(i - 1, 1) + "." + total_2;
                        } else {
                            total_2 = total.substr(i - 1, 1) + total_2;
                        }
                    }
                    document.getElementById("total").innerHTML = "Rp. " + total_2;
                    document.getElementById("total").style.color = '#7E7E7E';
                } else {
                    total_harga_all = total_harga_all.toString();
                    total_harga_all_2 = "";
                    panjang_2 = total_harga_all.length;
                    k = 0;
                    for (i = panjang_2; i > 0; i--) {
                        k = k + 1;
                        if (((k % 3) == 1) && (k != 1)) {
                            total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                        } else {
                            total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                        }
                    }
                    document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
                    total_harga_all = parseInt(total_harga_all);
                    var ppn = total_harga_all * 11 / 100;
                    ppn = Math.round(ppn);
                    ppn = ppn.toString();
                    ppn_2 = ""
                    panjang_3 = ppn.length;
                    l = 0;
                    for (i = panjang_3; i > 0; i--) {
                        l = l + 1;
                        if (((l % 3) == 1) && (l != 1)) {
                            ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                        } else {
                            ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                        }
                    }
                    document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
                    ppn = parseInt(ppn);
                    var total = total_harga_all + ppn;
                    total = Math.round(total);
                    total = total.toString();
                    total_2 = "";
                    panjang_4 = total.length;
                    m = 0;
                    for (i = panjang_4; i > 0; i--) {
                        m = m + 1;
                        if (((m % 3) == 1) && (m != 1)) {
                            total_2 = total.substr(i - 1, 1) + "." + total_2;
                        } else {
                            total_2 = total.substr(i - 1, 1) + total_2;
                        }
                    }
                    document.getElementById("total").innerHTML = "Rp. " + total_2;
                    document.getElementById("total").style.color = 'red';
                }
            }
        })
    }

    function ganti_item() {
        var kontrak_induk = document.getElementById('kontrak_induk').value;

        $.ajax({
            url: '/getKontrak_Induk',
            type: 'POST',
            data: 'kontrak_induk=' + kontrak_induk + '&_token={{ csrf_token() }}',
            success: function(result) {
                var item = [""]
                for (i = 0; i < result.length; i++) {
                    item += ("<option value='" + result[i].id + "'>" + result[i].nama_item +
                        "</option>")
                }
                for (var i = 0; i < click; i++) {
                    document.getElementById("item_id[" + (i + 1) + "]").innerHTML =
                        "<option value='' selected disabled>Pilih Pekerjaan</option>" + item;
                }
            }
        })
    }

    function blur_volume(c) {
        var change = c.parentNode.parentNode.rowIndex;
        var volume = document.getElementById("volume[" + change + "]").value;
        volume = volume.replace(/\./g, "");
        volume = parseInt(volume);
        var harga_satuan = document.getElementById("harga_satuan[" + change + "]").value;
        harga_satuan = harga_satuan.replace(/\./g, "");
        harga_satuan = parseInt(harga_satuan);

        var harga = volume * harga_satuan;
        harga = harga.toString();
        harga_2 = "";
        panjang = harga.length;
        j = 0;
        for (i = panjang; i > 0; i--) {
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)) {
                harga_2 = harga.substr(i - 1, 1) + "." + harga_2;
            } else {
                harga_2 = harga.substr(i - 1, 1) + harga_2;
            }
        }
        document.getElementById("harga[" + change + "]").value = harga_2;

        var total_harga = [];

        for (var i = 0; i < click; i++) {
            total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
            total_harga[i] = total_harga[i].replace(/\./g, "");
            total_harga[i] = parseInt(total_harga[i])
        }

        var pagu_prk = document.getElementById("rupiah").innerHTML;
        pagu_prk = pagu_prk.replace(/\./g, "");
        pagu_prk = parseInt(pagu_prk);
        var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);

        if(pagu_prk >= total_harga_all) {
            total_harga_all = total_harga_all.toString();
            total_harga_all_2 = "";
            panjang_2 = total_harga_all.length;
            k = 0;
            for (i = panjang_2; i > 0; i--) {
                k = k + 1;
                if (((k % 3) == 1) && (k != 1)) {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                } else {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                }
            }
            document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
            total_harga_all = parseInt(total_harga_all);
            var ppn = total_harga_all * 11 / 100;
            ppn = Math.round(ppn);
            ppn = ppn.toString();
            ppn_2 = ""
            panjang_3 = ppn.length;
            l = 0;
            for (i = panjang_3; i > 0; i--) {
                l = l + 1;
                if (((l % 3) == 1) && (l != 1)) {
                    ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                } else {
                    ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                }
            }
            document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
            ppn = parseInt(ppn);
            var total = total_harga_all + ppn;
            total = Math.round(total);
            total = total.toString();
            total_2 = "";
            panjang_4 = total.length;
            m = 0;
            for (i = panjang_4; i > 0; i--) {
                m = m + 1;
                if (((m % 3) == 1) && (m != 1)) {
                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                } else {
                    total_2 = total.substr(i - 1, 1) + total_2;
                }
            }
            document.getElementById("total").innerHTML = "Rp. " + total_2;
            document.getElementById("total").style.color = '#7E7E7E';
        } else {
            total_harga_all = total_harga_all.toString();
            total_harga_all_2 = "";
            panjang_2 = total_harga_all.length;
            k = 0;
            for (i = panjang_2; i > 0; i--) {
                k = k + 1;
                if (((k % 3) == 1) && (k != 1)) {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + "." + total_harga_all_2;
                } else {
                    total_harga_all_2 = total_harga_all.substr(i - 1, 1) + total_harga_all_2;
                }
            }
            document.getElementById("jumlah").innerHTML = "Rp. " + total_harga_all_2;
            total_harga_all = parseInt(total_harga_all);
            var ppn = total_harga_all * 11 / 100;
            ppn = Math.round(ppn);
            ppn = ppn.toString();
            ppn_2 = ""
            panjang_3 = ppn.length;
            l = 0;
            for (i = panjang_3; i > 0; i--) {
                l = l + 1;
                if (((l % 3) == 1) && (l != 1)) {
                    ppn_2 = ppn.substr(i - 1, 1) + "." + ppn_2;
                } else {
                    ppn_2 = ppn.substr(i - 1, 1) + ppn_2;
                }
            }
            document.getElementById("pajak").innerHTML = "Rp. " + ppn_2;
            ppn = parseInt(ppn);
            var total = total_harga_all + ppn;
            total = Math.round(total);
            total = total.toString();
            total_2 = "";
            panjang_4 = total.length;
            m = 0;
            for (i = panjang_4; i > 0; i--) {
                m = m + 1;
                if (((m % 3) == 1) && (m != 1)) {
                    total_2 = total.substr(i - 1, 1) + "." + total_2;
                } else {
                    total_2 = total.substr(i - 1, 1) + total_2;
                }
            }
            document.getElementById("total").innerHTML = "Rp. " + total_2;
            document.getElementById("total").style.color = 'red';
        }

    }

    function onSubmitData() {
        var token = $('#csrf').val();
        var po = document.getElementById('po').value;
        var today = new Date();
        today = new Date(today.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().split("T")[0];
        var kontrak_induk = document.getElementById('kontrak_induk').value;
        var pekerjaan = document.getElementById('pekerjaan').value;
        var lokasi = document.getElementById('lokasi').value;
        var start_date = document.getElementById('start_date').value;
        var end_date = document.getElementById('end_date').value;
        start_date = new Date(start_date);
        end_date = new Date(end_date);
        start_date = new Date(start_date.getTime() - (start_date.getTimezoneOffset() * 60000)).toISOString().split("T")[
            0];
        end_date = new Date(end_date.getTime() - (end_date.getTimezoneOffset() * 60000)).toISOString().split("T")[0];
        var addendum = document.getElementById('addendum').value;
        var skk_id = document.getElementById('skk_id').value;
        var prk_id = document.getElementById('prk_id').value;
        var pejabat = document.getElementById('pejabat').value;
        var pengawas = document.getElementById('pengawas').value;

        var item_id = [];
        var kategory_id = [];
        var satuan = [];
        var volume = [];
        var harga_satuan = [];
        var harga = [];

        for (var i = 0; i < click; i++) {
            item_id[i] = document.getElementById("item_id[" + (i + 1) + "]").value;
            kategory_id[i] = document.getElementById("kategory_id[" + (i + 1) + "]").value;
            satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
            satuan[i] = satuan[i].replace(/\(([^)]+)\)/, "");
            satuan[i] = satuan[i].replace(/\ /g, "");
            volume[i] = document.getElementById("volume[" + (i + 1) + "]").value;
            volume[i] = parseInt(volume[i]);
            harga_satuan[i] = document.getElementById("harga_satuan[" + (i + 1) + "]").value;
            harga_satuan[i] = harga_satuan[i].replace(/\./g, "");
            harga_satuan[i] = parseInt(harga_satuan[i]);
            harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
            harga[i] = harga[i].replace(/\./g, "");
            harga[i] = parseInt(harga[i]);
        }

        const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
        var ppn = bef_ppn_total_harga * 11 / 100;
        ppn = Math.round(ppn);
        var total_harga = bef_ppn_total_harga + ppn;
        total_harga = Math.round(total_harga);


        swal({
                title: "Apakah anda yakin?",
                text: "Anda tidak dapat mengedit Data ini lagi!",
                icon: "warning",
                buttons: true,
            })
            .then((willCreate) => {
                if (willCreate) {
                    var data = {
                        "_token": token,
                        "nomor_po": po,
                        "tanggal_po": today,
                        "skk_id": skk_id,
                        "prk_id": prk_id,
                        "pekerjaan": pekerjaan,
                        "lokasi": lokasi,
                        "startdate": start_date,
                        "enddate": end_date,
                        "nomor_kontrak_induk": kontrak_induk,
                        "addendum_id": addendum,
                        "pejabat_id": pejabat,
                        "pengawas": pengawas,
                        "total_harga": total_harga,
                        "kategori_order": kategory_id,
                        "item_order": item_id,
                        "satuan_id": satuan,
                        "harga_satuan": harga_satuan,
                        "volume": volume,
                        "jumlah_harga": harga,
                        "click": click,
                    }
                    // console.log(data);

                    $.ajax({
                        type: 'POST',
                        url: "/simpan-po-khs",
                        data: data,
                        success: function(response) {
                            swal({
                                    title: "Data Ditambah",
                                    text: "Data Berhasil Ditambah",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                });

                                console.log(response);

                                window.location.href = '../preview-pdf-khs/'+ response;
                                // .then((response) => {
                                //     console.log(response);

                                // });
                        }
                    });
                } else {
                    swal({
                        title: "Data Belum Ditambah",
                        text: "Silakan Cek Kembali Data Anda",
                        icon: "error",
                        timer: 2e3,
                        buttons: false
                    });
                }
            })
    }
</script>

<script type="text/javascript">
    function tandaPemisahTitik(b) {
        var _minus = false;
        if (b < 0) _minus = true;
        b = b.toString();
        b = b.replace(".", "");
        b = b.replace("-", "");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--) {
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)) {
                c = b.substr(i - 1, 1) + "." + c;
            } else {
                c = b.substr(i - 1, 1) + c;
            }
        }
        if (_minus) c = "-" + c;
        return c;
    }

    function numbersonly(ini, e) {
        if (e.keyCode >= 49) {
            if (e.keyCode <= 57) {
                a = ini.value.toString().replace(".", "");
                b = a.replace(/[^\d]/g, "");
                b = (b == "0") ? String.fromCharCode(e.keyCode) : b + String.fromCharCode(e.keyCode);
                ini.value = tandaPemisahTitik(b);
                return false;
            } else if (e.keyCode <= 105) {
                if (e.keyCode >= 96) {
                    //e.keycode = e.keycode - 47;
                    a = ini.value.toString().replace(".", "");
                    b = a.replace(/[^\d]/g, "");
                    b = (b == "0") ? String.fromCharCode(e.keyCode - 48) : b + String.fromCharCode(e.keyCode - 48);
                    ini.value = tandaPemisahTitik(b);
                    //alert(e.keycode);
                    return false;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else if (e.keyCode == 48) {
            a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode);
            b = a.replace(/[^\d]/g, "");
            if (parseFloat(b) != 0) {
                ini.value = tandaPemisahTitik(b);
                return false;
            } else {
                return false;
            }
        } else if (e.keyCode == 95) {
            a = ini.value.replace(".", "") + String.fromCharCode(e.keyCode - 48);
            b = a.replace(/[^\d]/g, "");
            if (parseFloat(b) != 0) {
                ini.value = tandaPemisahTitik(b);
                return false;
            } else {
                return false;
            }
        } else if (e.keyCode == 8 || e.keycode == 46) {
            a = ini.value.replace(".", "");
            b = a.replace(/[^\d]/g, "");
            b = b.substr(0, b.length - 1);
            if (tandaPemisahTitik(b) != "") {
                ini.value = tandaPemisahTitik(b);
            } else {
                ini.value = "";
            }

            return false;
        } else if (e.keyCode == 9) {
            return true;
        } else if (e.keyCode == 17) {
            return true;
        } else {
            //alert (e.keyCode);
            return false;
        }
    }
</script>

{{-- <script type="text/javascript">
    window.onload = function(id) {
        var id =  id
        console.log(id);
        window.location.href = "http://127.0.0.1:8000/po-khs/edit-po/"+id+"/#daftar_rab"
    }
</script> --}}
