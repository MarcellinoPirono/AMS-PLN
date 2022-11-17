<table id="example" class="table table-responsive-md">
    <thead>
        <tr>
            <th class="width80">No.</th>
            <th>Jenis KHS</th>
            <th>Nomor Kontrak Induk</th>
            <th>Tanggal Kontrak Induk</th>
            <th>Nama Vendor</th>                                                
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @if ($kontrakinduks->count() === 0)
            <td colspan="7" align="center" class="text-danger" style="font-size: 1.2em">Data not found</td>
        @endif
        @foreach ($kontrakinduks as $kontrakinduk)
            <tr>
                <td><strong>{{ $loop->iteration }}</strong></td>
                <td>{{ $kontrakinduk->khs->jenis_khs }}</td>
                <td>{{ $kontrakinduk->nomor_kontrak_induk }}</td>
                <td>{{ $kontrakinduk->tanggal_kontrak_induk }}</td>                                        
                <td>{{ $kontrakinduk->vendors->nama_vendor }}</td> 
                <td>
                    <div class="d-flex">
                        <a href="/kontrak-induk-khs/{{ $kontrakinduk->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                class="fa fa-pencil"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $item->id }}"><i
                                class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                        <!-- @include('layouts.deleteitem') -->
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
