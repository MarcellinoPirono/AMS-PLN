@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/skk">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $active1 }}</a></li>
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
                        <form name="valid_skk" id="valid_skk" action="#">
                            <input type="hidden" id="edit_id" value="{{ $skk->id }}">
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">No. SKK:</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default" placeholder="Nomor SKK"
                                        name="nomor_skk" id="nomor_skk" required autofocus
                                        value="{{ old('nomor_skk', $skk->nomor_skk) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">Uraian SKK:</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        name="uraian_skk" id="uraian_skk" required autofocus placeholder="Uraian SKK"
                                        value="{{ old('uraian_skk', $skk->uraian_skk) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">Pagu SKK (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        name="pagu_skk" id="pagu_skk" readonly disabled autofocus placeholder="Pagu SKK"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);"
                                        value="@currency2($skk->pagu_skk)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">SKK Terkontrak (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        name="skk_terkontrak" id="skk_terkontrak" autofocus readonly disabled placeholder="SKK Terkontrak"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);"
                                        value="@currency2($skk->skk_terkontrak)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">SKK Realisasi (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        name="skk_realisasi" id="skk_realisasi" required autofocus placeholder="SKK Realisasi"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);"
                                        value="@currency2($skk->skk_realisasi)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">SKK Terbayar (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        name="skk_terbayar" id="skk_terbayar" required autofocus placeholder="SKK Terbayar"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);"
                                        value="@currency2($skk->skk_terbayar)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-25 col-form-label">SKK Sisa (Rp) :</label>
                                <div class="col-sm-6">
                                    <input type="text"
                                        class="form-control input-default"
                                        name="skk_sisa" id="skk_sisa" autofocus readonly disabled placeholder="SKK Sisa"
                                        onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);"
                                        value="@currency2($skk->skk_sisa)">
                                </div>
                            </div>
                            <div class="position-relative justify-content-end float-right">
                                <button type="submit"
                                    class="btn btn-primary position-relative justify-content-end btnedit">Edit Data</button>
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
            return false;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#valid_skk').validate({
            rules:{
                nomor_skk: {
                    required: true,
                    remote: {
                        url: "/checkSKK",
                        type: "post",
                    }
                },
                uraian_skk: {
                    required: true
                },
                skk_realisasi: {
                    required: true
                },
                skk_terbayar: {
                    required: true
                }
            },
            messages: {
                nomor_skk: {
                    required: "Silakan Isi No SKK",
                    remote: "Nomor SKK Sudah Ada"
                },
                uraian_skk: {
                    required: "Silakan Isi Uraian SKK"
                },
                skk_realisasi: {
                    required: "Silakan Isi SKK Realisasi"
                },
                skk_terbayar: {
                    required: "Silakan Isi SKK Terbayar"
                }
            },
            submitHandler: function(form) {
                var id = $('#edit_id').val();
                var nomor_skk = $("#nomor_skk").val();
                var uraian_skk = $("#uraian_skk").val();
                var pagu_skk = $("#pagu_skk").val();
                pagu_skk = pagu_skk.replace(/\./g, "");
                pagu_skk = parseInt(pagu_skk);
                var skk_terkontrak = $("#skk_terkontrak").val();
                skk_terkontrak = skk_terkontrak.replace(/\./g, "");
                skk_terkontrak = parseInt(skk_terkontrak);
                var skk_realisasi = $("#skk_realisasi").val();
                skk_realisasi = skk_realisasi.replace(/\./g, "");
                skk_realisasi = parseInt(skk_realisasi);
                var skk_terbayar = $("#skk_terbayar").val();
                skk_terbayar = skk_terbayar.replace(/\./g, "");
                skk_terbayar = parseInt(skk_terbayar);
                var skk_sisa = $("#skk_sisa").val();
                skk_sisa = skk_sisa.replace(/\./g, "");
                skk_sisa = parseInt(skk_sisa);

                var data = {
                    "nomor_skk": nomor_skk,
                    "uraian_skk": uraian_skk,
                    "pagu_skk": pagu_skk,
                    "skk_terkontrak": skk_terkontrak,
                    "skk_realisasi": skk_realisasi,
                    "skk_terbayar": skk_terbayar,
                    "skk_sisa": skk_sisa,
                }

                $.ajax({
                    url: "{{ url('skk') }}" + '/' + id,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        swal({
                            title: "Data Diedit",
                            text: "Data Berhasil Diedit",
                            icon: "success",
                            timer: 2e3,
                            buttons: false
                        }).then((result) => {
                            window.location.href = "/skk";
                        });
                    }
                });
            }
        })
    });
</script>
<script>
    $(document).ready(function() {
        $('#pagu_skk').blur(function(){
            var pagu_skk = $(this).val();
            pagu_skk = pagu_skk.replace(/\./g, "");
            pagu_skk = parseInt(pagu_skk);
            var skk_terkontrak = $("#skk_terkontrak").val();
            skk_terkontrak = skk_terkontrak.replace(/\./g, "");
            skk_terkontrak = parseInt(skk_terkontrak);
            var skk_sisa = pagu_skk - skk_terkontrak;
            skk_sisa = skk_sisa.toString();
            skk_sisa_2 = "";
            panjang = skk_sisa.length;
            j = 0;
            for (i = panjang; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                    skk_sisa_2 = skk_sisa.substr(i - 1, 1) + "." + skk_sisa_2;
                } else {
                    skk_sisa_2 = skk_sisa.substr(i - 1, 1) + skk_sisa_2;
                }
            }

            $('#skk_sisa').val(skk_sisa_2);
        })
    });
</script>