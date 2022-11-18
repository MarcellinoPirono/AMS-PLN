@extends('layouts.main')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/vendor-khs">{{$active}}</a></li>
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
                     <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <input type="hidden" class="edit_id" id="edit_id" value="{{ $vendors->id }}">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_vendor') is-invalid @enderror" placeholder="Nama Vendor" name="nama_vendor" id="nama_vendor" required autofocus value="{{ old('nama_vendor', $vendors->nama_vendor) }}">
                                    @error('nama_vendor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_direktur') is-invalid @enderror" placeholder="Nama Direktur" name="nama_direktur" id="nama_direktur" required autofocus value="{{ old('nama_direktur', $vendors->nama_direktur) }}">
                                    @error('nama_direktur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('alamat_kantor_1') is-invalid @enderror" placeholder="Alamat Kantor 1" name="alamat_kantor_1" id="alamat_kantor_1" required autofocus value="{{ old('alamat_kantor_1', $vendors->alamat_kantor_1)}}">
                                @error('alamat_kantor_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('alamat_kantor_2') is-invalid @enderror" placeholder="Alamat Kantor 2" name="alamat_kantor_2" id="alamat_kantor_2" required autofocus value="{{ old('alamat_kantor_2', $vendors->alamat_kantor_2)}}">
                                @error('alamat_kantor_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('no_rek_1') is-invalid @enderror" placeholder="Nomor Rekening 1" name="no_rek_1" id="no_rek_1" required autofocus value="{{old('no_rek_1', $vendors->no_rek_1)}}">
                                    @error('no_rek_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_bank_1') is-invalid @enderror" placeholder="Nama Bank 1" name="nama_bank_1" id="nama_bank_1" required autofocus value="{{old('nama_bank_1', $vendors->nama_bank_1)}}">
                                    @error('nama_bank_1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('no_rek_2') is-invalid @enderror" placeholder="Nomor Rekening 2" name="no_rek_2" id="no_rek_2" required autofocus value="{{old('no_rek_2', $vendors->no_rek_2)}}">
                                    @error('no_rek_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('nama_bank_2') is-invalid @enderror" placeholder="Nama Bank 2" name="nama_bank_2" id="nama_bank_2" required autofocus value="{{old('nama_bank_2', $vendors->nama_bank_2)}}">
                                    @error('nama_bank_2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control input-default  @error('npwp') is-invalid @enderror" placeholder="NPWP" name="npwp" id="npwp" required autofocus value="{{old('npwp', $vendors->npwp)}}">
                                    @error('npwp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                         <div class="position-relative justify-content-end float-right">
                            <button type="submit" id="btnedit"
                                class="btn btn-primary position-relative justify-content-end">Edit Data</button>
                        </div>

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

        $('#btnedit').on('click', function() {
            var token = $('#csrf').val();
            var id = $('#edit_id').val();
            var nama_vendor = $("#nama_vendor").val();
            var nama_direktur = $("#nama_direktur").val();
            var alamat_kantor_1 = $("#alamat_kantor_1").val();
            var alamat_kantor_2 = $("#alamat_kantor_2").val();
            var no_rek_1 = $("#no_rek_1").val();
            var nama_bank_1 = $("#nama_bank_1").val();
            var no_rek_2 = $("#no_rek_2").val();
            var nama_bank_2 = $("#nama_bank_2").val();
            var npwp = $("#npwp").val();


            var data = {
                "_token": token,
                "nama_vendor": nama_vendor,
                "nama_direktur": nama_direktur,
                "alamat_kantor_1": alamat_kantor_1,
                "alamat_kantor_2": alamat_kantor_2,
                "no_rek_1": no_rek_1,
                "nama_bank_1": nama_bank_1,
                "no_rek_2": no_rek_2,
                "nama_bank_2": nama_bank_2,
                "npwp": npwp,
            }

            $.ajax({
                type: 'PUT',
                url: "{{ url('vendor-khs') }}" + '/' + id,
                data: data,
                success: function(response) {
                    swal({
                            title: "Data Vendor Diedit",
                            text: "Data Berhasil Diedit",
                            icon: "success",
                            timer: 2e3,
                            buttons: false
                        })
                        .then((result) => {
                            window.location.href = "/vendor-khs";
                        });
                }
            });
        });
    });
</script>








