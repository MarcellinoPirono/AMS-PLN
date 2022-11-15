@extends('layouts.main')

@section('content')
    @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible alert-alt fade show">
            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                        class="mdi mdi-close"></i></span>
            </button>
            <strong>Success!</strong> {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-xl-4 col-l-4 col-m-3 col-sm-2">
                        <select id="filter-kategori" class="form-control filter">
                            <option value="">Pilih Kategori</option>                            
                            <option value="1">Material</option>
                            <option value="2">Jasa</option>                            
                        </select>
                    </div>
                    <a href="/item-khs/{{ $jenis_khs }}/create" class="btn btn-primary mr-auto ml-3">Tambah Item <span
                            class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                    </a>                       
                    <div class="input-group search-area position-relative">
                        <div class="input-group-append">
                            <span class="input-group-text"><a href="javascript:void(0)"><i
                                        class="flaticon-381-search-2"></i></a></span>
                            <input type="search" id="search" name="search" class="form-control"
                                placeholder="Search here..." />
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="sweetalert sweet-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive" id="read">
                        <table id="rincian-table" class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80">No.</th>
                                    <th>Rincian Item</th>
                                    <th>Kategori</th>
                                    <th>Jenis KHS</th>
                                    <th>Satuan</th>
                                    <th>Harga(1)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="alldata">
                                @foreach ($items as $item)
                                    <tr>
                                        <td><strong>{{ $loop->iteration }}</strong></td>
                                        <td>{{ $item->nama_item }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->khs->jenis_khs }}</td>
                                        <td>{{ $item->satuan }}</td>
                                        <td>@currency($item->harga_satuan) </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="/rincian/{{ $item->id }}/edit"
                                                    class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                                        class="fa fa-pencil"></i></a>
                                                <a href="#" data-toggle="modal"
                                                    data-target="#deleteModal{{ $item->id }}"><i
                                                        class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                                                @include('layouts.deleteitem')
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            </tbody>
                            <tbody id="Content" class="searchdata">

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{-- {{ $items->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    let item = $("#filter-kategori").val()

    // <script>
    // $(".filter").on('change',function(){
    //     item = $("#filter-kategori").val()
    // })
    //
</script>
<script>
    $(".filter").on('change', function() {
        let filter = this.value;
        $.ajax({
            url: `{{ url('/item-khs/filter') }}`,
            method: "POST",
            data: JSON.stringify({
                filter: filter
            }),
            headers: {
                'Accept': 'application/json',
                'content-Type': 'application/json'
            },
            success: function(data) {
                $('#read').html(data)
            }
        })
    });
</script>

<script type="text/javascript">
    $('#search').on('keyup', function() {
        $value = $(this).val();

        if ($value) {
            $('.alldata').hide();
            $('.searchdata').show();
        } else {
            $('.alldata').show();
            $('.searchdata').hide();

        }

        $.ajax({

            type: 'get',
            url: '{{ URL::to('search-rincian') }}',
            data: {
                'search': $value
            },

            success: function(data) {
                console.log(data);
                $('#Content').html(data);
            }

        });

    });
</script>
