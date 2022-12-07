@extends('layouts.main')
@section('content')

<div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/po-khs">Preview PO-KHS</a></li>
            <li class="breadcrumb-item active"><a  href=""> {{ $active }}</a></li>
        </ol>
</div>
<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body">
{{--                 
                <iframe src="{{ asset('storage/storage/file-pdf-khs/'.$filename.'.pdf') }}"  type="application/pdf" width="100%" height="600px"/> --}}
                <iframe src="{{ asset('storage/storage/file-pdf-khs/'.$filename.'.pdf') }}" type="application/pdf" width="100%" height="600px"frameborder="0"></iframe>
                
            </div>
            {{-- <iframe src="" frameborder="0">{{ $pdf }}</iframe> --}}
            {{-- <object data={{ $pdf }} type="application/pdf"></object> --}}
        </div>
    </div>
</div>
@endsection