@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih
                            Bulan</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void()">Janurari</a>
                            <a class="dropdown-item" href="javascript:void()">Februari</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md" id="tableHpe">
                            <thead>
                                <tr>
                                    <th class="width80">No.</th>
                                    <th>Nomor RPBJ</th>
                                    <th>Pekerjaan</th>
                                    <th>No. SKK</th>
                                    <th>No. PRK</th>
                                    <th>Supervisor</th>
                                    <th>Total Harga</th>
                                    <th>Total Harga HPE</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hpes as $hpe)
                                    <tr>
                                        <input type="hidden" class="edit_id" value="{{ $hpe->non_pos->id }}">
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $hpe->non_pos->nomor_rpbj }}</td>
                                        <td>{{ $hpe->non_pos->pekerjaan }}</td>
                                        <td>{{ $hpe->non_pos->skks->nomor_skk }}</td>
                                        <td>{{ $hpe->non_pos->prks->no_prk }}</td>
                                        <td>{{ $hpe->non_pos->supervisor }}</td>
                                        <td>@currency($hpe->non_pos->total_harga)</td>
                                        <td>@currency($hpe->total_harga_hpe)</td>
                                        @if ($hpe->non_pos->status == 1)
                                        <td><span class="badge light badge-warning">Proses HPE</span></td>
                                        @elseif ($hpe->non_pos->status == 2)
                                        <td><span class="badge light badge-warning">Sedang Menunggu Persetujuan Manager</span></td>
                                        @elseif ($hpe->non_pos->status == 3)
                                        <td><span class="badge light badge-success">Disetujui</span></td>
                                        @endif
                                        @if ($hpe->non_pos->status == 3)
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-warning light sharp" data-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="download-hpe/{{$hpe->id}}">Download HPE<i class="bi bi-file-earmark-pdf-fill"></i></a>
                                                    <button class="dropdown-item terimanonpo" disabled>Terima Non-PO<i class="bi bi-file-earmark-pdf-fill"></i></button>
                                                    <a class="dropdown-item" href="export-excel-khs">Export (excel) <i class="bi bi-file-earmark-excel-fill"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        @else
<td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-warning light sharp" data-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="download-hpe/{{$hpe->id}}">Download HPE<i class="bi bi-file-earmark-pdf-fill"></i></a>
                                                    <button class="dropdown-item terimanonpo">Terima Non-PO<i class="bi bi-file-earmark-pdf-fill"></i></button>
                                                    <a class="dropdown-item" href="export-excel-khs">Export (excel) <i class="bi bi-file-earmark-excel-fill"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>
<script>
    var tableHpe = $('#tableHpe').DataTable({
        select:  {
                style: 'multi'
        },
        createdRow: function(row, data, index) {
            $(row).addClass('selected')
        }

    });
    // $('#filter-kategori').on("change", function(event) {
    //     var categor = $('#filter-kategori').val();
    //     tableItem.columns(2).search(categor).draw();
    // });

    // $('#filter-addendum-kontrak-induk').on("change", function(event) {
    //     var categor = $('#filter-addendum-kontrak-induk').val();
    //     tableItem.columns(2).search(categor).draw();
    // });
</script>
<script>
    $('.terimanonpo').click(function(e) {
        e.preventDefault();

        var editid = $(this).closest("tr").find('.edit_id').val();

        swal({
                title: "Pengesahan Non-PO",
                // text: "Setelah disahkan, Anda tidak dapat memulihkan Data ini lagi!",
                text: "Terima NON-PO?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    var data = {
                        // "_token": $('input[name=_token]').val(),
                        'id': editid,
                    };
                    $.ajax({
                        type: "PUT",
                        url: 'pengesahan-hpe/' + editid,
                        data: data,
                        success: function(response) {
                            swal({
                                    title: "Pengesahan Non-PO",
                                    text: "Non-PO Berhasil Disahkan",
                                    icon: "success",
                                    timer: 2e3,
                                    buttons: false
                                })
                                .then((result) => {
                                    location.reload();
                                });
                        }
                    });
                } else {
                    swal({
                        title: "Pengesahan Non-PO",
                        text: "Non-PO Batal Diterima",
                        icon: "error",
                        timer: 2e3,
                        buttons: false
                    });
                }
            });
    });
</script>
@endsection
