 <div class="deznav">
     <div class="deznav-scroll">
         <ul class="metismenu" id="menu">
             <li><a class="nav-link" href="/dashboard">
                     <i class="flaticon-381-networking"></i>
                     <span class="nav-text">Dashboard</span>
                 </a>
             </li>

             <h5>
                 <p class="fs-12 ml-3 mt-4 mb-1 text-black">Anggaran</p>
             </h5>
             <li>
                 <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="bi bi-cash-coin"></i>
                     <span class="nav-text">SKK/PRK </span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a class="nav-link {{ Request::is('spkk*') ? 'active' : '' }}"
                             href="/skk"><strong>SKK</strong></a>
                     </li>
                     <li><a class="nav-link {{ Request::is('prk*') ? 'active' : '' }}"
                             href="/prk"><strong>PRK</strong></a>
                     </li>
                 </ul>
             </li>

             <h5>
                 <p class="fs-12 ml-3 mt-4 mb-1 text-black">KHS</p>
             </h5>
             <li>
                 <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="bi bi-file-earmark-spreadsheet"></i>
                     <span class="nav-text">KHS</span>
                 </a>
                 <ul aria-expanded="false">
                     <li>
                         <a class="nav-link {{ Request::is('po-khs*') ? 'active' : '' }}" href="/po-khs">
                             <strong>Buat PO</strong>
                         </a>
                     </li>
                     {{-- <li>
                                <a class="nav-link {{ Request::is('detailkhs*') ? 'active' : '' }}" href="/detailkhs">
                                    Vendor KHS
                                </a>
                            </li> --}}
                     <li>
                         <a class="has-arrow ai-icon nav-link {{ Request::is('detailkhs*') ? 'active' : '' }}"
                             href="javascript:void()">
                             <strong>Detail KHS</strong>
                         </a>
                         <ul aria-expanded="false">
                             <!-- <li><a class="" href="/categories">Kategori</a></li> -->
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/jenis-khs">&ensp; &ensp; Jenis KHS</a></li>
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/vendor-khs">&ensp; &ensp; Vendor KHS</a></li>
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/menu-item-khs">&ensp; &ensp; Item KHS</a></li>
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/kontrak-induk-khs">&ensp; &ensp; Kontrak Induk KHS</a></li>
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/addendum-khs">&ensp; &ensp; Addendum KHS</a></li>
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/menu-paket-pekerjaan">&ensp; &ensp; Paket Pekerjaan </a></li>
                             {{-- <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/menu-klasifikasi-paket-pekerjaan">&ensp; &ensp; Klasifikasi Paket </a></li> --}}
                         </ul>
                     </li>
                 </ul>
             </li>

             <h5>
                 <p class="fs-12 ml-3 mt-4 mb-1 text-black">PO Non KHS</p>
             </h5>
             <li>
                 <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="bi bi-journal-text"></i>
                     <span class="nav-text">PO Non KHS</span>
                 </a>
                 <ul aria-expanded="false">
                     <li>
                         <a class="nav-link {{ Request::is('pokhs*') ? 'active' : '' }}" href="/pokhs">
                             <strong>Buat PO</strong>
                         </a>
                     </li>
                     <li>
                         <a class="has-arrow ai-icon nav-link {{ Request::is('detailkhs*') ? 'active' : '' }}"
                             href="javascript:void()">
                             <strong>Detail Non KHS</strong>
                         </a>
                         <ul aria-expanded="false">
                             <!-- <li><a class="" href="/categories">Kategori</a></li> -->
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/rincian">&ensp; &ensp;Vendor Non KHS</a></li>
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/rincian">&ensp; &ensp;Addendum Non KHS</a></li>
                         </ul>
                     </li>
                 </ul>
             </li>
             <h5>
                 <p class="fs-12 ml-3 mt-4 mb-1 text-black">Non PO</p>
             </h5>
             <li>
                 <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                     <i class="bi bi-journal-bookmark-fill"></i>
                     <span class="nav-text">Non PO</span>
                 </a>
                 <ul aria-expanded="false">
                     <li>
                         <a class="nav-link {{ Request::is('pokhs*') ? 'active' : '' }}" href="/non-po">
                             <strong>Buat KAK & RAB</strong>
                         </a>
                     </li>
                     <li>
                         <a class="nav-link {{ Request::is('pokhs*') ? 'active' : '' }}" href="/non-po-hpe">
                             <strong>Buat HPE</strong>
                         </a>
                     </li>
                     <li>
                         <a class="has-arrow ai-icon nav-link {{ Request::is('detailkhs*') ? 'active' : '' }}"
                             href="javascript:void()">
                             <strong>Detail Non PO</strong>
                         </a>
                         <ul aria-expanded="false">
                             <!-- <li><a class="" href="/categories">Kategori</a></li> -->
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/rincian">&ensp; &ensp;Vendor Non PO</a></li>
                             <li><a class="nav-link {{ $title === 'Kontrak Induk' ? 'active' : '' }}"
                                     href="/rincian">&ensp; &ensp;Addendum Non PO</a></li>
                         </ul>
                     </li>
                 </ul>
             </li>
             <h5>
                 <p class="fs-12 ml-3 mt-4 mb-1 text-black">Data Master</p>
             </h5>
             <li>

                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="bi bi-folder"></i>
                    <span class="nav-text">Data</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="nav-link {{ Request::is('pejabat*') ? 'active' : '' }}"
                            href="/pejabat"><strong>Data Pejabat</strong></a>
                    </li>
                    <li><a class="nav-link {{ Request::is('redaksi*') ? 'active' : '' }}"
                            href="/redaksi-khs"><strong>Data Redaksi</strong></a>
                    </li>
                    <li><a class="nav-link {{ Request::is('paket-pekerjaan*') ? 'active' : '' }}"
                            href="/menu-paket-pekerjaan"><strong>Data Paket Pekerjaan</strong></a>
                    </li>
                </ul>


             </li>



             {{-- <h5>
                        <p class="fs-12 ml-3 mt-4 mb-1 text-black"> Buat Kontrak (PO)</p>
                    </h5>
                    <li>
                        <a class="nav-link {{ Request::is('khs*') ? 'active' : '' }}" href="/po-khs"
                            aria-expanded="">
                            <i class="flaticon-381-notebook-2"></i>
                            <span class="nav-text">Buat Kontrak</span>
                        </a>
                    </li>
                    <h5>
                        <p class="fs-12 ml-3 mt-4 mb-1 text-black">Harga HPE</p>
                    </h5>
                    <li>
                        <a class="nav-link {{ Request::is('hpe*') ? 'active' : '' }}" href="/hpe"
                            aria-expanded="">
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            <span class="nav-text">HPE</span>
                        </a>
                    </li> --}}
         </ul>
         <div class="add-menu-sidebar" id="products">
             <img src="{{ asset('/') }}./asset/frontend/images/calendar.png" alt="" class="mr-2" />
             <p class="font-w500 mb-0" id="reload" name="reload">{{ date('D, d-M-Y H:i:s') }} </p>
         </div>
     </div>
 </div>


 <!-- <script>
     $(document).ready(function() {
         $('.nav-link').click(function(event) {
             // Avoid the link click from loading a new page
             event.preventDefault();
             // Load the content from the link's href attribute
             $('.container-fluid').load($(this).attr('href'));
         });
     });
 </script> -->
