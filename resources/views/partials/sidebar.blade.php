<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">MENU UTAMA</li>
            <li>
                <a href="/dashboard" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dasbor</span>
                </a>
            </li>
            @if(auth()->user()->role_id == 2)
            <li class="nav-label">FUNGSIONAL SISTEM</li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text">Tabel</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/barang">Daftar Barang</a></li>
                    <li><a href="/aset">Daftar Aset</a></li>
                </ul>
            </li>
            <li>
                <a href="widgets.html" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Widget</span>
                </a>
            </li>
            <li class="nav-label">LAINNYA</li>
            <li>
                <a href="/pengguna" aria-expanded="false">
                    <i class="icon-user menu-icon"></i><span class="nav-text">Pengguna</span>
                </a>
            </li>
            @endif
            <li>
                <a href="/bantuan" aria-expanded="false">
                    <i class="icon-question menu-icon"></i><span class="nav-text">Pusat Bantuan</span>
                </a>
            </li>
            <li>
                <a href="/sivera" aria-expanded="false">
                    <i class="icon-info menu-icon"></i><span class="nav-text">Tentang Sivera</span>
                </a>
            </li>
        </ul>
    </div>
</div>