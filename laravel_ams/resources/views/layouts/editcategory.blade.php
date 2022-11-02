<!-- Edit Kategori Pop Up -->
{{-- <form action="{{ "categories/".$kontrak['id'] }}" method="POST">
    @method('put') --}}
    {{-- @csrf --}}
    <div class="modal fade text-left" id="editModalCategories" tabindex="-1" role="dialog" aria-labelledby="editDataKiloan" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary1">
                    <h5 class="modal-title h3 mb-0 text-black-800 ml-3" id="editKategori">Edit Kategori</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form id="addform" action="{{ "categories/".$kontrak['id'] }}" method="post" enctype="multipart/form-data">
                        @csrf --}}
                        <input type="hidden" class="edit_id" value="{{ $kontrak->nama_kontrak }}">
                        <div class="form-group">
                            <input type="text" class="form-control input-rounded edit_data" placeholder="Nama Kategori" id="edit_kontrak" name="edit_kontrak" value="{{ old('edit_kontrak', $kontrak->nama_kontrak) }}">
                        </div>
                        <div class="position-relative justify-content-end float-right sweetalert">
                            <button type="button" class="btn btn-danger position-relative justify-content-end" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary position-relative justify-content-end btnedit">Ubah</button>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
{{-- </form> --}}
