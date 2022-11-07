@extends('layouts.main')

@section('content')
<div class="row">
                <div class="col-xl-4 col-lg-12 col-xxl-4 col-sm-12">
                    <a href="/khs/create">
                           <div class="card avtivity-card">
                                <div class="card-body text-center ai-icon  text-primary">
                                   <img src="{{ asset('/') }}./asset/frontend/images/iconkontrak.svg" alt="",
                                                width="150" class="mb-2">
                                     <div class="media-body">
                                            <h4>
                                                <p class="fs-18">Buat Kontrak Harga Satuan (KHS)</p>
                                            </h4>
                                    </div>
                                    <a href="/khs/create" class="btn my-2 btn-secondary btn-lg px-4"> Buat Sekarang <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                </div>
                                <div class="effect bg-primary"></div>
                            </div>
                    </a>
                </div>

                <div class="col-xl-4 col-lg-12 col-xxl-4 col-sm-12">
                    <a href="/create-via-laksdan">
                        <div class="card avtivity-card">
                            <div class="card-body text-center ai-icon  text-primary">
                               <img src="{{ asset('/') }}./asset/frontend/images/iconkontrak.svg" alt="",
                                            width="150" class="mb-2">
                                            <div class="media-body">
                                            <h4>
                                                <p class="fs-18">Buat Kontrak VIA LAKSDAN </p>
                                            </h4>
                                            </div>
                                <a href="javascript:void(0);" class="btn my-2 btn-secondary btn-lg px-4"> Buat Sekarang <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="effect bg-primary"></div>
                        </div>
                    
                    </a>
                </div>

                <div class="col-xl-4 col-lg-12 col-xxl-4 col-sm-12">
                    <a href="/create-non-po">

                        <div class="card avtivity-card">
                                    <div class="card-body text-center ai-icon  text-primary">

                                            <img src="{{ asset('/') }}./asset/frontend/images/iconkontrak.svg" alt="",
                                            width="150" class="mb-2">
                                       <div class="media-body">
                                            <h4>
                                                <p class="fs-18">Buat Kontrak NON-PO </p>
                                            </h4>
                                        </div>
                                        <a href="javascript:void(0);" class="btn my-2 btn-secondary btn-lg">Create Now  <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                                    </div>
                                    <div class="effect bg-primary"></div>
                        </div>

                    </a>
                </div>
       
</div>
    
@endsection