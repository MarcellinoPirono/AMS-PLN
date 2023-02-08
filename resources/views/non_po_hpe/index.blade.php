@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header position-relative justify-content-center float-right">
                    <div class="col-lg-6">
                        <select id="filter-skk1" class="form-control filter">
                            <option value="">Pilih SKK</option>
                            @foreach ($skks as $skk)
                                <option value="{{ $skk->nomor_skk }}">{{ $skk->nomor_skk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <select id="filter-prk1" class="form-control filter">
                            <option value="">Pilih PRK</option>
                            @foreach ($prks as $prk)
                                <option value="{{ $prk->no_prk }}">{{ $prk->no_prk }}</option>
                            @endforeach
                        </select>
                    </div>
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
                                                <a class="btn light btn-success btn-xs1 sharp" href="download-hpe/{{ $nonpo->slug }}"><i
                                                    class="bi bi-download"></i></a>
                                                <a class="btn light btn-info btn-xs1 sharp ml-1"
                                                        href="preview-hpe/{{ $nonpo->slug }}"><i
                                                            class="mt-1 bi bi-eye"></i></a>
                                            </div>
                                        </td>
                                        @if ($nonpo->status == 'Waiting List')
                                        <td align="center" valign="top" style="vertical-align: top"><span class="badge light badge-warning2">-</span></span></td>
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

                <div style="color: #000; padding-left:45px;">
                    <span class="" style="padding-bottom: 30px">Keterangan : </span><br>
                    <span class="badge light badge-warning2 mb-2">-</span> = Telah Dibuatkan HPE <i>(On Progress)</i><br>
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
        $('#filter-prk1').on("change", function(event) {
            var prk = $('#filter-prk1').val();
            ListTabelRab.columns(6).search(prk).draw();
        });

        $('#filter-skk1').on("change", function(event) {
            var skk = $('#filter-skk1').val();
            ListTabelRab.columns(5).search(skk).draw();
        });
    </script>
@endsection
