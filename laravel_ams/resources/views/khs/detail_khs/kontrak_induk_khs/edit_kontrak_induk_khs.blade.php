@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/rincian">{{$active}}</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$active1}}</a></li>
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
                    <form method="POST" action="/rincian/{{$rincianinduk->id}}" class="" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('jenis_khs') is-invalid @enderror" placeholder="Jenis KHS" name="jenis_khs" id="jenis_khs" required autofocus value="{{ old('jenis_khs', $rincianinduk->jenis_khs) }}">
                                    @error('jenis_khs')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nomor_kontrak_induk') is-invalid @enderror" placeholder="Nomor Kontrak Induk" name="nomor_kontrak_induk" id="nomor_kontrak_induk" required autofocus value="{{ old('nomor_kontrak_induk', $rincianinduk->nomor_kontrak_induk) }}">
                                    @error('nomor_kontrak_induk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>                            
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('tanggal_kontrak_induk') is-invalid @enderror" placeholder="Tanggal Kontrak Induk" name="tanggal_kontrak_induk" id="tanggal_kontrak_induk" required autofocus value="{{ old('tanggal_kontrak_induk', $rincianinduk->tanggal_kontrak_induk)}}">
                                @error('tanggal_kontrak_induk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_vendor') is-invalid @enderror" placeholder="Nama Vendor" name="nama_vendor" id="nama_vendor" required autofocus value="{{old('nama_vendor', $rincianinduk->nama_vendor)}}">
                                    @error('nama_vendor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary position-relative">Edit Rincian</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    var rupiah = document.getElementById('harga_satuan')
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa? '.' : '';
            rupiah += separator + ribuan.join('.');


        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1]:rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah :'');
    }
    // $(document).ready(function (){
    //     $('#harga_satuan').inputmask()
    // });
</script>




