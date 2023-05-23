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
                <a href="/pengguna" aria-expanded="false">
                    <i class="fa fa-users"></i><span class="nav-text">Pengguna</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 2)
            <li class="nav-label">BASIS DATA</li>
            <li>
                <a href="/ruangan" aria-expanded="false">
                    <i class="fa fa-database"></i><span class="nav-text">Data Ruangan</span>
                </a>
            </li>
            <li class="nav-label">FUNGSIONAL SISTEM</li>
            <li>
                <a href="/barang" aria-expanded="false">
                    <i class="fa fa-book"></i><span class="nav-text">Daftar Barang</span>
                </a>
            </li>
            <li>
                <a href="/tanah" aria-expanded="false">
                    <i class="fa fa-map"></i><span class="nav-text">Daftar Tanah / Lahan</span>
                </a>
            </li>
            <li class="nav-label">CETAK DATA</li>
            <li>
                <a href="/laporan-barang" aria-expanded="false">
                    <i class="fa fa-check-square"></i><span class="nav-text">Laporan Data Barang</span>
                </a>
            </li>
            @endif
            <li class="nav-label">PELAPORAN</li>
            <li>
                <a href="/pelaporan" aria-expanded="false">
                    <i class="fa fa-bullhorn"></i><span class="nav-text">Daftar Laporan</span>
                </a>
            </li>
            <li class="nav-label">LAINNYA</li>
            <li>
                <a href="/sivera" aria-expanded="false">
                    <i class="fa fa-info-circle"></i><span class="nav-text">Tentang Sivera</span>
                </a>
            </li>
        </ul>
    </div>
</div>