@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/prk">{{ $active }}</a></li>
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
                        <form name="valid_prk" id="valid_prk" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">No. SKK_PRK:</label>
                                <div class="form-group col-md-6">
                                    <select class="form-control input-default" id="no_skk_prk" name="no_skk_prk">
                                        <option value="0" selected disabled>Pilih No SKK</option>
                                        @foreach ($skss as $skk)
                                            <option value="{{ $skk->id }}">{{ $skk->nomor_skk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">No. PRK:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control"
                                        name="no_prk" id="no_prk" placeholder="No PRK" required autofocus
                                        value="{{ old('no_prk') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">Uraian PRK:</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        placeholder="Uraian PRK" name="uraian_prk" id="uraian_prk" required autofocus
                                        value="{{ old('uraian_prk') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">Pagu PRK (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default input-default"
                                        placeholder="Pagu PRK" onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" value="{{ old('pagu_skk') }}"
                                        name="pagu_prk" id="pagu_prk" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">Terkontrak (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" value="0"
                                        placeholder="PRK Terkontrak" name="prk_terkontrak" id="prk_terkontrak" required
                                        autofocus value="{{ old('prk_terkontrak') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">Progress (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" value="0"
                                        placeholder="PRK Progress" name="prk_onprogress" id="prk_onprogress" required
                                        autofocus value="{{ old('prk_onprogress') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">PRK Realisasi (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" placeholder="PRK Realisasi"
                                        name="prk_realisasi" id="prk_realisasi" required autofocus
                                        value="{{ old('prk_realisasi') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">PRK Terbayar (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" placeholder="PRK Terbayar"
                                        name="prk_terbayar" id="prk_terbayar" required autofocus
                                        value="{{ old('prk_terbayar') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">PRK Sisa (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" value="0" placeholder="PRK Sisa"
                                        name="prk_sisa" id="prk_sisa" readonly disabled autofocus>
                                </div>
                            </div>
                            <div class="position-relative justify-content-end float-right">
                                <button type="submit"
                                    class="btn btn-primary position-relative justify-content-end">Tambah Data</button>
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
    $(document).ready(function() {
        $('#pagu_prk').blur(function(){
            var pagu_prk = $(this).val();
            pagu_prk = pagu_prk.replace(/\./g, "");
            pagu_prk = parseInt(pagu_prk);
            var prk_terkontrak = $("#prk_terkontrak").val();
            prk_terkontrak = prk_terkontrak.replace(/\./g, "");
            prk_terkontrak = parseInt(prk_terkontrak);
            var prk_onprogress = $("#prk_onprogress").val();
            prk_onprogress = prk_onprogress.replace(/\./g, "");
            prk_onprogress = parseInt(prk_onprogress);
            var prk_sisa = pagu_prk - (prk_terkontrak + prk_onprogress);
            prk_sisa = prk_sisa.toString();
            prk_sisa_2 = "";
            if(prk_sisa.charAt(0) == "-") {
                prk_sisa = prk_sisa.replace(/\-/g, "");
                panjang = prk_sisa.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + "." + prk_sisa_2;
                    } else {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + prk_sisa_2;
                    }
                }
                prk_sisa_2 = "-" + prk_sisa_2;
                $('#prk_sisa').val(prk_sisa_2);
            } else {
                panjang = prk_sisa.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + "." + prk_sisa_2;
                    } else {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + prk_sisa_2;
                    }
                }
                $('#prk_sisa').val(prk_sisa_2);
            }
        })

        $('#prk_terkontrak').blur(function(){
            var prk_terkontrak = $(this).val();
            prk_terkontrak = prk_terkontrak.replace(/\./g, "");
            prk_terkontrak = parseInt(prk_terkontrak);
            var pagu_prk = $("#pagu_prk").val();
            pagu_prk = pagu_prk.replace(/\./g, "");
            pagu_prk = parseInt(pagu_prk);
            var prk_onprogress = $("#prk_onprogress").val();
            prk_onprogress = prk_onprogress.replace(/\./g, "");
            prk_onprogress = parseInt(prk_onprogress);
            var prk_sisa = pagu_prk - (prk_terkontrak + prk_onprogress);
            prk_sisa = prk_sisa.toString();
            prk_sisa_2 = "";
            if(prk_sisa.charAt(0) == "-") {
                prk_sisa = prk_sisa.replace(/\-/g, "");
                panjang = prk_sisa.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + "." + prk_sisa_2;
                    } else {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + prk_sisa_2;
                    }
                }
                prk_sisa_2 = "-" + prk_sisa_2;
                $('#prk_sisa').val(prk_sisa_2);
            } else {
                panjang = prk_sisa.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + "." + prk_sisa_2;
                    } else {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + prk_sisa_2;
                    }
                }
                $('#prk_sisa').val(prk_sisa_2);
            }
        })

        $('#prk_onprogress').blur(function(){
            var prk_onprogress = $(this).val();
            prk_onprogress = prk_onprogress.replace(/\./g, "");
            prk_onprogress = parseInt(prk_onprogress);
            var prk_terkontrak = $("#prk_terkontrak").val();
            prk_terkontrak = prk_terkontrak.replace(/\./g, "");
            prk_terkontrak = parseInt(prk_terkontrak);
            var pagu_prk = $("#pagu_prk").val();
            pagu_prk = pagu_prk.replace(/\./g, "");
            pagu_prk = parseInt(pagu_prk);
            var prk_sisa = pagu_prk - (prk_terkontrak + prk_onprogress);
            prk_sisa = prk_sisa.toString();
            prk_sisa_2 = "";
            if(prk_sisa.charAt(0) == "-") {
                prk_sisa = prk_sisa.replace(/\-/g, "");
                panjang = prk_sisa.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + "." + prk_sisa_2;
                    } else {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + prk_sisa_2;
                    }
                }
                prk_sisa_2 = "-" + prk_sisa_2;
                $('#prk_sisa').val(prk_sisa_2);
            } else {
                panjang = prk_sisa.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + "." + prk_sisa_2;
                    } else {
                        prk_sisa_2 = prk_sisa.substr(i - 1, 1) + prk_sisa_2;
                    }
                }
                $('#prk_sisa').val(prk_sisa_2);
            }
        })

        $('#valid_prk').validate({
            rules: {
                no_skk_prk: {
                    required: true
                },
                no_prk: {
                    required: true,
                    remote: {
                        url: "/checkPRK",
                        type: "post",
                    }
                },
                uraian_prk: {
                    required: true
                },
                pagu_prk: {
                    required: true
                },
                prk_terkontrak: {
                    required: true
                },
                prk_realisasi: {
                    required: true
                },
                prk_terbayar: {
                    required: true
                }
            },
            messages: {
                no_skk_prk: {
                    required: "Silakan Pilih No SKK"
                },
                no_prk: {
                    required: "Silakan Isi No PRK",
                    remote: "Nomor PRK Sudah Ada"
                },
                uraian_prk: {
                    required: "Silakan Isi Uraian PRK"
                },
                pagu_prk: {
                    required: "Silakan Isi Pagu PRK"
                },
                prk_terkontrak: {
                    required: "Silakan Isi PRK Terkontrak"
                },
                prk_realisasi: {
                    required: "Silakan Isi PRK Realisasi"
                },
                prk_terbayar: {
                    required: "Silakan Isi PRK Terbayar"
                }
            },
            submitHandler: function(form) {
                var token = $('#csrf').val();
                var no_skk_prk = $("#no_skk_prk").val();
                var no_prk = $("#no_prk").val();
                var uraian_prk = $("#uraian_prk").val();
                var pagu_prk = $("#pagu_prk").val();
                pagu_prk = pagu_prk.replace(/\./g, "");
                pagu_prk = parseInt(pagu_prk);
                var prk_terkontrak = $("#prk_terkontrak").val();
                prk_terkontrak = prk_terkontrak.replace(/\./g, "");
                prk_terkontrak = parseInt(prk_terkontrak);
                var prk_onprogress = $("#prk_onprogress").val();
                prk_onprogress = prk_onprogress.replace(/\./g, "");
                prk_onprogress = parseInt(prk_onprogress);
                var prk_realisasi = $("#prk_realisasi").val();
                prk_realisasi = prk_realisasi.replace(/\./g, "");
                prk_realisasi = parseInt(prk_realisasi);
                var prk_terbayar = $("#prk_terbayar").val();
                prk_terbayar = prk_terbayar.replace(/\./g, "");
                prk_terbayar = parseInt(prk_terbayar);
                var prk_sisa = $("#prk_sisa").val();
                prk_sisa = prk_sisa.replace(/\./g, "");
                prk_sisa = parseInt(prk_sisa);

                var data = {
                    "_token": token,
                    "no_skk_prk": no_skk_prk,
                    "no_prk": no_prk,
                    "uraian_prk": uraian_prk,
                    "pagu_prk": pagu_prk,
                    "prk_terkontrak": prk_terkontrak,
                    "prk_progress": prk_onprogress,
                    "prk_realisasi": prk_realisasi,
                    "prk_terbayar": prk_terbayar,
                    "prk_sisa": prk_sisa,
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ url('prk') }}",
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
                                window.location.href = "/prk";
                            });
                    }
                });
            }
        })
    });
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
