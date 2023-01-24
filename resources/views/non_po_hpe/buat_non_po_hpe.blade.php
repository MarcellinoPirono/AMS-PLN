@extends('layouts.main')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/non-po-hpe">{{ $active }}</a></li>
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
                                    <a class="nav-link" href="#informasi_umum">
                                        <div class="num">1</div>
                                        Informasi Umum
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#daftar_rab">
                                        <span class="num">2</span>
                                        Daftar RAB & HPE
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#preview_non_po">
                                        <span class="num">3</span>
                                        Preview Kontrak Non PO HPE
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3 tab-flex">
                                @foreach ($nonpos as $nonpo)
                                <div id="informasi_umum" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <form id="form-1" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                                        <input type="hidden" name="non_po_id" id="non_po_id" value="{{ $non_po_id }}">
                                        <div class="row m-auto">
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input No. RPBJ</label>
                                                    <input type="text" class="form-control" name="nomor_rpbj"
                                                        id="nomor_rpbj" placeholder="Nomor RPBJ" required autofocus disabled
                                                        value="{{ old('nomor_rpbj', $nonpo->nomor_rpbj) }}">
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
                                                    <label class="text-label">Input Pekerjaan</label>
                                                    <input type="text" class="form-control" name="pekerjaan"
                                                        id="pekerjaan" placeholder="Pekerjaan" required autofocus disabled
                                                        value="{{ old('pekerjaan', $nonpo->pekerjaan) }}">
                                                    <div class="valid-feedback">
                                                        Data Terisi
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan isi Pekerjaan
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <div class="form-group">
                                                    <label class="text-label">Input No.SKK</label>
                                                    <select class="form-control input-default" id="skk_id" name="skk_id"
                                                        required disabled>
                                                        <option value="" selected disabled>Pilih No. SKK</option>
                                                        @foreach ($skks as $skk)
                                                            <option value="{{ $skk->id }}" @if($nonpo->skk_id == $skk->id)selected @endif>{{ $skk->nomor_skk }}
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
                                                    <label class="text-label">Input No. PRK</label>
                                                    <select class="form-control input-default" id="prk_id" name="prk_id"
                                                        required disabled>
                                                        <option value="" selected disabled>Pilih PRK</option>
                                                        @foreach ($prks as $prk)
                                                            <option value="{{ $prk->id }}"
                                                                @if ($nonpo->prk_id == $prk->id) selected @endif>
                                                                {{ $prk->no_prk }}</option>
                                                        @endforeach
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
                                                        id="supervisor" placeholder="Supervisor" required autofocus disabled
                                                        value="{{ old('supervisor', $nonpo->supervisor) }}">
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
                                                    <select class="form-control input-default" id="pejabat_id"
                                                        name="pejabat_id" required disabled>
                                                        <option value="" selected disabled>Manager
                                                        </option>
                                                        @foreach ($pejabats as $pejabat)
                                                            <option value="{{ $pejabat->id }}" @if ($nonpo->pejabat_id == $pejabat->id) selected
                                                            @endif>
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
                                    <input type="hidden" name="ppn" id="ppn" value="{{ $ppn[0]->ppn }}">
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Daftar RAB</h4>
                                                    </div>
                                                    <div class="row ml-2">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelNonPO">
                                                                <thead>
                                                                    <tr class="">
                                                                        <th>No.</th>
                                                                        <th>Uraian</th>
                                                                        <th>Satuan</th>
                                                                        <th>Volume</th>
                                                                        <th>Harga Satuan</th>
                                                                        <th>Jumlah</th>
                                                                        <th>Harga Perkiraan</th>
                                                                        <th>Jumlah Harga Perkiraan</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-kategori">
                                                                    @foreach ($rabnonpos as $rabnonpo)
                                                                    <tr>
                                                                        <td><strong id="nomor"
                                                                                value="1">{{$loop->iteration}}</strong>
                                                                        </td>
                                                                        <td><input type="text"
                                                                                class="form-control uraian" id="uraian[{{$loop->iteration}}]"
                                                                                name="uraian" placeholder="Uraian"
                                                                                value="{{ old('uraian', $rabnonpo->uraian) }}" required disabled></td>
                                                                        <td><input type="text"
                                                                                class="form-control satuan" id="satuan[{{$loop->iteration}}]"
                                                                                name="satuan" placeholder="Satuan"
                                                                                value="{{ old('satuan', $rabnonpo->satuan) }}" required disabled></td>
                                                                        <td><input type="text"
                                                                                class="form-control volume" id="volume[{{$loop->iteration}}]"
                                                                                name="volume" placeholder="volume"
                                                                                value="{{ old('volume', $rabnonpo->volume) }}"
                                                                                onkeydown="return numbersonly(this, event);"
                                                                                onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                required disabled></td>
                                                                        <td><input type="text"
                                                                                class="form-control harga_satuan"
                                                                                id="harga_satuan[{{$loop->iteration}}]" name="harga_satuan"
                                                                                placeholder="Harga Satuan" value="@currency2($rabnonpo->harga_satuan)"
                                                                                onblur="hitung_harga(this)"
                                                                                onkeydown="return numbersonly(this, event);"
                                                                                onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                required disabled>
                                                                        </td>
                                                                        <td><input type="text"
                                                                                class="form-control harga" id="harga[{{$loop->iteration}}]"
                                                                                name="harga" placeholder="Jumlah"
                                                                                value="@currency2($rabnonpo->jumlah_harga)" disabled readonly required>
                                                                        </td>
                                                                        <td><input type="text"
                                                                                class="form-control harga_hpe"
                                                                                id="harga_hpe[{{$loop->iteration}}]" name="harga_hpe"
                                                                                placeholder="Harga Perkiraan" value=""
                                                                                onblur="hitung_harga_hpe(this)"
                                                                                onkeydown="return numbersonly(this, event);"
                                                                                onkeyup="javascript:tandaPemisahTitik(this);"
                                                                                required>
                                                                        </td>
                                                                        <td><input type="text"
                                                                                class="form-control jumlah_harga_hpe" id="jumlah_harga_hpe[{{$loop->iteration}}]"
                                                                                name="jumlah_harga_hpe" placeholder="Jumlah"
                                                                                value="" disabled readonly required>
                                                                        </td>
                                                                        <!-- <td><button onclick="deleteRow(this)"
                                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                                    class='fa fa-trash'></i></button></td> -->
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                            <!-- <div class="col-lg-12 mb-2">
                                                                <div
                                                                    class="position-relative justify-content-end float-left">
                                                                    <a type="button" id="tambah-pekerjaan"
                                                                        class="btn btn-primary position-relative justify-content-end"
                                                                        onclick="updateform()" required>Tambah</a>
                                                                </div>
                                                            </div> -->
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
                                                                        <th>Jumlah:</th>
                                                                        <th id="jumlah">Rp. @currency2($jumlah_harga)</th>
                                                                        <th>Jumlah HPE:</th>
                                                                        <th id="jumlah-hpe"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>PPN {{ $ppn[0]->ppn }}%:</th>
                                                                        <th id="pajak">Rp. @currency2($ppn_nonpo)</th>
                                                                        <th>PPN {{ $ppn[0]->ppn }}%:</th>
                                                                        <th id="pajak-hpe"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th>Total Harga:</th>
                                                                        <th id="total">Rp. @currency2($total_harga)</th>
                                                                        <th>Total Harga HPE:</th>
                                                                        <th id="total-hpe"></th>
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
                                @endforeach
                                <div id="preview_non_po" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <form id="form-3" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Preview Kontrak NON PO</h4>
                                                    </div>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 1: Informasi Umum</h5>
                                                        <table class="uprightTbl noborder" style="width:100%;"
                                                            id="rincian" cellspacing="0" cellpadding="0">
                                                            <tr class="noborder">
                                                                <td style="width:20%;">No. RPBJ
                                                                </td>
                                                                <td style="width:1%">:</td>
                                                                <td id="nomor_rpbj_3">
                                                                </td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. SKK</td>
                                                                <td>:</td>
                                                                <td id="no_skk_3"></td>
                                                            </tr>
                                                            <tr class="noborder">
                                                                <td>No. PRK</td>
                                                                <td>:</td>
                                                                <td id="no_prk_3"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <hr>
                                                    <div class="row ml-2 justify-content-start">
                                                        <h5 class="card-title">Step 2: Daftar RAB & HPE</h5>
                                                        <div class="col-xl-12 col-xxl-12">
                                                            <div class="table-responsive">
                                                                <div class="wrapword" id="firstTable">
                                                                    <table class="" width="100%" border="2"
                                                                        cellspacing="0" cellpadding="0">
                                                                        <thead>
                                                                            <tr class="warna">
                                                                                <td style="width:4%;" rowspan="2"
                                                                                    align="center" valign="middle">No</td>
                                                                                <td rowspan="2" align="center"
                                                                                    valign="middle">Uraian Pekerjaan</td>
                                                                                <td style="width:9%;" rowspan="2"
                                                                                    align="center" valign="middle">Satuan
                                                                                </td>
                                                                                <td style="width:9%;" rowspan="2"
                                                                                    align="center" valign="middle">Volume
                                                                                </td>
                                                                                <td style="width:25%;" colspan="2"
                                                                                    align="center" valign="middle">Harga
                                                                                </td>
                                                                                <td style="width:25%;" colspan="2"
                                                                                    align="center" valign="middle">Harga HPE
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="warna">
                                                                                <td style="width:12%;" align="center"
                                                                                    valign="middle">Satuan (RP)</td>
                                                                                <td style="width:15%;" align="center"
                                                                                    valign="middle">Jumlah (RP)</td>
                                                                                <td style="width:12%;" align="center"
                                                                                    valign="middle">Satuan HPE (RP)</td>
                                                                                <td style="width:15%;" align="center"
                                                                                    valign="middle">Jumlah HPE (RP)</td>
                                                                            </tr>
                                                                            <!-- <tr class="warna">
                                                                            </tr> -->
                                                                        </thead>
                                                                        <tbody id="uraian_rab">
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td rowspan="3" colspan="3"></td>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>Jumlah</b></td>
                                                                                <td id="td_jumlah"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                                <td colspan="1" align="center"
                                                                                valign="middle"><b>Jumlah HPE:</b></td>
                                                                                <td id="td_jumlah_hpe"
                                                                                style="font-weight: bold"
                                                                                align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>PPN 11%</b></td>
                                                                                <td id="td_ppn"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                                <td colspan="1" align="center"
                                                                                    valign="middle"><b>PPN 11%</b></td>
                                                                                <td id="td_ppn_hpe"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2" align="center"
                                                                                    valign="middle"><b>TOTAL</b></td>
                                                                                <td id="td_total"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                                </td>
                                                                                <td colspan="1" align="center"
                                                                                    valign="middle"><b>TOTAL HPE</b></td>
                                                                                <td id="td_total_hpe"
                                                                                    style="font-weight: bold"
                                                                                    align="right"></td>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="first1"></td>
                                                                                <td class="first2" rowspan="2"
                                                                                    colspan="5" id="terbilang"
                                                                                    style="font-weight: bold; font-style:italic;">
                                                                                </td>
                                                                            </tr>
                                                                        </tfoot>
                                                                        <!-- <tr>
                                                                                <td class="first1"></td>
                                                                            </tr> -->
                                                                    </table>
                                                                    {{-- <div>
                                                                        <button id="prevpdf">Previous</button>
                                                                        <button id="nextpdf">Next</button>
                                                                        &nbsp; &nbsp;
                                                                        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                                                                    </div>
                                                                    <canvas id="pdfViewer"></canvas> --}}
                                                                    {{-- <embed width="100%" height="600px" type="application/pdf" id="embedLink"/> --}}

                                                                    <!-- <object type="application/pdf" id="pdfViewer" type="">
                                                                            <embed id="pdfViewer2" width="100%" height="600px" >
                                                                        </object> -->

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row ml-2 justify-content-center">
                                                        <h5 class="card-title">Preview KAK </h5>
                                                        {{-- <div class="position-relative justify-content-end float-right sweetalert">
                                                            <button type="button" id="btnPrvw"
                                                                    class="btn btn-primary position-relative justify-content-end">Preview <i class="bi bi-eye"></i></button>
                                                        </div> --}}



                                                    </div>

                                                    <embed width="100%" height="650px" name="plugin" id="embedLink"
                                                        type="application/pdf" />


                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Order Placed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> X </button>
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

        <!-- Preview PDF -->
        <!-- <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script> -->
        {{-- <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script> --}}


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
            //  var srcContent;
            //         function readURL(input) {
            //             if (input.files && input.files[0]) {
            //                 var reader = new FileReader();
            //                 reader.onload = function (e) {
            //                     srcContent=  e.target.result;
            //                 }
            //                 reader.readAsDataURL(input.files[0]);
            //             }
            //         }
            //         $(document).ready(function () {
            //             $("#kak").change(function () {
            //                 if (this.files[0].name != "") {
            //                     readURL(this);
            //                 }
            //             });
            //             // $('#btnPrvw').click(function () {
            //             //     $('#embdLink').attr('src', srcContent);
            //             // });
            //             $('#embedLink').attr('src', srcContent);

            //         });

            $(document).ready(function() {
                var filename;
                $('#kak').change(function() {
                    if (this.files[0].name != "") {
                        filename = this.files[0]
                        $('#embedLink')[0].src = window.URL.createObjectURL(new Blob([filename], {
                            "type": "application/pdf"
                        }));
                    }
                });
                // $('#btnPrvw').click(function() {
                // });
            });

            const myModal = new bootstrap.Modal(document.getElementById('confirmModal'));

            // function onCancel() {
            //     // Reset wizard
            //     $('#smartwizard').smartWizard("reset");

            //     // Reset form
            //     document.getElementById("form-1").reset();
            //     document.getElementById("form-2").reset();
            //     document.getElementById("form-3").reset();
            //     // document.getElementById("form-4").reset();
            // }

            // function onConfirm() {
            //     let form = document.getElementById('form-3');
            //     if (form) {
            //         if (!form.checkValidity()) {
            //             form.classList.add('was-validated');
            //             $('#smartwizard').smartWizard("setState", [3], 'error');
            //             $("#smartwizard").smartWizard('fixHeight');
            //             return false;
            //         }

            //         $('#smartwizard').smartWizard("unsetState", [3], 'error');
            //         myModal.show();
            //     }
            // }

            // function closeModal() {
            //     // Reset wizard
            //     $('#smartwizard').smartWizard("reset");

            //     // Reset form
            //     document.getElementById("form-1").reset();
            //     document.getElementById("form-2").reset();
            //     document.getElementById("form-3").reset();
            //     // document.getElementById("form-4").reset();

            //     myModal.hide();
            // }

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
                    } else if (stepPosition === 'dua') {
                        var nomor_rpbj = $("#nomor_rpbj").val();
                        var skk_id = $("#skk_id option:selected").text();
                        var prk_id = $("#prk_id option:selected").text();

                        $("#nomor_rpbj_3").html(nomor_rpbj);
                        $("#no_skk_3").html(skk_id);
                        $("#no_prk_3").html(prk_id);

                        baris = [];
                        var banyak_data =document.querySelectorAll("#tbody-kategori tr");

                        for (var i = 0; i < banyak_data.length; i++) {
                            baris[i] = [
                                // $("#item_id[" + (i + 1) + "] option:selected").text(),
                                document.getElementById("uraian[" + (i + 1) + "]").value,
                                document.getElementById("satuan[" + (i + 1) + "]").value,
                                document.getElementById("volume[" + (i + 1) + "]").value,
                                document.getElementById("harga_satuan[" + (i + 1) + "]").value,
                                document.getElementById("harga[" + (i + 1) + "]").value,
                                document.getElementById("harga_hpe[" + (i + 1) + "]").value,
                                document.getElementById("jumlah_harga_hpe[" + (i + 1) + "]").value,
                            ]
                        }
                        console.log("baris", baris);

                        const result_rab_non_po = baris.filter(element => {
                            return element !== null;
                        })

                        console.log("result_rab_non_po", result_rab_non_po);

                        if (result_rab_non_po.length > 0) {
                            var html_rab = [""];
                            var tbody = document.getElementById("uraian_rab");
                            var array_length = result_rab_non_po.length;
                            for (var j = 0; j < array_length; j++) {
                                html_rab += ("<tr> <td class='first' align='center' valign='middle'>" + (j +
                                    1) + "</td> <td class='first' align='left' valign='middle'>" +
                                    result_rab_non_po[j][0] +
                                    "</td> <td class='first' align='center' valign='middle'>" +
                                    result_rab_non_po[j][1] +
                                    "</td> <td class='first' align='center' valign='middle'>" +
                                    result_rab_non_po[j][2] +
                                    "</td> <td class='first' align='right' valign='middle'>" +
                                    result_rab_non_po[j][3] +
                                    "</td> <td class='first' align='right' valign='middle'>" +
                                    result_rab_non_po[j][4] +
                                    "</td> <td class='first' align='right' valign='middle'>" +
                                    result_rab_non_po[j][5] +
                                    "</td> <td class='first' align='right' valign='middle'>" +
                                    result_rab_non_po[j][6] + "</td> </tr>")
                            }
                            console.log("html_rab", html_rab);
                            document.getElementById("uraian_rab").innerHTML =
                            "<tr> <td class='first' align='center' valign='middle'><td class='first' align='center' valign='middle'></td> <td class='first' align='center' valign='middle'></td> <td class='first' align='right' valign='middle'></td> <td class='first' align='right' valign='middle'></td> </tr>" +
                            html_rab;
                        }
                        document.getElementById("td_jumlah").innerHTML = document.getElementById("jumlah")
                            .innerHTML;
                        document.getElementById("td_jumlah_hpe").innerHTML = document.getElementById("jumlah-hpe")
                            .innerHTML;
                        document.getElementById("td_ppn").innerHTML = document.getElementById("pajak")
                        .innerHTML;
                        document.getElementById("td_ppn_hpe").innerHTML = document.getElementById("pajak-hpe")
                        .innerHTML;
                        document.getElementById("td_total").innerHTML = document.getElementById("total")
                            .innerHTML;
                        document.getElementById("td_total_hpe").innerHTML = document.getElementById("total-hpe")
                            .innerHTML;

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

                    if (stepPosition == 'dua') {
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
                        animation: 'slideSwing'
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
        function hitung_harga_hpe(c) {
            var row = c.parentNode.parentNode;
            var change = row.rowIndex;
            var banyak_data = document.querySelectorAll("#tbody-kategori tr");
            // tbody.querySelectorAll()
            var volume = document.getElementById("volume[" + change + "]").value;
            volume = volume.replace(/\./g, "");
            volume = parseInt(volume);
            var harga_perkiraan = document.getElementById("harga_hpe[" + change + "]").value;
            harga_perkiraan = harga_perkiraan.replace(/\./g, "");
            harga_perkiraan = parseInt(harga_perkiraan);

            var jumlah_harga_perkiraan = volume * harga_perkiraan;
            jumlah_harga_perkiraan = jumlah_harga_perkiraan.toString();
            jumlah_harga_perkiraan_2 = "";
            panjang = jumlah_harga_perkiraan.length;
            j = 0;
            for (i = panjang; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                    jumlah_harga_perkiraan_2 = jumlah_harga_perkiraan.substr(i - 1, 1) + "." + jumlah_harga_perkiraan_2;
                } else {
                    jumlah_harga_perkiraan_2 = jumlah_harga_perkiraan.substr(i - 1, 1) + jumlah_harga_perkiraan_2;
                }
            }
            document.getElementById("jumlah_harga_hpe[" + change + "]").value = jumlah_harga_perkiraan_2;

            var total_harga = [];

            for (var i = 0; i < banyak_data.length; i++) {
                total_harga[i] = document.getElementById("jumlah_harga_hpe[" + (i + 1) + "]").value;
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
            document.getElementById("jumlah-hpe").innerHTML = "Rp. " + total_harga_all_2;
            total_harga_all = parseInt(total_harga_all);
            var ppn_id = document.getElementById('ppn').value;
            ppn_id = parseFloat(ppn_id);
            var ppn = total_harga_all * ppn_id / 100;
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
            document.getElementById("pajak-hpe").innerHTML = "Rp. " + ppn_2;
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
            document.getElementById("total-hpe").innerHTML = "Rp. " + total_2;
        }

        function onSubmitData() {
            var token = $('#csrf').val();
            var non_po_id = $('#non_po_id').val();

            var harga_hpe = [];
            var jumlah_harga_hpe = [];

            var banyak_data = document.querySelectorAll("#tbody-kategori tr");

            var fd = new FormData();

            for (var i = 0; i < banyak_data.length; i++) {
                harga_hpe[i] = document.getElementById("harga_hpe[" + (i + 1) + "]").value;
                harga_hpe[i] = harga_hpe[i].replace(/\./g, "");
                harga_hpe[i] = parseInt(harga_hpe[i]);
                fd.append("harga_perkiraan[]", harga_hpe[i]);
                jumlah_harga_hpe[i] = document.getElementById("jumlah_harga_hpe[" + (i + 1) + "]").value;
                jumlah_harga_hpe[i] = jumlah_harga_hpe[i].replace(/\./g, "");
                jumlah_harga_hpe[i] = parseInt(jumlah_harga_hpe[i]);
                fd.append("jumlah_harga_perkiraan[]", jumlah_harga_hpe[i]);
            }
            // console.log(uraian);
            // console.log(satuan);
            // console.log(volume);
            // console.log(harga_satuan);
            // console.log(harga);

            const bef_ppn_total_harga = jumlah_harga_hpe.reduce((accumulator, currentvalue) => accumulator + currentvalue);
            var ppn_id = document.getElementById('ppn').value;
            ppn_id = parseFloat(ppn_id);
            var ppn = bef_ppn_total_harga * ppn_id / 100;
            ppn = Math.round(ppn);
            var total_harga = bef_ppn_total_harga + ppn;
            total_harga = Math.round(total_harga);

            // if (kak.length > 0) {
            fd.append("total_harga", total_harga);
            fd.append("non_po_id", non_po_id);
            // }

            swal({
                    title: "Apakah anda yakin?",
                    text: "Silakan cek kembali apabila data masih keliru",
                    icon: "warning",
                    buttons: true,
                })
                .then((willCreate) => {
                    if (willCreate) {
                        // var data = {
                        //     "_token": token,
                        //     "nomor_rpbj": nomor_rpbj,
                        //     "skk_id": skk_id,
                        //     "prk_id": prk_id,
                        //     "kak": kak[0],
                        //     "total_harga": total_harga,
                        //     "uraian": uraian,
                        //     "satuan": satuan,
                        //     "harga_satuan": harga_satuan,
                        //     "volume": volume,
                        //     "jumlah_harga": harga,
                        //     "click": click,
                        // }
                        console.log("fd",fd);
                        // console.log(data);

                        $.ajax({
                            url: "/simpan-non-po-hpe",
                            method: 'POST',
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                swal({
                                    title: "Data Ditambah",
                                    text: "Data Berhasil Ditambah",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                })
                                window.location.href = "/non-po-hpe";
                                //         .then((result) => {
                                //         });
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

        function prev4() {
            btn_next4 = document.getElementById('btnnext4');
            btn_next4.innerText = "Next";
            btn_next4.setAttribute("id", "btnnext3");
            btn_next4.setAttribute("onclick", "next3()");

            btn_prev4 = document.getElementById('btnprev4');
            btn_prev4.setAttribute("id", "btnprev3");
            btn_prev4.setAttribute("onclick", "prev3()");
        }

        function prev3() {
            btn_next3 = document.getElementById('btnnext3');
            btn_next3.setAttribute("id", "btnnext2");
            btn_next3.setAttribute("onclick", "next2()");

            btn_prev3 = document.getElementById('btnprev3');
            btn_prev3.setAttribute("id", "btnprev2");
            btn_prev3.setAttribute("onclick", "prev2()");
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
