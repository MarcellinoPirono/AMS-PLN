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
                <!-- <div class="tab-content mt-3 tab-flex">
                </div> -->
                <div id="informasi_umum" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                    <form name="valid_paket" id="valid_paket" action="#">
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <input type="hidden" name="jumlah_item" id="jumlah_item" value="{{count($items)}}">
                        <div class="row m-auto">
                            <div class="col-lg-6 mb-2">
                                <div class="form-group">
                                    <label for="first-name" class="form-label">Input Nama Paket</label>
                                    <input type="text" class="form-control input-default" id="nama_paket" name="nama_paket"
                                        value="{{ old('nama_paket') }}" placeholder="Nama Paket" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="text-label">Pilih Item Pekerjaan</label>
                            </div>
                            <div id="checkboxerror"></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tabelTambahPaket" class="display min-w850">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input onclick="checkall()" type="checkbox" class="custom-control-input input-default" id="checkAll" name="letter" required autofocus>
                                                    <label name="letter" class="custom-control-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th>No.</th>
                                            <th>Kategori</th>
                                            <th class="text-center">Uraian Pekerjaan</th>
                                            <th>Volume</th>
                                            <th class="text-center">Satuan</th>
                                            <th>Harga Satuan (Rp.)</th>
                                            <th>Harga (Rp.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox checkbox check-lg mr-3">
                                                    <input type="checkbox" class="custom-control-input" id="checkBox2[{{$loop->iteration}}]" name="letter" value="{{ $item->id }}" required autofocus onclick="check(this)">
                                                    <label name="letter" class="custom-control-label" for="checkBox2[{{$loop->iteration}}]" value="{{$item->id}}"></label>
                                                </div>
                                            </td>

                                            <td align="center"><strong>{{$loop->iteration}}</strong></td>
                                            <td>{{$item->kategori}}	</td>
                                            <td>{{$item->nama_item}}</td>
                                            <td><input onblur="blur_volume(this)" onkeypress="return numbersonly2(this, event);" onkeyup="format(this)" type="text" class="form-control volume_id" id="" name="" value="" disabled placeholder="Volume"></td>
                                            <td align="center">{{$item->satuans->singkatan}}</td>
                                            <td><input type="text"
                                                class="form-control harga_satuan" id="harga_satuan[{{ $loop->iteration }}]" name="harga_satuan"
                                                placeholder="Harga Satuan" value="@currency2($item->harga_satuan)"
                                                disabled readonly required></td>
                                            <td><input type="text"
                                                class="form-control harga" id="harga[{{$loop->iteration}}]"
                                                name="harga" placeholder="Harga"
                                                value="" disabled readonly required></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" id="btn_tambah" class="btn btn-primary position-relative">Submit Paket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>
@endsection

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>


<script type="text/javascript">
function format(input) {
    var nStr = input.value + '';
    nStr = nStr.replace(/\./g, "");
    x = nStr.split(',');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    input.value = x1 + x2;
}

function numbersonly2(ini, e) {

    var txt = String.fromCharCode(e.which);
    if(!txt.match(/[0-9.,]/)) {
        return false;
    } else {
        if (e.keyCode >= 48) {
            if (e.keyCode <= 57) {
                if (ini.value == "0") {
                    ini.value = ""
                }
            }
        }

    }
}

function blur_volume(c){
    var change = c.parentNode.parentNode.rowIndex;
    var volume = document.getElementById("volume[" + change + "]").value;
    console.log(volume);
    volume = volume.replace(/\./g, "");
    volume = parseFloat(volume);
    console.log(volume);
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
}

function check(ini) {

    var jumlah_item = document.getElementById('jumlah_item').value;
    jumlah_item = parseInt(jumlah_item);


    for(var i = 0; i < jumlah_item; i++) {
        if(ini.value-1 == i) {
            var volume = document.getElementsByClassName("volume_id");
            if($("input[type=checkbox]").is(":checked")) {
                volume[i].id = "volume["+(i+1)+"]";
                volume[i].name = "volume["+(i+1)+"]";
                volume[i].setAttribute('required', '')
                volume[i].setAttribute('autofocus', '')
                volume[i].removeAttribute('disabled')
            } else {
                volume[i].id = "";
                volume[i].name = "";
                volume[i].removeAttribute('required')
                volume[i].removeAttribute('autofocus')
                volume[i].setAttribute('disabled', '')
            }
        }
    }
}
$(document).ready(function() {
    $('#valid_paket').validate({
        rules:{
            nama_paket:{
                required: true
            },
            letter:{
                required: true
            },
            volume:{
                required: 'letter:checked'
            }
        },
        messages:{
            nama_paket:{
                required: "Silakan Isi Nama Paket"
            },
            letter:{
                required: "Silakan Pilih Minimal 1 Item"
            },
            volume:{
                required: "Silakan Isi Volume"
            }
        },

        errorPlacement: function(error, element){
                if ( element.attr("name") == "letter" )
                {
                    error.appendTo("#checkboxerror");
                }
                else
                { // This is the default behavior
                    error.insertAfter( element );
                }
        },
        submitHandler: function(form) {
            var token = $('#csrf').val();
            console.log(token);
            var nama_paket = $("#nama_paket").val();
            console.log(nama_paket);
            var item_id = $('input[name="letter"]:checked').map(function(){
                                return this.value;
                            }).get();
            console.log(item_id);


            var data = {
                "_token": token,
                "nama_paket": nama_paket,
                "item_id" : item_id
            };

            $.ajax({
                type: 'POST',
                url: '{{url('paket-pekerjaan/' . $jenis_khs . '/create')}}',
                data: data,

                success: function(response) {

                    swal({
                            title: "Data Ditambah",
                            text: "Data Berhasil Ditambah",
                            icon: "success",
                            timer: 2e3,
                            buttons: false
                        }).then((result) => {
                            window.location.href = "{{ url('paket-pekerjaan/' . $jenis_khs . '') }}";
                        });
                }
            });
        }
    });
});
</script>
