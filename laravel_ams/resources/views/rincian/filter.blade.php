<table id="example" class="table table-responsive-md">
    <thead>
        <tr>
            <th class="width80">No.</th>
            <th>Rincian Item</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Harga(1)</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td><strong>{{ $loop->iteration }}</strong></td>
                <td>{{ $item->nama_item }}</td>
                <td>{{ $item->item_rincian_induks->nama_kontrak }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->harga_satuan }}</td>
                <td>

                    <div class="d-flex">
                        <a href="/rincian/{{ $item->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                class="fa fa-pencil"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $item->id }}"><i
                                class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                        @include('layouts.deleteitem')
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
