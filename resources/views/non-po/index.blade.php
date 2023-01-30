\@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <!-- <div class="btn-group" role="group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih SKK</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void()">Janurari</a>
                        <a class="dropdown-item" href="javascript:void()">Februari</a>
                    </div>
                </div> -->
                <a href="/non-po/buat-non-po" type="button" class="btn btn-primary mr-auto ml-3 ">Buat Non-PO<span
                        class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                </a>
            </div>
            <div id="" class="card-body">
            <div class="table-responsive">
                    <table class="table table-responsive-md" id="tableNonPo">
                        <thead>
                            <tr align="center" valign="middle">
                                <th>Aksi</th>
                                <th class="width80">No.</th>
                                <th>Status</th>
                                <th>Nomor RPBJ</th>
                                <th>Pekerjaan</th>
                                <th>No. SKK</th>
                                <th>No. PRK</th>
                                <th>Supervisor</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="alldata">
                            @foreach ($nonpos as $nonpo)
                                <tr>
                                    <td align="center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-warning light sharp" data-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="preview-pdf-khs">Download KAK</a>
                                                <a class="dropdown-item" href="non-po/export-pdf-khs/{{$nonpo->id}}">Export (pdf) <i class="bi bi-file-earmark-pdf-fill"></i></a>
                                                <a class="dropdown-item" href="download-non-po/{{$nonpo->id}}">Download (pdf) <i class="bi bi-file-earmark-pdf-fill"></i></a>
                                                <a class="dropdown-item" href="export-excel-khs">Export (excel) <i class="bi bi-file-earmark-excel-fill"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td align="center" valign="middle"><strong>{{$loop->iteration}}</strong></td>
                                    @if ($nonpo->status == 1)
                                    <td><span class="badge light badge-warning">OnProcess (HPE)</span></td>
                                    @elseif ($nonpo->status == 2)
                                    <td><span class="badge light badge-warning">OnProcess (Persetujuan Manager)</span></td>
                                    @elseif ($nonpo->status == 3)
                                    <td><span class="badge light badge-success">Disetujui</span></td>
                                    @endif
                                    <td>{{$nonpo->nomor_rpbj}}</td>
                                    <td>{{ $nonpo->pekerjaan }}</td>
                                    <td>{{$nonpo->skks->nomor_skk}}</td>
                                    <td>{{$nonpo->prks->no_prk}}</td>
                                    <td>{{ $nonpo->supervisor }}</td>
                                    <td>@currency($nonpo->total_harga)</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tbody id="Content" class="searchdata">
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
    var tableNonPo = $('#tableNonPo').DataTable({
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

