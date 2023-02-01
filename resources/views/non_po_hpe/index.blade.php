@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md" id="ListTabelNonPoHpe">
                            <thead>
                                <tr>
                                    <th class="width80">No.</th>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                    <th>Nomor RPBJ</th>
                                    <th>Pekerjaan</th>
                                    <th>No. SKK</th>
                                    <th>No. PRK</th>
                                    <th>Supervisor</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nonpos as $nonpo)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <input type="hidden" class="delete_id" value="{{ $nonpo->id }}">
                                        <td align="center">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-warning light sharp" data-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="non-po-hpe/{{$nonpo->id}}/buat-non-po-hpe">Buat HPE<i class="bi bi-file-earmark-pdf-fill"></i></a>
                                                    <a class="dropdown-item" href="non-po/export-pdf-khs/{{$nonpo->id}}">Download Non-PO <i class="bi bi-file-earmark-excel-fill"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        @if ($nonpo->status == "Progress")
                                        <td><span class="badge light badge-warning">OnProcess (HPE)</span></td>
                                        @elseif ($nonpo->status == "Waiting List")
                                        <td><span class="badge light badge-warning">OnProcess (Persetujuan Manager)</span></td>
                                        @elseif ($nonpo->status == "Disetujui")
                                        <td><span class="badge light badge-success">Disetujui</span></td>
                                        @elseif ($nonpo->status == "Ditolak")
                                        <td><span class="badge light badge-success">Ditolak</span></td>
                                        @endif
                                        <td>{{ $nonpo->nomor_rpbj }}</td>
                                        <td>{{ $nonpo->pekerjaan }}</td>
                                        <td>{{ $nonpo->skks->nomor_skk }}</td>
                                        <td>{{ $nonpo->prks->no_prk }}</td>
                                        <td>{{ $nonpo->supervisor }}</td>
                                        <td>@currency($nonpo->total_harga)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script>
    <script>
        var ListTabelNonPoHpe = $('#ListTabelNonPoHpe').DataTable({
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
@endsection
