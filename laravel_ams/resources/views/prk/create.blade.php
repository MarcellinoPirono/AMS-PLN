@extends('layouts.main')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/prk">{{$active}}</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$active1}}</a></li>
    </ol>
</div>
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">No. SKK_PRK:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">No. PRK:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Uraian PRK:</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Pagu PRK:</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">PRK Terkontrak:</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">PRK Realisasi:</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">PRK Terbayar:</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-default">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">PRK Sisa:</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control input-default">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="position-relative justify-content-end float-right">
                                        <button type="submit" class="btn btn-primary position-relative justify-content-end">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
</div>
@endsection
