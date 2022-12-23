@extends('layouts.main')

@section('content')
    <div class="row">
        @foreach ( $jenis_khs as $khs )
        <div class="col-xl-6 col-lg-12 col-xxl-6 col-sm-12">
            <a href="/klasifikasi-paket-pekerjaan/{{ $khs->jenis_khs }}">
                <div class="card avtivity-card">
                    <div class="card-body text-center ai-icon  text-primary">
                        <img src="{{ asset('/') }}./asset/frontend/images/iconbuat.svg" alt="" width="150"
                            class="mb-2">
                        <div class="media-body">
                            <h4>
                                <p class="fs-18">{{ $khs->jenis_khs }}</p>
                            </h4>
                        </div>
                        <a href="klasifikasi-paket-pekerjaan/{{ $khs->jenis_khs }}" class="btn my-2 btn-secondary btn-lg px-4"> Pilih <i class="fa fa-arrow-right"
                                aria-hidden="true"></i></a>
                    </div>
                    <div class="effect bg-primary"></div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection
