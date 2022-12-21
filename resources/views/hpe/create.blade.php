@extends('layouts.main')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $active }}</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $active1 }}</a></li>
        </ol>
    </div>

    <!-- row -->
    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form step</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <ul class="nav nav-wizard">
                            <li><a class="nav-link" href="#wizard_Service">
                                    <span>1</span>
                                </a></li>
                            <li><a class="nav-link" href="#wizard_Item">
                                    <span>2</span>
                                </a></li>
                            <!-- <li><a class="nav-link" href="#wizard_Details">
                 <span>3</span>
                </a></li> -->
                        </ul>
                        <div class="tab-content">
                            <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                <div method="POST" action="/hpe" class="" enctype="multipart/form-data">
                                    <div class="basic-form">
                                    @csrf
                                    <div class="row">                                        
                                        <div class="col-lg-6 mb-2">
                                            <div class="form-group">
                                                <label class="text-label">Judul Pekerjaan</label>
                                                <select class="form-control input-default" id="rab_id" name="rab_id">
                                                    <option value="0" selected disabled>Pekerjaan</option>
                                                    @foreach ($rabs as $rab)
                                                        <option value="{{ $rab->id }}">{{ $rab->pekerjaan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div id="wizard_Item" class="tab-pane" role="tabpane2">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12">
                                        <div class="card">
                                            <div class="card-header justify-content-center">
                                                <h4 class="card-title">HPE</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-sm height-100" id="tabelRAB">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Uraian</th>
                                                                <th>Volume</th>
                                                                <th>Harga Perkiraan</th>
                                                                <th>Jumlah Harga Perkiraan</th>                                                        
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                                <td><strong>1</strong></td>
                                                                <td>bassang</td>                                                    
                                                                <td>5</td>                                                                
                                                                <td>
                                                                    <input type="text" placeholder="Input Harga Perkiraan"/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" placeholder="Input Jumlah Harga"/>
                                                                </td>
                                                            </tr>
                                                            <!-- @foreach($rabs as $rab)
                                                            <tr>
                                                                <td><strong>{{ $loop->iteration }}</strong></td>
                                                                <td>{{ $rabs->items->nama_items }}</td>                                                    
                                                                <td>{{ $rabs->volume }}</td>                                                                
                                                                <td>
                                                                    <input type="text" placeholder="Input Harga Perkiraan"/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" placeholder="Input Jumlah Harga"/>
                                                                </td>
                                                            </tr>
                                                            @endforeach -->
                                                        </tbody>                                                        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-12">
                                        <div class="card">
                                            <div class="card-header justify-content-center">
                                                <h4 class="card-title">Preview</h4>
                                            </div>
                                            <div class="card-body">
                                                <button data-toggle="modal" data-target="#previewModal">Preview</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
