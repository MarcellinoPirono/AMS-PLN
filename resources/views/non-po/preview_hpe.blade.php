@extends('layouts.main')
@section('content')

    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/non-po-hpe">Preview HPE</a></li>
            <li class="breadcrumb-item active"><a href=""> {{ $active }}</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">

                <div class="card-body">
                @if (auth()->user()->role === 'Manager' || auth()->user()->role === 'Admin')
                    @if ($rabs->status === 'Waiting List')
                        <div class="col-md-12 d-flex justify-content-end mt-5 mb-3">
                            <input type="hidden" value="{{ $slug }}" id="slug_rab" name="slug_rab">
                            <a href="/edit-hpe/{{$rabs->slug}}" value="Disetujui" class="btn btn-info">Edit HPE <i
                                    class="bi bi-pencil-square"></i> </a>
                        </div>
                    @endif
                @endif

                @if ($rabs->status === 'Progress')
                <embed src="{{ asset('storage/storage/file-pdf-khs/non-po/' . $filename . '.pdf') }}"
                    type="application/pdf" width="100%" height="600px" />
                @elseif ($rabs->status === 'Ditolak')
                <embed src="{{ asset('storage/storage/file-pdf-khs/non-po/hpe/' . $filename . '-HPE_ditolak.pdf') }}"
                    type="application/pdf" width="100%" height="600px" />
                @elseif ($rabs->status === 'Waiting List')
                <embed src="{{ asset('storage/storage/file-pdf-khs/non-po/hpe/' . $filename . '-HPE_onprogress.pdf') }}"
                    type="application/pdf" width="100%" height="600px" />
                @else
                <embed src="{{ asset('storage/storage/file-pdf-khs/non-po/hpe/' . $filename . '.pdf') }}"
                    type="application/pdf" width="100%" height="600px" />

                @endif

                    @if (auth()->user()->role === 'Manager' || auth()->user()->role === 'Admin')
                        @if ($rabs->status != 'Disetujui' && $rabs->status != 'Ditolak')
                            <div class="col-md-12 d-flex justify-content-end mt-5 mb-3">

                                <input type="hidden" value="{{ $slug }}" id="slug_rab" name="slug_rab">
                                <button value="Disetujui" class="btn btn-success" onclick="setuju(this)"><i
                                        class="bi bi-check-circle"></i> Disetujui</button>
                                <button value="Ditolak" class="btn btn-danger ml-3" onclick="setuju(this)"><i
                                        class="bi bi-x-circle"></i> Ditolak</button>

                            </div>
                        @endif
                    @endif

                </div>
                {{-- <iframe src="" frameborder="0">{{ $pdf }}</iframe> --}}
                {{-- <object data={{ $pdf }} type="application/pdf"></object> --}}
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script data-require="jquery@2.1.1" data-semver="2.1.1"
        src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        // $("#terima").validate({
        //     submitHandler: function(form) {
        //         var terima = document.getElementById("")
        //     }
        // })
        function setuju(ini) {
            // ini.preventDefault();
            var terima = ini.value;
            var slug = $("#slug_rab").val();
            var data = {
                'terima': terima,
                'slug': slug
            };

            if (terima == "Disetujui") {
                swal({
                        title: "Apakah anda yakin?",
                        text: "Setelah Surat disetujui, Anda tidak dapat menolak Non-PO ini lagi!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willCreate) => {
                        if (willCreate) {
                            $.ajax({
                                type: 'POST',
                                url: '/konfirmasi-non-po',
                                data: data,
                                success: function(response) {
                                    swal({
                                            title: "Non-PO Disetujui",
                                            text: "Non-PO Telah Disetujui",
                                            icon: "success",
                                            timer: 2e3,
                                            buttons: false
                                        })
                                        .then((result) => {
                                            window.location.href = "/non-po";
                                        });
                                }
                            });
                        } else {
                            swal({
                                title: "Surat Belum Disetujui",
                                text: "Silakan Perhatikan Surat Lagi Sebelum Disetujui",
                                icon: "error",
                                timer: 2e3,
                                buttons: false
                            });
                        }
                    });
            } else {
                swal({
                        title: "Apakah anda yakin?",
                        text: "Setelah Non-PO ditolak, Anda tidak dapat menyetujui Non-PO ini lagi!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willCreate) => {
                        if (willCreate) {
                            $.ajax({
                                type: 'POST',
                                url: '/konfirmasi-non-po',
                                data: data,
                                success: function(response) {
                                    swal({
                                            title: "Non-PO Ditolak",
                                            text: "Non-PO Telah Ditolak",
                                            icon: "error",
                                            timer: 2e3,
                                            buttons: false
                                        })
                                        .then((result) => {
                                            window.location.href = "/non-po";
                                        });
                                }
                            });
                        } else {
                            swal({
                                title: "Surat Belum Ditolak",
                                text: "Silakan Perhatikan Surat Lagi Sebelum Ditolak",
                                icon: "error",
                                timer: 2e3,
                                buttons: false
                            });
                        }
                    });
            }
        }
    </script>
@endsection
