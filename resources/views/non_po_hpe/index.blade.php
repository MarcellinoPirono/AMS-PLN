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
                                    <th>Total HPE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nonpos as $nonpo)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <input type="hidden" class="delete_id" value="{{ $nonpo->id }}">
                                        <td align="center">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn light btn-success btn-xs1 sharp" href="download-test/{{ $nonpo->slug }}"><i
                                                    class="bi bi-download"></i></a>
                                                <a class="btn light btn-info btn-xs1 sharp ml-1"
                                                        href="preview-hpe/{{ $nonpo->slug }}"><i
                                                            class="mt-1 bi bi-eye"></i></a>
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
                                        <td>@currency($nonpo->total_harga_hpe)</td>
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
