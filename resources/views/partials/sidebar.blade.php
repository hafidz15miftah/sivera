<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">MENU UTAMA</li>
            <li>
                <a href="/dashboard" aria-expanded="false">
                    <i class="icon-home menu-icon"></i><span class="nav-text">Beranda</span>
                </a>
            </li>
            @if(auth()->user()->role_id == 1)
            <li class="nav-label">FUNGSIONAL SISTEM</li>
            <li>
                <a href="/pengguna" aria-expanded="false">
                    <i class="icon-people menu-icon"></i><span class="nav-text">Daftar Pengguna</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role_id == 2)
            <li class="nav-label">FUNGSIONAL SISTEM</li>
            <li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-tag menu-icon"></i><span class="nav-text">Aset Barang</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/ruangan">Data Ruangan</a></li>
                    <li><a href="/barang">Daftar Barang</a></li>
                    <li><a href="/detail">Detail Barang dan Laporan</a></li>
                </ul>
            </li>
            <li>
                <a href="/lahan" aria-expanded="false">
                    <i class="icon-map menu-icon"></i><span class="nav-text">Aset Tanah / Lahan</span>
                </a>
            </li>
            @endif
            <li class="nav-label">PELAPORAN</li>
            <li>
                <a href="/pelaporan" aria-expanded="false">
                    <i class="icon-cursor menu-icon"></i><span class="nav-text">Daftar Laporan</span>
                </a>
            </li>
            <li class="nav-label">LAINNYA</li>
            <li>
                <a href="/sivera" aria-expanded="false">
                    <i class="icon-info menu-icon"></i><span class="nav-text">Tentang Sivera</span>
                </a>
            </li>
        </ul>
    </div>
</div>