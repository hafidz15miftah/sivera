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
                    <i class="fa fa-check-square"></i><span class="nav-text">Data Aset</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/ruangan">Data Ruangan</a></li>
                    <li><a href="/barang">Daftar Barang</a></li>
                    <li><a href="/tanah">Daftar Aset Tanah/Lahan</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-bullhorn"></i><span class="nav-text">Daftar Laporan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/laporan">Laporan Ruangan</a></li>
                    <li><a href="/laporan-barang">Laporan Barang</a></li>
                    <li><a href="/tanah">Laporan Aset Tanah/Lahan</a></li>
                </ul>
            </li>
            @endif
            <li class="nav-label">VERIF LAPORAN</li>
                <li>
                    <a href="/pelaporan" aria-expanded="false">
                        <i class="fa fa-folder-open"></i><span class="nav-text">Pelaporan</span>
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
