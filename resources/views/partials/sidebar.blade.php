<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">MENU UTAMA</li>
            <li>
                <a href="/dashboard" aria-expanded="false">
                    <i class="fa fa-home"></i><span class="nav-text">Dasbor</span>
                </a>
            </li>
            @if(auth()->user()->role_id == 1)
            <li class="nav-label">FUNGSIONAL SISTEM</li>
            <li>
                <a href="/laporan" aria-expanded="false">
                    <i class="icon-check menu-icon"></i><span class="nav-text">Daftar Laporan</span>
                </a>
            </li>
            <li>
                <a href="/pengguna" aria-expanded="false">
                    <i class="icon-user menu-icon"></i><span class="nav-text">Pengguna</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 2)
            <li class="nav-label">FUNGSIONAL SISTEM</li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-institution"></i><span class="nav-text">Data Aset</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/tanah">Daftar Aset Tanah</a></li>
                    <li><a href="/kendaraan">Daftar Aset Kendaraan</a></li>
                    <li><a href="/elektronik">Daftar Aset Elektronik</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-check-square"></i><span class="nav-text">Data Barang</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/ruangan">Data Ruangan</a></li>
                    <li><a href="/barang">Daftar Barang di Ruangan</a></li>
                    <li><a href="/gudang">Daftar Barang di Gudang</a></li>
                </ul>
            </li>
            <li>
                <a href="/laporan" aria-expanded="false">
                    <i class="fa fa-bullhorn"></i><span class="nav-text">Daftar Laporan</span>
                </a>
            </li>
            @endif
            <li class="nav-label">LAINNYA</li>
            <li>
                <a href="/bantuan" aria-expanded="false">
                    <i class="fa fa-question-circle"></i><span class="nav-text">Unduh Manual Sivera</span>
                </a>
            </li>
            <li>
                <a href="/sivera" aria-expanded="false">
                    <i class="fa fa-info-circle"></i><span class="nav-text">Tentang Sivera</span>
                </a>
            </li>
        </ul>
    </div>
</div>