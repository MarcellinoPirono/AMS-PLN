@extends('layouts.main')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/po-khs">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $active1 }}</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-dua">
                    <div class="card-header">
                        <h4 class="card-title">Form step {{ $active }}</h4>
                    </div>
                    <div class="m-auto" style="width:97%;">
                        <div id="smartwizard" dir="rtl-" class="mt-4">
                            <ul class="nav nav-progress">
                                <li class="nav-item">
                                    <a class="nav-link" href="#kak">
                                        <div class="num">1</div>
                                        Upload Kerangka Acuan Kerja
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#daftar_rab">
                                        <span class="num">2</span>
                                        Daftar RAB
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#preview_non_po">
                                        <span class="num">3</span>
                                        Preview Non-PO
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3 tab-flex">
                                <div id="kak" class="tab-pane", role="tabpanel" aria-labelledby="step-1"
                                    style="height: auto !important; display: flex !important; flex-direction: column !important;">
                                    <form id="form-1" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input Nota Dinas</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input id="nota_dinas" type="file"
                                                                class="form-control custom-file-input"
                                                                style="border-radius: 0 20px 20px 0" accept=".pdf" required />
                                                            <label class="custom-file-label">Choose </label>
                                                        </div>
                                                    </div>
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Upload Nota Dinas
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input KAK</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input id="kak" type="file"
                                                                class="form-control custom-file-input"
                                                                style="border-radius: 0 20px 20px 0" accept=".pdf" required />
                                                            <label class="custom-file-label">Choose </label>
                                                        </div>
                                                    </div>
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Upload KAK
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input No. RPBJ</label>
                                                    <input type="text" class="form-control" name="no_rpbj" id="no_rpbj"
                                                        placeholder="Nomor RPBJ" required autofocus
                                                        value="{{ old('no_rpbj') }}">
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi No. RPBJ
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input No.SKK</label>
                                                    <select class="form-control input-default" id="skk_id"
                                                        name="skk_id">
                                                        <option value="0" selected disabled>Pilih No. SKK</option>
                                                        @foreach ($skks as $skk)
                                                            <option value="{{ $skk->nomor_skk }}">{{ $skk->nomor_skk }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih No. SKK
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input No.PRK</label>
                                                    <select class="form-control input-default" id="prk_id"
                                                        name="prk_id">
                                                        <option value="" selected disabled>Pilih PRK</option>
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih No. PRK
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Supervisor</label>
                                                    <input type="text" class="form-control" name="supervisor"
                                                        id="supervisor" placeholder="Supervisor" required autofocus
                                                        value="{{ old('supervisor') }}">
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi Supervisor
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Pilih Manager</label>
                                                    <select class="form-control input-default" id="manager"
                                                    style="height: 60px !important ; word-wrap: normal !important; white-space: normal; overflow: hidden;   text-overflow: ellipsis;"
                                                    name="manager" required>
                                                        <option value="" selected disabled>Manager
                                                        </option>
                                                        @foreach ($pejabats as $pejabat)
                                                            <option value="{{ $pejabat->id }}">
                                                                {{ $pejabat->jabatan }} -
                                                                {{ $pejabat->nama_pejabat }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Data Terpilih
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan Pilih Manager
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="daftar_rab" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Daftar RAB</h4>
                                                    </div>
                                                    <div class="row ml-2">
                                                        <div class="table-responsive">
                                                            <table id="tabelNonPO"
                                                                class="table table-responsive-lg tabel-daftar1"
                                                                style="width: 1520px" cellpadding="0" cellspacing="0"
                                                                border="0">
                                                                <thead>
                                                                    <tr align="center" valign="middle" class="">
                                                                        <th align="center" valign="middle"
                                                                            style="width: 60px vertical-align: middle;">No.
                                                                        </th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 322px; vertical-align: middle;">
                                                                            Uraian</th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 134px; vertical-align: middle;">
                                                                            Satuan</th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 134px; vertical-align: middle;">
                                                                            Volume</th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 209px; vertical-align: middle;">
                                                                            Harga Satuan</th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 230px; vertical-align: middle;">
                                                                            Jumlah</th>
                                                                        <th align="center" valign="middle"
                                                                            style="width: 80px; vertical-align: middle !important;">
                                                                            Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-kategori">
                                                                    <tr>
                                                                        <td><strong id="nomor"
                                                                                value="1">1</strong>
                                                                        </td>
                                                                        <td><input type="text"
                                                                                class="form-control uraian" id="uraian[1]"
                                                                                name="uraian" placeholder="Uraian"
                                                                                value=""></td>
                                                                        <td><input type="text"
                                                                                class="form-control satuan" id="satuan[1]"
                                                                                name="satuan" placeholder="Satuan"
                                                                                value=""></td>
                                                                        <td><input type="text"
                                                                                class="form-control volume" id="volume[1]"
                                                                                name="volume" placeholder="volume"
                                                                                value=""
                                                                                onkeydown="return numbersonly(this, event);"
                                                                                onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                required></td>
                                                                        <td><input type="text"
                                                                                class="form-control harga_satuan"
                                                                                id="harga_satuan[1]" name="harga_satuan"
                                                                                placeholder="Harga Satuan" value=""
                                                                                onblur="hitung_harga(this)"
                                                                                onkeydown="return numbersonly(this, event);"
                                                                                onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                required>
                                                                        </td>
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
                                                                        <th></th>
                                                                        <th>Jumlah:</th>
                                                                        <th id="jumlah"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>PPN 11%:</th>
                                                                        <th id="pajak"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>Total Harga:</th>
                                                                        <th id="total"></th>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootrap for the demo page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/jquery.smartWizard.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./asset/frontend/js/wizard.js"></script>

    <script type="text/javascript">
        const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));

        function onCancel() {
            // Reset wizard
            $('#smartwizard').smartWizard("reset");

            // Reset form
            document.getElementById("form-1").reset();
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
            document.getElementById("form-1").reset();
            document.getElementById("form-2").reset();
            document.getElementById("form-3").reset();
            document.getElementById("form-4").reset();

            myModal.hide();
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
                    var kak = $("#kak").files();
                    var nomor_rpbj = $("#nomor_rpbj").val();
                    var skk_id = $("#skk_id option:selected").text();
                    var prk_id = $("#prk_id option:selected").text();

                    $("#nomor_rpbj_3").html(nomor_rpbj);
                    $("#no_skk_3").html(skk_id);
                    $("#no_prk_3").html(prk_id);

                    baris = [];

                    for (var i = 0; i < click; i++) {
                        baris[i] = [
                            $("#uraian[" + (i + 1) + "]").val(),
                            $("#satuan[" + (i + 1) + "]").val(),
                            $("#volume[" + (i + 1) + "]").val(),
                            $("#harga_satuan[" + (i + 1) + "]").val(),
                            $("#harga[" + (i + 1) + "]").val()
                        ]
                    }

                    $("#next-btn").addClass('disabled').prop('disabled', true);
                    // alert(click);
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
                selected: 1,
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
@endsection
<script>
    var click = 1
    var nomor_tabel = 1
    var k = 0



    function reindex() {
        const ids = document.querySelectorAll("#tabelNonPO tr > td:nth-child(1)");
        ids.forEach((e, i) => {
            e.innerHTML = "<strong id=nomor[" + (i + 1) + "] value=" + (i + 1) + ">" + (i + 1) + "</strong>"
            nomor_tabel = i + 1;
        });
    }


    function updateform() {
        // var kontrak_induk = document.getElementById('kontrak_induk').value;
        var table = document.getElementById('tabelNonPO');
        click++;

        var input1 = document.createElement("input");
        input1.setAttribute("type", "text");
        input1.setAttribute("class", "form-control uraian");
        input1.setAttribute("id", "uraian[" + click + "]");
        input1.setAttribute("name", "uraian");
        input1.setAttribute("placeholder", "Uraian");
        input1.setAttribute("value", "");
        input1.setAttribute("required", true);

        var input2 = document.createElement("input");
        input2.setAttribute("type", "text");
        input2.setAttribute("class", "form-control satuan");
        input2.setAttribute("id", "satuan[" + click + "]");
        input2.setAttribute("name", "satuan");
        input2.setAttribute("placeholder", "Satuan");
        input2.setAttribute("value", "");
        input2.setAttribute("required", true);

        var input3 = document.createElement("input");
        input3.setAttribute("type", "text");
        input3.setAttribute("class", "form-control volume");
        input3.setAttribute("id", "volume[" + click + "]");
        input3.setAttribute("name", "volume");
        input3.setAttribute("placeholder", "Volume");
        input3.setAttribute("value", "");
        // input3.setAttribute("onblur", "hitung_harga(this)");
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
        input4.setAttribute("onblur", "hitung_harga(this)")
        input4.setAttribute("onkeydown", "return numbersonly(this, event);");
        input4.setAttribute("onkeyup", "javascript:tandaPemisahTitik(this);");
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
        cell1.innerHTML = "1";
        // cell2.appendChild(select1);
        cell2.appendChild(input1);
        cell3.appendChild(input2);
        cell4.appendChild(input3);
        cell5.appendChild(input4);
        cell6.appendChild(input5);
        cell7.appendChild(button);

        reindex();
    }

    function deleteRow(r) {
        var table = r.parentNode.parentNode.rowIndex;
        document.getElementById("tabelNonPO").deleteRow(table);
        click--;

        var select_id_uraian = document.querySelectorAll("#tabelNonPO tr td:nth-child(2) input");
        for (var i = 0; i < select_id_uraian.length; i++) {
            select_id_uraian[i].id = "uraian[" + (i + 1) + "]";
        }

        var select_id_satuan = document.querySelectorAll("#tabelNonPO tr td:nth-child(3) input");
        for (var i = 0; i < select_id_satuan.length; i++) {
            select_id_satuan[i].id = "satuan[" + (i + 1) + "]";
        }

        var select_id_volume = document.querySelectorAll("#tabelNonPO tr td:nth-child(4) input");
        for (var i = 0; i < select_id_volume.length; i++) {
            select_id_volume[i].id = "volume[" + (i + 1) + "]";
        }

        var select_id_harga_satuan = document.querySelectorAll("#tabelNonPO tr td:nth-child(5) input");
        for (var i = 0; i < select_id_harga_satuan.length; i++) {
            select_id_harga_satuan[i].id = "harga_satuan[" + (i + 1) + "]";
        }

        var select_id_harga = document.querySelectorAll("#tabelNonPO tr td:nth-child(6) input");
        for (var i = 0; i < select_id_harga.length; i++) {
            select_id_harga[i].id = "harga[" + (i + 1) + "]";
        }

        reindex();

        if (click == 0) {
            updateform();
        }

        var total_harga = [];

        for (var i = 0; i < click; i++) {
            total_harga[i] = document.getElementById("harga[" + (i + 1) + "]").value;
            total_harga[i] = total_harga[i].replace(/\./g, "");
            total_harga[i] = parseInt(total_harga[i])
        }

        var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator +
            currentvalue);
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

    }

    function hitung_harga(c) {
        // var change = c.parentNode.parentNode.rowIndex;
        // var volume = document.getElementById("volume[" + change "]").value;
        // volume = volume.replace(/\./g, "");
        // volume = parseInt(volume);
        // var harga_satuan = document.getElementById("harga_satuan[" + change "]").value;
        // harga_satuan = harga_satuan.replace(/\./g, "");
        // harga_satuan = parseInt(harga_satuan);

        // var harga = volume * harga_satuan;

        // harga = harga.toString();
        // harga_2 = "";
        // length_2 = harga.length;
        // k = 0;
        // for (i = length_2; i > 0; i--) {
        //     k = k + 1;
        //     if (((k % 3) == 1) && (k != 1)) {
        //         harga_2 = harga.substr(i - 1, 1) + "." + harga_2;
        //     } else {
        //         harga_2 = harga.substr(i - 1, 1) + harga_2;
        //     }
        // }
        // document.getElementById("harga[" + change + "]").value = harga_2;

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

        var total_harga_all = total_harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
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
    }

    function onSubmitData() {
        var token = $('#csrf').val();
        var kak = document.getElementById('kak').files;
        var nomor_rpbj = document.getElementById('nomor_rpbj').value;
        var skk_id = document.getElementById('skk_id').value;
        var prk_id = document.getElementById('prk_id').value;

        var uraian = [];
        var satuan = [];
        var volume = [];
        var harga_satuan = [];
        var harga = [];

        for (var i = 0; i < click; i++) {
            uraian[i] = document.getElementById("uraian[" + (i + 1) + "]").value;
            satuan[i] = document.getElementById("satuan[" + (i + 1) + "]").value;
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
                text: "Silakan cek kembali apabila data masih keliru",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCreate) => {
                if (willCreate) {
                    var data = {
                        "_token": token,
                        "nomor_rpbj": nomor_rpbj,
                        "skk_id": skk_id,
                        "prk_id": prk_id,
                        "kak": kak,
                        "total_harga": total_harga,
                        "uraian": uraian,
                        "satuan_id": satuan,
                        "harga_satuan": harga_satuan,
                        "volume": volume,
                        "jumlah_harga": harga,
                        "click": click,
                    }
                    // console.log(data);

                    $.ajax({
                        type: 'POST',
                        url: "/simpan-non-po",
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
                                    window.location.href = "/non-po";
                                });
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


    // function next1() {
    //     btn_next1 = document.getElementById('btnnext1');
    //     btn_next1.setAttribute("id", "btnnext2");
    //     btn_next1.setAttribute("onclick", "next2()");

    //     btn_prev1 = document.getElementById('btnprev1');
    //     btn_prev1.setAttribute("id", "btnprev2");
    //     btn_prev1.setAttribute("onclick", "prev2()");
    // }

    // function next2() {
    //     btn_next2 = document.getElementById('btnnext2');
    //     btn_next2.innerText = "Simpan Data";
    //     btn_next2.setAttribute("id", "btnnext3");
    //     btn_next2.setAttribute("onclick", "next3()");
    //     btn_next2.setAttribute("class", "btn btn-success sw-btn-next");

    //     btn_prev2 = document.getElementById('btnprev2');
    //     btn_prev2.setAttribute("id", "btnprev3");
    //     btn_prev2.setAttribute("onclick", "prev3()");

    // }

    // function next3() {
    //     var token = $('#csrf').val();
    //     // var po = document.getElementById('kak').value;
    //     // var today = new Date();
    //     // today = new Date(today.getTime() - (today.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
    //     // var kontrak_induk = document.getElementById('kontrak_induk').value;
    //     var pekerjaan = document.getElementById('no_rpbj').value;
    //     var pekerjaan = document.getElementById('skk_id').value;
    //     var lokasi = document.getElementById('prk_id').value;
    //     // var start_date = document.getElementById('start_date').value;
    //     // var end_date = document.getElementById('end_date').value;
    //     // start_date = new Date(start_date);
    //     // end_date = new Date(end_date);
    //     // start_date = new Date(start_date.getTime() - (start_date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
    //     // end_date = new Date(end_date.getTime() - (end_date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];
    //     // var addendum = document.getElementById('addendum').value;
    //     // var skk_id = document.getElementById('skk_id').value;
    //     // var prk_id = document.getElementById('prk_id').value;
    //     // var pejabat = document.getElementById('pejabat').value;
    //     // var pengawas = document.getElementById('pengawas').value;

    //     var uraian = [];
    //     // var kategory_id = [];
    //     var satuan = [];
    //     var volume = [];
    //     var harga_satuan = [];
    //     var harga = [];

    //     for(var i = 0; i < click; i++)
    //     {
    //         uraian[i] = document.getElementById("uraian["+ (i + 1) +"]").value;
    //         // kategory_id[i] = document.getElementById("kategory_id["+ (i + 1) +"]").value;
    //         satuan[i] = document.getElementById("satuan["+ (i + 1) +"]").value;
    //         volume[i] = document.getElementById("volume["+ (i + 1) +"]").value;
    //         volume[i] = parseInt(volume[i]);
    //         harga_satuan[i] = document.getElementById("harga_satuan["+ (i + 1) +"]").value;
    //         harga_satuan[i] = parseInt(harga_satuan[i]);
    //         harga[i] = document.getElementById("harga["+ (i + 1) +"]").value;
    //         harga[i] = parseInt(harga[i]);
    //     }

    //     const bef_ppn_total_harga = harga.reduce((accumulator, currentvalue) => accumulator + currentvalue);
    //     var ppn = bef_ppn_total_harga * 11 / 100;
    //     ppn = Math.round(ppn);
    //     var total_harga = bef_ppn_total_harga + ppn;
    //     total_harga = Math.round(total_harga);

    //     swal({
    //         title: "Apakah anda yakin?",
    //         text: "Silakan cek kembali apabila data masih keliru",
    //         icon: "warning",
    //         buttons: true,
    //         dangerMode: true,
    //     })
    //     .then((willCreate) => {
    //         if (willCreate) {
    //             var data = {
    //                 "_token": token,
    //                 "no_rpbj": no_rpbj
    //                 // "tanggal_po": today,
    //                 "skk_id": skk_id,
    //                 "prk_id": prk_id,
    //                 // "pekerjaan": pekerjaan,
    //                 // "lokasi": lokasi,
    //                 // "startdate": start_date,
    //                 // "enddate": end_date,
    //                 // "nomor_kontrak_induk": kontrak_induk,
    //                 // "addendum_id": addendum,
    //                 // "pejabat_id": pejabat,
    //                 // "pengawas": pengawas,
    //                 "total_harga": total_harga,
    //                 // "kategori_order": kategory_id,
    //                 "uraian": uraian,
    //                 "satuan": satuan,
    //                 "harga_satuan": harga_satuan,
    //                 "volume": volume,
    //                 "jumlah_harga": harga,
    //                 "click": click,
    //             }
    //             console.log(data);

    //             $.ajax({
    //                 type: 'POST',
    //                 url: "{{ url('non-po') }}",
    //                 data: data,
    //                 success: function(response) {
    //                     swal({
    //                         title: "Data Ditambah",
    //                         text: "Data Berhasil Ditambah",
    //                         icon: "success",
    //                         timer: 2e3,
    //                         buttons: false
    //                     })
    //                     .then((result) => {
    //                         window.location.href = "/non-po";
    //                     });
    //                 }
    //             });
    //         } else {
    //             swal({
    //                 title: "Data Belum Ditambah",
    //                 text: "Silakan Cek Kembali Data Anda",
    //                 icon: "error",
    //                 timer: 2e3,
    //                 buttons: false
    //             });
    //         }
    //     })
    // }

    // function prev3() {
    //     btn_next3 = document.getElementById('btnnext3');
    //     btn_next3.setAttribute("id", "btnnext2");
    //     btn_next3.setAttribute("onclick", "next2()");

    //     btn_prev3 = document.getElementById('btnprev3');
    //     btn_prev3.setAttribute("id", "btnprev2");
    //     btn_prev3.setAttribute("onclick", "prev2()");
    // }
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
    })
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
