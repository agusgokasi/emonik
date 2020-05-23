<!-- Sidebar -->
<ul class="sidebar navbar-nav">

    <li class="nav-item {{ request()->is('home') ? 'active' : '' }} {{ request()->is('/') ? 'active' : '' }}">
        <a href="{{ url('home') }}" class="nav-link">
          <small><i class="fas fa-fw fa-tachometer-alt"></i><span><small>&nbsp;Dashboard&nbsp;</small></span></small>
        </a>
    </li>
    @if(Auth::user()->permissionsGroup->permission_status)
    <li class="nav-item dropdown {{ (request()->is('permissions')) ? 'active' : '' }} {{ (request()->is('users')) ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <small><i class="fas fa-fw fa-users-cog"></i>
            <span><small>&nbsp;Users & Permission&nbsp;</small></span></small>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <small><a class="dropdown-item {{ (request()->is('users')) ? 'active' : '' }}" href="{{ url('users') }}">User</a>
            <a class="dropdown-item {{ (request()->is('permissions')) ? 'active' : '' }}" href="{{ url('permissions') }}">Permission</a></small>
        </div>
    </li>
    @endif
    @if(Auth::user()->permissionsGroup->unit_status)
    <li class="nav-item dropdown {{ (request()->is('units')) ? 'active' : '' }} {{ (request()->is('fakultas')) ? 'active' : '' }} {{ (request()->is('prodis')) ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <small><i class="fas fa-fw fa-university"></i>
            <span><small>&nbsp;Unit&nbsp;</small></span></small>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <small><a class="dropdown-item {{ (request()->is('units')) ? 'active' : '' }}" href="{{ url('units') }}">Unit</a>
            <a class="dropdown-item {{ (request()->is('fakultas')) ? 'active' : '' }}" href="{{ url('fakultas') }}">Fakultas</a>
            <a class="dropdown-item {{ (request()->is('prodis')) ? 'active' : '' }}" href="{{ url('prodis') }}">Prodi</a></small>
        </div>
    </li>
    @endif
    @if(Auth::user()->permissionsGroup->kategori_status)
    <li class="nav-item {{ request()->is('kategori') ? 'active' : '' }}">
        <a href="{{ url('kategori') }}" class="nav-link">
          <small><i class="fas fa-fw fa-code-branch"></i><span><small>&nbsp;Kategori&nbsp;</small></span></small>
        </a>
    </li>
    @endif
    @if(Auth::user()->permissionsGroup->kegiatan_status)
    <li class="nav-item {{ request()->is('kegiatan') ? 'active' : '' }}">
        <a href="{{ url('kegiatan') }}" class="nav-link">
          <small><i class="fas fa-fw fa-tasks"></i><span><small>&nbsp;Kegiatan&nbsp;</small></span></small>
        </a>
    </li>
    @endif
    @if(Auth::user()->permissionsGroup->exception_status)
    <li class="nav-item {{ request()->is('exception') ? 'active' : '' }}">
        <a href="{{ url('exception') }}" class="nav-link">
          <small><i class="fas fa-fw fa-unlock-alt"></i><span><small>&nbsp;Buka Permohonan User&nbsp;</small></span></small>
        </a>
    </li>
    @endif
    @if(Auth::user()->permissionsGroup->permohonan_status)
    <li class="nav-item {{ request()->is('kategoripermohonan') ? 'active' : '' }}">
        <a href="{{ url('kategoripermohonan') }}" class="nav-link">
          <small><i class="fas fa-fw fa-list"></i><span><small>&nbsp;Kategori Permohonan&nbsp;</small></span></small>
        </a>
    </li>
    <li class="nav-item {{ request()->is('permohonan') ? 'active' : '' }}">
        <a href="{{ url('permohonan') }}" class="nav-link">
          <small><i class="fas fa-fw fa-book-open"></i><span><small>&nbsp;Management Permohonan&nbsp;</small></span></small>
        </a>
    </li>
    <li class="nav-item {{ request()->is('spj') ? 'active' : '' }}">
        <a href="{{ url('spj') }}" class="nav-link">
          <small><i class="fa fa-fw fa-book"></i><span><small>&nbsp;Management SPJ&nbsp;</small></span></small>
        </a>
    </li>
    @endif
    @if(Auth::user()->permissionsGroup->dispo1p_status||Auth::user()->permissionsGroup->dispo2p_status||Auth::user()->permissionsGroup->dispo3p_status||Auth::user()->permissionsGroup->dispo4p_status)
    <li class="nav-item dropdown {{ (request()->is('dis1')) ? 'active' : '' }} {{ (request()->is('dis2')) ? 'active' : '' }} {{ (request()->is('dis3')) ? 'active' : '' }} {{ (request()->is('dis4')) ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <small><i class="fas fa-fw fa-book-open"></i>
            <span><small>&nbsp;Disposisi Permohonan</small></span></small>
            @if(Auth::user()->permissionsGroup->dispo1p_status)
                @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitPermohonan")->count() != 0)
                    <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitPermohonan")->count() }}</span>
                @endif
            @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <small>
                @if(Auth::user()->permissionsGroup->dispo1p_status)
                    <a class="dropdown-item {{ (request()->is('dis1')) ? 'active' : '' }}" href="{{ url('dis1') }}">Disposisi 1&nbsp;
                    @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitPermohonan")->count() != 0)
                    <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitPermohonan")->count() }}</span>
                    @endif
                    </a>
                @endif
                @if(Auth::user()->permissionsGroup->dispo2p_status)
                    <a class="dropdown-item {{ (request()->is('dis2')) ? 'active' : '' }}" href="{{ url('dis2') }}">Disposisi 2</a>
                @endif
                @if(Auth::user()->permissionsGroup->dispo3p_status)
                    <a class="dropdown-item {{ (request()->is('dis3')) ? 'active' : '' }}" href="{{ url('dis3') }}">Disposisi 3</a>
                @endif
                @if(Auth::user()->permissionsGroup->dispo4p_status)
                    <a class="dropdown-item {{ (request()->is('dis4')) ? 'active' : '' }}" href="{{ url('dis4') }}">Disposisi 4</a>
                @endif
            </small>
        </div>
    </li>
    @endif

    @if(Auth::user()->permissionsGroup->dispo1s_status||Auth::user()->permissionsGroup->dispo2s_status)
    <li class="nav-item dropdown {{ (request()->is('dis5')) ? 'active' : '' }} {{ (request()->is('dis6')) ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <small><i class="fa fa-fw fa-book"></i>
            <span><small>&nbsp;Disposisi SPJ&nbsp;</small></span></small>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <small>
                @if(Auth::user()->permissionsGroup->dispo1s_status)
                    <a class="dropdown-item {{ (request()->is('dis5')) ? 'active' : '' }}" href="{{ url('dis5') }}">Disposisi 1</a>
                @endif
                @if(Auth::user()->permissionsGroup->dispo2s_status)
                    <a class="dropdown-item {{ (request()->is('dis6')) ? 'active' : '' }}" href="{{ url('dis6') }}">Disposisi 2</a>
                @endif
            </small>
        </div>
    </li>
    @endif

    <li class="nav-item {{ request()->is('histori') ? 'active' : '' }}">
        <a href="{{ url('histori') }}" class="nav-link">
          <small><i class="fas fa-fw fa-history"></i><span><small>&nbsp;History Permohonan&nbsp;</small></span></small>
        </a>
    </li>
    
</ul>