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
            <div class="card-header">
                <h4 class="card-title">Preview PO-KHS {{ $active }}</h4>
                <div class="position-relative justify-content-end float-right">
                    <a href="/po-khs/edit-po/{{ $slug }}" type="button" class="btn btn-warning  mr-auto ml-3 ">Edit PO-KHS <span class="btn-icon-right"><i class="fa fa-pencil"></i></span>
                    </a>
                </div>
            </div>
            <div class="card-body">
{{--
                <iframe src="{{ asset('storage/storage/file-pdf-khs/'.$filename.'.pdf') }}"  type="application/pdf" width="100%" height="600px"/> --}}
                <embed src="{{ asset('storage/storage/file-pdf-khs/tkdn/'.$filename.'.pdf') }}" type="application/pdf" width="100%" height="600px" />

            </div>
            {{-- <iframe src="" frameborder="0">{{ $pdf }}</iframe> --}}
            {{-- <object data={{ $pdf }} type="application/pdf"></object> --}}
        </div>
    </div>
</div>
@endsection
