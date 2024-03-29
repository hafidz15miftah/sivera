<div class="header">
    <div class="header-content clearfix">

        <!-- HAMBURGER SIDEBAR -->
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>

        <!-- PROFIL -->
        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <img src="images/user.png" height="100" width="100" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li class="text-center">
                                    <span>{{ Auth::user()->name }}</span>
                                </li>
                                <li class="text-center">
                                    <span>
                                        @if (Auth::user()->role_id == 1)
                                        Sekretaris Desa
                                        @elseif (Auth::user()->role_id == 2)
                                        Kepala Urusan Umum dan Perencanaan
                                        @elseif (Auth::user()->role_id == 3)
                                        Kepala Desa
                                        @elseif (Auth::user()->role_id == 4)
                                        Staf
                                        @elseif (Auth::user()->role_id == 5)
                                        Administrator
                                        @else
                                        Role Tidak Diketahui
                                        @endif
                                    </span>
                                </li>
                                <hr class="my-2">
                                <li>
                                    <a href="/profil"><i class="icon-user"></i> <span>Profil Pengguna</span></a>
                                </li>

                                <hr class="my-2">
                                <li>
                                    <a href="javascript(0);" data-toggle="modal" data-target="#modalLogout"><i class="icon-power"></i> <span>Keluar</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Logout -->
<div class="modal fade" id="modalLogout">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Keluar</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda yakin akan keluar dari SIVERA?</div>
            <div class="modal-footer">
                <button type="button" style="color:white" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="formlogout" action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formlogout').submit();">Keluar Akun</button>
                </form>
            </div>
        </div>
    </div>
</div>