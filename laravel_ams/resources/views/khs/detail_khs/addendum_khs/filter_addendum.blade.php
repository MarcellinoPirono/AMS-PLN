<table id="example" class="table table-responsive-md">
    <thead>
        <tr>
            <th class="width80">No.</th>
            <th>No. Kontrak Induk</th>
            <th>Jenis KHS</th>
            <th>Nama Pekerjaan</th>
            <th>No. Addendum</th>
            <th>Tanggal Addendum</th>                                              
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    {{--<!-- @if ($kontrakinduks->count() === 0)
            <td colspan="7" align="center" class="text-danger" style="font-size: 1.2em">Data not found</td>
        @endif -->--}}
        @foreach ($addendums as $addendum)
            <tr>
                <td><strong>{{ $loop->iteration }}</strong></td>
                <td>{{ $addendum->kontrak_induks->nomor_kontrak_induk }}</td>
                <td>{{ $addendum->kontrak_induks->khs->jenis_khs }}</td>
                <td>{{ $addendum->kontrak_induks->khs->nama_pekerjaan }}</td>
                <td>{{ $addendum->nomor_addendum }}</td>
                <td>{{ \Carbon\Carbon::parse($addendum->tanggal_addendum)->isoFormat('dddd, DD-MMMM-YYYY')}}</td>
                <td>
                    <div class="d-flex">
                        <a href="/addendum-khs/{{ $addendum->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                class="fa fa-pencil"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $addendum->id }}"><i
                                class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                                {{-- <!-- @include('layouts.deleteitem') --> --}}
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
