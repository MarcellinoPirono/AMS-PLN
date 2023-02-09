@extends('layouts.main')

@section('content')
    <div class="row">
        @include('sweetalert::alert')
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-end mr-5 mt-5">
                    @if (auth()->user()->role === 'Supervisor' || auth()->user()->role === 'Admin' || auth()->user()->role === 'REN')
                        <a href="/po-khs/buat-po" type="button" class="btn btn-primary ml-3 mt-3">Buat Kontrak (PO) <i
                                class="bi bi-pencil-square"></i>
                        </a>
                    @endif
                </div>
                <div class="card-header position-relative justify-content-center float-right">
                    {{-- <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">Pilih SKK</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void()">Janurari</a>
                                        <a class="dropdown-item" href="javascript:void()">Februari</a>
                                    </div>
                                </div> --}}

                    <div class="col-xl-3 col-l-4 col-m-3 col-sm-2 mt-3">
                        <select id="filter-skk1" class="form-control filter">
                            <option value="">Pilih SKK</option>
                            @foreach ($skks as $skk)
                                <option value="{{ $skk->nomor_skk }}">{{ $skk->nomor_skk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-l-4 col-m-3 col-sm-2 mt-3">
                        <select id="filter-prk1" class="form-control filter">
                            <option value="">Pilih PRK</option>
                            @foreach ($prks as $prk)
                                <option value="{{ $prk->no_prk }}">{{ $prk->no_prk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2 mt-3">
                        <select id="filter-addendum-kontrak-induk" class="form-control filter">
                            <option value="">Pilih Nomor Kontrak Induk</option>
                            @foreach ($kontraks as $kontrak)
                                <option value="{{ $kontrak->nomor_kontraks->nomor_kontrak_induk }}">
                                    {{ $kontrak->nomor_kontraks->nomor_kontrak_induk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-2 col-l-4 col-m-3 col-sm-2 mt-3">
                        <select id="filter-status" class="form-control filter">
                            <option value="">Pilih Status</option>
                            <option value="=">Progress</option>
                            <option value="-">Disetujui</option>
                            <option value="+">Ditolak</option>
                            {{-- @foreach ($rabs as $rab)
                                <option value="{{ $rab->status}}">
                                    {{ $rab->status }}</option>
                            @endforeach --}}
                        </select>
                    </div>


                </div>
                <div id="" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md" id="ListTabelRab">
                            <thead>
                                <tr align="center" valign="middle">
                                    <th class="width80">No.</th>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                    {{-- <th>Date</th> --}}
                                    {{-- <th>Nomor Surat</th> --}}
                                    <th>No. PO</th>
                                    <th>Tanggal PO</th>
                                    <th>Total Harga</th>
                                    <th>No SKK</th>
                                    <th>No PRK</th>
                                    <th>Judul / Pekerjaan</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    {{-- <th>Vendor</th> --}}
                                    <th>Nomor Kontrak Induk</th>


                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($rabs as $rab)
                                    @if ($rab->nomor_kontraks->khs->isActive == True)
                                    <tr>
                                        <td align="center" valign="middle"><strong>{{ $loop->iteration }}</strong></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a class="btn light btn-success btn-xs1 sharp" href="download/{{ $rab->slug }}"><i
                                                    class="bi bi-download"></i></a>
                                                <a class="btn light btn-info btn-xs1 sharp ml-1"
                                                        href="preview-pdf-khs/{{ $rab->slug }}"><i
                                                            class="bi bi-eye"></i></a>
                                            </div>
                                        </td>
                                        @if ($rab->status == 'Progress')
                                            {{-- <td><span class="badge light badge-warning">{{ $rab->status }}</span></td> --}}
                                            <td align="center" valign="top" style="vertical-align: top"><span class="badge light badge-warning1">=</span></span></td>
                                        @elseif ($rab->status == 'Disetujui')
                                            {{-- <td><span class="badge light badge-success">{{ $rab->status }}</span></td> --}}
                                            <td align="center" valign="top" style="vertical-align: top"><span class="badge light badge-success1">-</span></span></td>
                                        @else
                                            {{-- <td><span class="badge light badge-danger">{{ $rab->status }}</span></td> --}}
                                            <td align="center" valign="top" style="vertical-align: top"><span class="badge light badge-danger1">+</span></td>
                                        @endif
                                        <td>{{ $rab->nomor_po }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rab->tanggal_po)->isoFormat('dddd, DD-MMMM-YYYY') }}
                                        </td>
                                        <td>@currency($rab->total_harga) </td>
                                        <td>{{ $rab->skks->nomor_skk }}</td>
                                        <td>{{ $rab->prks->no_prk }}</td>
                                        <td>{{ $rab->pekerjaan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rab->startdate)->isoFormat('dddd, DD-MMMM-YYYY') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($rab->enddate)->isoFormat('dddd, DD-MMMM-YYYY') }}
                                        </td>
                                        {{-- <td>{{ $rab->vendors->nama_vendor }}</td> --}}
                                        <td>{{ $rab->nomor_kontraks->nomor_kontrak_induk }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tbody id="Content" class="searchdata">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="color: #000; padding-left:45px;">
                    <span class="" style="padding-bottom: 30px">Keterangan : </span><br>
                    <span class="badge light badge-success1 mb-2 mt-2" style="vertical-align: middle">-</span> = Disetujui<br>
                    <span class="badge light badge-warning1 mb-2" style="vertical-align: middle">-</span> = On Progress<br>
                    <span class="badge light badge-danger1 mb-1" style="vertical-align: middle">-</span> = Ditolak<br>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script data-require="jquery@2.1.1" data-semver="2.1.1"
        src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="{{ asset('/') }}./asset/frontend/vendor/datatables/js/jquery.dataTables.min.js"></script>
    {{-- <script src="{{ asset('/') }}./asset/frontend/js/plugins-init/datatables.init.js"></script> --}}

    <script>
        var ListTabelRab = $('#ListTabelRab').DataTable({
            select: {
                style: 'multi'
            },
            createdRow: function(row, data, index) {
                $(row).addClass('selected')
            }

        });

        $('#filter-prk1').on("change", function(event) {
            var status = $('#filter-prk1').val();
            ListTabelRab.columns(7).search(status).draw();
        });

        $('#filter-skk1').on("change", function(event) {
            var status = $('#filter-skk1').val();
            ListTabelRab.columns(6).search(status).draw();
        });

        $('#filter-addendum-kontrak-induk').on("change", function(event) {
            var status = $('#filter-addendum-kontrak-induk').val();
            ListTabelRab.columns(11).search(status).draw();
        });

        $('#filter-status').on("change", function(event) {
            var status = $('#filter-status').val();
            ListTabelRab.columns(2).search(status).draw();
        });

        // $('#filter-addendum-kontrak-induk').on("change", function(event) {
        //     var categor = $('#filter-addendum-kontrak-induk').val();
        //     tableItem.columns(2).search(categor).draw();
        // });
    </script>
@endsection
