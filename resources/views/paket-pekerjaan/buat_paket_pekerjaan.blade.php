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
                        <input type="hidden" name="jenis_khs" id="jenis_khs" value="{{$jenis_khs}}">
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
                                                    <input onclick="checkall()" type="checkbox" class="custom-control-input input-default" id="checkAll" name="letter"  autofocus>
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
                                    <tbody >
                                    @foreach ($items as $item)
                                        <input type="hidden" name="loop_iterasi" id="loop_iterasi" value="{{$loop->iteration}}">
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox checkbox check-lg mr-3">
                                                    <input data-tagname={{ $loop->iteration }} type="checkbox" class="custom-control-input" id="checkBox2[{{$loop->iteration}}]" name="letter" value="{{ $item->id }}" required autofocus onclick="check(this)">
                                                    <label name="letter" class="custom-control-label" for="checkBox2[{{$loop->iteration}}]" value="{{$loop->iteration}}"></label>
                                                </div>
                                            </td>
                                            <td align="center"><strong>{{$loop->iteration}}</strong></td>
                                            <td>{{$item->kategori}}	</td>
                                            <td>{{$item->nama_item}}</td>
                                            <td><input data-tagname="{{ $item->id }}" onblur="blur_volume(this)" onkeypress="return numbersonly2(this, event);" onkeyup="format(this)" type="text" class="form-control volume_id" id="volume[{{ $item->id }}]" name="volume[{{ $item->id }}]" value="" required disabled autofocus placeholder="Volume"></td>
                                            <td align="center">{{$item->satuans->singkatan}}</td>
                                            <td><input type="text"
                                                class="form-control harga_satuan" id="harga_satuan[{{ $item->id }}]" name="harga_satuan"
                                                placeholder="Harga Satuan" value="@currency2($item->harga_satuan)"
                                                disabled readonly required></td>
                                            <td><input type="text"
                                                class="form-control harga" id="harga[{{$item->id}}]"
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

<script type="text/javascript">

var tabelTambahPaket = $('#tabelTambahPaket').DataTable({
    createdRow: function ( row, data, index ) {
       $(row).addClass('selected')
    },

    "scrollY":        "42vh",
    "scrollCollapse": true,
    "paging":         false
});

    // $(document).ready(function() {
    //     $('#valid_paket').validate({
    //         rules:{
    //             nama_paket:{
    //                 required: true
    //             },
    //             letter:{
    //                 required: true
    //             },
    //             volume:{
    //                 required: 'letter:checked'
    //             }
    //         },
    //         messages:{
    //             nama_paket:{
    //                 required: "Silakan Isi Nama Paket"
    //             },
    //             letter:{
    //                 required: "Silakan Pilih Minimal 1 Item"
    //             },
    //             volume:{
    //                 required: "Silakan Isi Volume"
    //             }
    //         },

    //         errorPlacement: function(error, element){
    //             if ( element.attr("name") == "letter" )
    //             {
    //                 error.appendTo("#checkboxerror");
    //             }
    //             else
    //             { // This is the default behavior
    //                 error.insertAfter( element );
    //             }
    //         },
    //         submitHandler: function(form) {
    //             var token = $('#csrf').val();
    //             // console.log(token);
    //             var nama_paket = $("#nama_paket").val();
    //             var item_id = $('input["type=checkbox"]:checked').map(function () {
    //                 return this.value;
    //             }).get();

    //             console.log(item_id);
    //             var data = {
    //                 "_token": token,
    //                 "nama_paket": nama_paket,
    //                 "item_id" : item_id
    //             };

    //             $.ajax({
    //                 type: 'POST',
    //                 url: '{{url('paket-pekerjaan/' . $jenis_khs . '/create')}}',
    //                 data: data,

    //                 success: function(response) {

    //                     swal({
    //                             title: "Data Ditambah",
    //                             text: "Data Berhasil Ditambah",
    //                             icon: "success",
    //                             timer: 2e3,
    //                             buttons: false
    //                         }).then((result) => {
    //                             window.location.href = "{{ url('paket-pekerjaan/' . $jenis_khs . '') }}";
    //                         });
    //                 }
    //             });
    //         }
    //     });
    // });



</script>
{{-- <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script> --}}
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
    var change = c.dataset.tagname;
    console.log(change);
    var volume = document.getElementById("volume[" + change + "]").value;
    if(volume.charAt(volume.length-1) == ",") {
        document.getElementById("volume[" + change + "]").value = volume + "0";
    }
    if(volume.charAt(0) == ",") {
        document.getElementById("volume[" + change + "]").value = "0" + volume;
    }

    volume = volume.replace(/\./g, "");
    volume = volume.replace(/\,/g, ".");
    volume = parseFloat(volume);
    var harga_satuan = document.getElementById("harga_satuan[" + change + "]").value;
    harga_satuan = harga_satuan.replace(/\./g, "");
    harga_satuan = parseInt(harga_satuan);
    var harga = volume * harga_satuan;
    harga = Math.round(harga);
    harga = harga.toString();
    harga = harga.replace(/\./g, "");
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

function checkall() {
    // $("input[name='volume']").attr("checked", this.checked);
    var total_item = document.getElementById("jumlah_item").value;
    if($("input[id=checkAll]").is(":checked")) {
        for(var i = 0; i < total_item; i++) {
            document.getElementById("volume["+(i+1)+"]").setAttribute('required', '')
            document.getElementById("volume["+(i+1)+"]").setAttribute('autofocus', '')
            document.getElementById("volume["+(i+1)+"]").removeAttribute('disabled')
        }
    } else {
        for(var i = 0; i < total_item; i++) {
            document.getElementById("volume["+(i+1)+"]").value = "";
            document.getElementById("harga["+(i+1)+"]").value = "";
            document.getElementById("volume["+(i+1)+"]").removeAttribute('required')
            document.getElementById("volume["+(i+1)+"]").removeAttribute('autofocus')
            document.getElementById("volume["+(i+1)+"]").setAttribute('disabled', '')
        }
    }
}

function check(ini) {
    if($("input[type=checkbox]").is(":checked")) {
        document.getElementById("volume["+ini.value+"]").setAttribute('required', '')
        document.getElementById("volume["+ini.value+"]").setAttribute('autofocus', '')
        document.getElementById("volume["+ini.value+"]").removeAttribute('disabled')
    } else {
        document.getElementById("volume["+ini.value+"]").value = "";
        document.getElementById("harga["+ini.value+"]").value = "";
        document.getElementById("volume["+ini.value+"]").removeAttribute('required')
        document.getElementById("volume["+ini.value+"]").removeAttribute('autofocus')
        document.getElementById("volume["+ini.value+"]").setAttribute('disabled', '')
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
            var nama_paket = $("#nama_paket").val();
            var jenis_khs = $("#jenis_khs").val();
            var item_id = $('input[type=checkbox]:checked').map(function () {
                return this.value;
            }).get();
            // console.log(item_id);

            var volume = [];
            var harga = []
            for(var i=0; i < item_id.length; i++){
                volume[i] = document.getElementById("volume["+item_id[i]+"]").value;
                volume[i] = volume[i].replace(/\./g, "");
                volume[i] = volume[i].replace(/\,/g, ".");
                volume[i] = parseFloat(volume[i]);
                harga[i] = document.getElementById("harga["+item_id[i]+"]").value;
                harga[i] = harga[i].replace(/\./g, "");;
            }

            // console.log(volume);
            // console.log(harga);
            var data = {
                "_token": token,
                "nama_paket": nama_paket,
                "item_id" : item_id,
                "khs_id" : jenis_khs,
                "volume" : volume,
                "jumlah_harga" : harga,
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
