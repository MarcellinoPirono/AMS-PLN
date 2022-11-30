@extends('layouts.main')
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/po-khs">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="">{{ $active1 }}</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-dua">
                    <div class="card-header">
                        <h4 class="card-title">Form step {{ $active }}</h4>
                    </div>
                    <div class="m-auto" style="width:97%;">
                        <div id="smartwizard" dir="rtl-" class="mt-4">
                            <ul class="nav nav-progress">
                                <li class="nav-item">
                                    <a class="nav-link" href="#kak">
                                        <div class="num">1</div>
                                        Upload Kerangka Acuan Kerja
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#daftar_rab">
                                        <span class="num">2</span>
                                        Daftar RAB
                                    </a>
                                </li>                                
                            </ul>
                            <div class="tab-content mt-3 tab-flex">
                                <div id="kak" class="tab-pane", role="tabpanel" aria-labelledby="step-1">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input KAK</label>                                                
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" />
                                                        <label class="custom-file-label">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input No.SKK</label>
                                                <select class="form-control input-default" id="skk_id" name="skk_id">
                                                    <option value="0" selected disabled>Pilih No. SKK</option>
                                                    @foreach ($skks as $skk)
                                                        <option value="{{ $skk->id }}">{{ $skk->nomor_skk }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Input No.PRK</label>
                                                <select class="form-control input-default" id="prk_id" name="prk_id">
                                                    <option value="0" selected disabled>Pilih PRK</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="daftar_rab" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <form id="form-2" class="row row-cols-1 ms-5 me-5 needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12">
                                                <div class="card">
                                                    <div class="card-header justify-content-center">
                                                        <h4 class="card-title">Daftar RAB</h4>
                                                    </div>
                                                    <div class="row ml-2">
                                                        <div class="table-responsive">
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelRAB">
                                                                <thead>
                                                                    <tr class="">
                                                                        <th>No.</th>
                                                                        <th>Pekerjaan</th>
                                                                        <th>Kategori Pekerjaan</th>
                                                                        <th>Satuan</th>
                                                                        <th>Volume</th>
                                                                        <th>Harga Satuan</th>
                                                                        <th>Jumlah</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbody-kategori">
                                                                   <tr>
                                                                        <td><strong id="nomor"
                                                                                value="1">1</strong></td>
                                                                        <td><select name="item_id" id="item_id[1]"
                                                                                class="form-control input-default"
                                                                                onchange="change_item(this)"
                                                                                required>
                                                                                <option value="" selected disabled required>Pilih Pekerjaan</option>
                                                                            </select></td>
                                                                        <td><input type="text" class="form-control kategory_id" id="kategory_id[1]" name="kategory_id" placeholder="Kategori" value="" disabled readonly required></td>
                                                                        <td><input type="text" class="form-control satuan" id="satuan[1]" name="satuan" placeholder="Satuan" value="" disabled readonly required></td>
                                                                        <td><input type="text" class="form-control volume" id="volume[1]" name="volume" placeholder="volume" value="" onblur="blur_volume(this)" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  required></td>
                                                                        <td><input type="text" class="form-control harga_satuan" id="harga_satuan[1]" name="harga_satuan" placeholder="Harga Satuan" value="" disabled readonly required></td>
                                                                        <td><input type="text" class="form-control harga" id="harga[1]" name="harga" placeholder="Jumlah" value="" disabled readonly required></td>
                                                                        <td><button onclick="deleteRow(this)" class="btn btn-danger shadow btn-xs sharp"><i class='fa fa-trash'></i></button></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="col-lg-12 mb-2">
                                                                <div
                                                                    class="position-relative justify-content-end float-left">
                                                                    <a type="button" id="tambah-pekerjaan"
                                                                        class="btn btn-primary position-relative justify-content-end"
                                                                        onclick="updateform()" required >Tambah</a>
                                                                </div>
                                                            </div>
                                                            <table class="table table-responsive-sm height-100"
                                                                id="tabelRAB1">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th style="width: 204.73px">Jumlah:</th>
                                                                        <th style="width: 204.73px" id="jumlah"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th style="width: 204.73px">PPN 11%:</th>
                                                                        <th style="width: 204.73px" id="pajak"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th style="width: 204.73px">Total Harga:</th>
                                                                        <th style="width: 204.73px" id="total"></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection