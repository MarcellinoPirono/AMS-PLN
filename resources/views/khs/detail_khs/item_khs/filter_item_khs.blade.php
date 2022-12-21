<table id="example" class="table table-responsive-md">
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
    <tbody>
        @if ($items->count() === 0)
            <td colspan="7" align="center" class="text-danger" style="font-size: 1.2em">Data not found</td>
        @endif
        @foreach ($items as $item)
            <tr>
                <td><strong>{{ $loop->iteration }}</strong></td>
                <td>{{ $item->nama_item }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->khs->jenis_khs }}</td>
                <td>{{ $item->satuans->singkatan }}</td>
                <td>@currency($item->harga_satuan) </td>
                <td>

                    <div class="d-flex">
                        <a href="{{ route('item-khs.edit', ['jenis_khs' => $item->khs->jenis_khs, 'id' => $item->id]) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                class="fa fa-pencil"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $item->id }}"><i
                                class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                        {{--<!-- @include('layouts.deleteitem') -->--}}
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
