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
                                <input type="text" class="form-control input-default  @error('nama_item') is-invalid @enderror" placeholder="Nama Item" name="nama_item" id="nama_item" required autofocus value="{{ old('nama_item', $rincianinduk->nama_item) }}">
                                    @error('nama_item')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('kategori_id') is-invalid @enderror" placeholder="Nama Kategori" name="kategori_id" id="kategori_id" required autofocus value="{{ old('kategori_id', $rincianinduk->item_rincian_induks->nama_kategori) }}">
                                    @error('kategori_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="form-group col-md-6">
                                <select class="form-control custom-select input-default" name="kategori_id" id="kategori_id" name="kategori_id">
                                    <option value="0" disabled>Pilih ...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if($rincianinduk->kategori_id == $category->id) selected
                                            @endif>{{$category->nama_kategori}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('satuan') is-invalid @enderror" placeholder="Satuan" name="satuan" id="satuan" required autofocus value="{{ old('satuan', $rincianinduk->satuan)}}">
                                @error('satuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('harga_satuan') is-invalid @enderror" placeholder="Harga Satuan" name="harga_satuan" id="harga_satuan" required autofocus value="{{old('harga_satuan', $rincianinduk->harga_satuan)}}">
                                    @error('harga_satuan')
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





