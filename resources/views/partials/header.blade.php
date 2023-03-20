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
                        <img src="images/user/1.png" height="40" width="40" alt="">
                    </div>
                    <div>
                        <p class="mb-2">{{ Auth::user()->name }}</p>
                        <p class="mb-2">{{ Auth::user()->role_name}}</p>
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="/profil"><i class="icon-user"></i> <span>Profil</span></a>
                                </li>

                                <hr class="my-2">
                                <form id="formlogout" action="{{route('logout')}}" method="POST">
                                @csrf
                                <li><a href="javascript:;" onclick="document.getElementById('formlogout').submit();"><i class="icon-key"></i>Keluar</a></li>
                                </form>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>