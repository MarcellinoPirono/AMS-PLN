@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('item-khs/' . $jenis_khs . '') }}">{{ $active }}</a></li>
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
                        <form name="valid_item_khs" id="valid_item_khs" action="#">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="text-label">Jenis Kontrak :</label>
                                    <input type="text" class="form-control input-default" placeholder="Jenis Kontrak"
                                        name="khs_id" id="khs_id" readonly disabled required autofocus
                                        value="{{ old('khs_id', $jenis_khs) }}">
                                </div>
                                <div class="form-group col-lg-6 mb-2">
                                    <label class="text-label">Kategori :</label>                          
                                    <div class="form-group mt-lg-2">
                                        <label class="radio-inline">
                                            <input type="radio" name="kategori" class="kategori"                                               value="Jasa">Jasa &ensp; &ensp;
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="kategori" 
                                            class="kategori" value="Material">Material
                                        </label>
                                        <div id="radioerror"></div>                                        
                                    </div>                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Nama Item :</label>
                                    <input type="text" class="form-control input-default" placeholder="Nama Item"
                                        name="nama_item" id="nama_item" required autofocus value="{{ old('nama_item') }}">                                
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Satuan :</label>
                                    <select class="form-control input-default" id="satuan_id" name="satuan_id"> 
                                        <option value="0" selected disabled>Satuan</option>                                   
                                        @foreach ($satuans as $satuan)
                                        <option value="{{ $satuan->id }}">{{ $satuan->singkatan}}</option>
                                        @endforeach                                    
                                    </select>  
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text-label">Harga Satuan (Rp) :</label>
                                    <input onkeydown="return numbersonly(this, event);"
                                        onkeyup="javascript:tandaPemisahTitik(this);" type="text"
                                        class="form-control input-default validate2"
                                        placeholder="Harga Satuan" name="harga_satuan" id="harga_satuan" required autofocus>                                    
                                </div>
                            </div>
                            <button type="submit" id="btn_tambah" class="btn btn-primary position-relative">Tambah</button>
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
            //alert (e.keyCode);
            return false;
        }
    }            
</script>

<script>
    $(document).ready(function() {
        $('#valid_item_khs').validate({
            rules:{  
                khs_id:{
                    required:true
                },       
                kategori:{
                    required:true
                },       
                nama_item:{
                    required:true
                },
                satuan_id:{
                    required:true
                },
                harga_satuan:{
                    required:true
                }
            },
            messages:{ 
                khs_id:{
                    required: "Silakan Pilih Jenis KHS"
                },               
                kategori:{
                    required: "Silakan Pilih Kategori"
                },                
                nama_item:{
                    required: "Silakan Isi Nama Item"
                },
                satuan_id:{
                    required: "Silakan Pilih Satuan"
                },
                harga_satuan:{
                    required: "Silakan Isi Harga Satuan"
                }
            },
            
            errorPlacement: function(error, element) 
            {                
                if ( element.attr("name") == "kategori" ) 
                {
                    error.appendTo("#radioerror");
                }
                else 
                { // This is the default behavior 
                    error.insertAfter( element );
                }
            },
            
            submitHandler: function(form) {
                var token = $('#csrf').val();
                var khs_id = $("#khs_id").val();
                var kategori = $(".kategori:checked").val();
                var nama_item = $("#nama_item").val();
                var satuan_id = $("#satuan_id").val();
                var harga_satuan = $("#harga_satuan").val(); 
                harga_satuan = harga_satuan.replace(/\./g, ""); 
                harga_satuan = parseInt(harga_satuan);            

                var data = {
                    "_token": token,
                    "khs_id": khs_id,
                    "kategori": kategori,
                    "nama_item": nama_item,
                    "satuan_id": satuan_id,
                    "harga_satuan": harga_satuan,                      
                };
                $.ajax({
                    type: 'POST',
                    url: '{{ url('item-khs/' . $jenis_khs . '/create') }}',
                    data: data,
                    success: function(response) {
                        swal({
                                title: "Data Ditambah",
                                text: "Data Berhasil Ditambah",
                                icon: "success",
                                timer: 2e3,
                                buttons: false
                        }).then((result) => {
                            window.location.href = "{{ url('item-khs/' . $jenis_khs . '') }}";
                        });
                    }
                });
            } 
        });
    });
</script>
