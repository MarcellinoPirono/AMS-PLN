<table id="example" class="table table-responsive-md">
    <thead>
        <tr>
            <th class="width80">No.</th>
            <th>No.SKK_PRK</th>
            <th>No.PRK</th>
            <th>Uraian PRK</th>
            <th>Pagu PRK</th>
            <th>PRK Terkontrak</th>
            <th>PRK Realisasi</th>
            <th>PRK Terbayar</th>
            <th>PRK Sisa</th>                                               
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- @if ($kontrakinduks->count() === 0)
            <td colspan="7" align="center" class="text-danger" style="font-size: 1.2em">Data not found</td>
        @endif --}}
        @foreach ($prks as $prk)
            <tr>
                <td><strong>{{ $loop->iteration }}</strong></td>
                <td>{{ $prk->skks->nomor_skk }}</td>
                <td>{{ $prk->no_prk }}</td>
                <td>{{ $prk->uraian_prk }}</td>
                <td> @currency($prk->pagu_prk)</td>
                <td> @currency($prk->prk_terkontrak)</td>
                <td> @currency($prk->prk_realisasi)</td>
                <td> @currency($prk->prk_terbayar)</td>
                <td> @currency($prk->prk_sisa)</td>
                <td>
                    <div class="d-flex">
                        <a href="/prk/{{ $prk->id }}/edit" class="btn btn-primary shadow btn-xs sharp mr-1"><i
                                class="fa fa-pencil"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal{{ $prk->id }}"><i
                                class="btn btn-danger shadow btn-xs sharp fa fa-trash"></i></a>
                        {{-- <!-- @include('layouts.deleteitem') --> --}}
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- {{$kontrakinduks->links()}} --}}
