@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/kontrak-induk-khs">{{ $active }}</a></li>
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
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <select class="form-control input-default" id="khs_id" name="khs_id">
                                        <option value="0" selected disabled>Jenis KHS</option>
                                        @foreach ($khss as $khs)
                                            <option value="{{ $khs->id }}"
                                                data-namapekerjaan="{{ $khs->nama_pekerjaan }}">{{ $khs->jenis_khs }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control input-default" name="nama_pekerjaan"
                                        id="nama_pekerjaan" placeholder="Nama Pekerjaan" readonly disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    
                                    <input type="text"
                                        class="form-control input-default  @error('nomor_kontrak_induk') is-invalid @enderror"
                                        placeholder="Nomor Kontrak Induk" name="nomor_kontrak_induk"
                                        id="nomor_kontrak_induk" required autofocus>
                                    @error('nomor_kontrak_induk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>  
                                    @enderror
                                </div>
                            <div class="form-group col-md-6">
                                    {{-- <i class="bi bi-calendar2-minus"></i> --}}
                                    <input name="tanggal_kontrak_induk" id="tanggal_kontrak_induk" class="icon1 datepicker-default form-control @error('tanggal_addendum') is-invalid @enderror"
                                        placeholder="Tanggal Kontrak Induk" required >
                        
                                    @error('tanggal_kontrak_induk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <select class="form-control input-default" id="vendor_id" name="vendor_id">
                                        <option value="0" selected disabled>Nama Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="position-relative justify-content-end float-right">
                            <button type="submit" id="btntambah"
                                class="btn btn-primary position-relative justify-content-end">Tambah Data</button>
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
        $('#khs_id').on('change', function() {
            const selected = $(this).find('option:selected');
            const nama_pekerjaan = selected.data('namapekerjaan');
            $("#nama_pekerjaan").val(nama_pekerjaan);
        });

        
        $('#btntambah').on('click', function() {
            var token = $('#csrf').val();
            var khs_id = $("#khs_id").val();
            var nomor_kontrak_induk = $("#nomor_kontrak_induk").val();
            var tanggal_kontrak_induk = $("#tanggal_kontrak_induk").val();
            // var date = Date.parse(tanggal_kontrak_induk);
            var vendor_id = $("#vendor_id").val();
            var date = new Date(tanggal_kontrak_induk);
            var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 )).toISOString().split("T")[0];

            var data = {
                "_token": token,
                "khs_id": khs_id,
                "nomor_kontrak_induk": nomor_kontrak_induk,
                "tanggal_kontrak_induk": dateString,
                "vendor_id": vendor_id,
            }

            $.ajax({
                type: 'POST',
                url: "{{ url('kontrak-induk-khs') }}",
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
                            window.location.href = "/kontrak-induk-khs";
                        });
                }
            });
        });
    });


    
</script>
