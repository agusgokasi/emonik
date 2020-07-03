<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{ request()->is('home') ? 'active' : '' }} {{ request()->is('/') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

{{-- User --}}
@if(Auth::user()->permissionsGroup->permission_status)

<hr class="sidebar-divider">

<div class="sidebar-heading">
    Users
</div>


<li class="nav-item {{ (request()->is('permissions')) ? 'active' : '' }} {{ (request()->is('users')) ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-users-cog"></i>
        <span>Users & Permission</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ (request()->is('users')) ? 'active' : '' }}" href="{{ url('users') }}">User</a>
            <a class="collapse-item {{ (request()->is('permissions')) ? 'active' : '' }}" href="{{ url('permissions') }}">Permission</a>
        </div>
    </div>
</li>
@endif

@if(Auth::user()->permissionsGroup->exception_status)
<li class="nav-item {{ request()->is('exception') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('exception') }}">
        <i class="fas fa-fw fa-unlock-alt"></i>
        <span>Buka Akses</span>
    </a>
</li>
@endif

{{-- ! User --}}


{{-- menu --}}

@if (Auth::user()->permissionsGroup->unit_status || Auth::user()->permissionsGroup->kategori_status || Auth::user()->permissionsGroup->kegiatan_status)
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu
    </div>
@endif

@if(Auth::user()->permissionsGroup->unit_status)

<li class="nav-item {{ (request()->is('units')) ? 'active' : '' }} {{ (request()->is('fakultas')) ? 'active' : '' }} {{ (request()->is('prodis')) ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo_1" aria-expanded="true" aria-controls="collapseTwo_1">
        <i class="fas fa-fw fa-university"></i>
        <span>Unit</span>
    </a>
    <div id="collapseTwo_1" class="collapse" aria-labelledby="headingTwo_1" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ (request()->is('units')) ? 'active' : '' }}" href="{{ url('units') }}">Unit</a>
            <a class="collapse-item {{ (request()->is('fakultas')) ? 'active' : '' }}" href="{{ url('fakultas') }}">Fakultas</a>
            <a class="collapse-item {{ (request()->is('prodis')) ? 'active' : '' }}" href="{{ url('prodis') }}">Prodi</a>
        </div>
    </div>
</li>
@endif

@if(Auth::user()->permissionsGroup->kategori_status)
<li class="nav-item {{ request()->is('kategori') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('kategori') }}">
        <i class="fas fa-fw fa-code-branch"></i>
        <span>Kategori</span>
    </a>
</li>
@endif

@if(Auth::user()->permissionsGroup->kegiatan_status)
<li class="nav-item {{ request()->is('kegiatan') ? 'active' : '' }}">
    <a class="nav-link" href="{{ url('kegiatan') }}">
        <i class="fas fa-fw fa-tasks"></i>
        <span>Kegiatan</span>
    </a>
</li>
@endif

{{-- ! menu --}}



{{-- Permohonan --}}
@if(Auth::user()->permissionsGroup->permohonan_status)

<hr class="sidebar-divider">

<div class="sidebar-heading">
    Manajemen Permohonan
</div>

<li class="nav-item {{ request()->is('kategoripermohonan') ? 'active' : '' }}">
    <a href="{{ url('kategoripermohonan') }}" class="nav-link">
      <i class="fas fa-fw fa-list"></i>
      <span>Kategori</span>
    </a>
</li>

<li class="nav-item {{ request()->is('permohonan') ? 'active' : '' }}">
    <a href="{{ url('permohonan') }}" class="nav-link">
        <i class="fas fa-fw fa-book-open"></i>
        <span>Permohonan</span>
        @php
        $tolak1 = auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dt2Permohonan")->count();
        $tolak2 = auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dt3Permohonan")->count();
        $acc = auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dp3Permohonan")->count();
        $badge_count = $tolak1+$tolak2+$acc;
        if ($badge_count != 0){
          echo '<span class="badge badge-pill badge-danger">' . $badge_count . '</span>';
        }
        @endphp
    </a>
</li>
<li class="nav-item {{ request()->is('spj') ? 'active' : '' }}">
    <a href="{{ url('spj') }}" class="nav-link">
        <i class="fa fa-fw fa-book"></i>
        <span>SPJ</span>
        @php
        $spj = auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis4Permohonan")->count();
        $reject1 = auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dt1SPJ")->count();
        $reject2 = auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dt2SPJ")->count();
        $badge_count = $spj+$reject1+$reject2;
        if ($badge_count != 0){
          echo '<span class="badge badge-pill badge-danger">' . $badge_count . '</span>';
        }
        @endphp
    </a>
</li>
@endif
{{-- ! Permohonan --}}


{{-- Disposisi --}}
@if(Auth::user()->permissionsGroup->dispo1p_status||Auth::user()->permissionsGroup->dispo2p_status||Auth::user()->permissionsGroup->dispo3p_status||Auth::user()->permissionsGroup->dispo4p_status)
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Disposisi
</div>
<li class="nav-item {{ (request()->is('dis1')) ? 'active' : '' }} {{ (request()->is('dis2')) ? 'active' : '' }} {{ (request()->is('dis3')) ? 'active' : '' }} {{ (request()->is('dis4')) ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo_2" aria-expanded="true" aria-controls="collapseTwo_2">
        <i class="fas fa-fw fa-book-open"></i>

        <span>Permohonan</span>
        @if(Auth::user()->permissionsGroup->dispo1p_status)
            @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitPermohonan")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitPermohonan")->count() }}</span>
            @endif
        @elseif(Auth::user()->permissionsGroup->dispo2p_status)
            @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis1Permohonan")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis1Permohonan")->count() }}</span>
            @endif
        @elseif(Auth::user()->permissionsGroup->dispo3p_status)
            @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis2Permohonan")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis2Permohonan")->count() }}</span>
            @endif
        @elseif(Auth::user()->permissionsGroup->dispo4p_status)
            @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis3Permohonan")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis3Permohonan")->count() }}</span>
            @endif
        @endif
    </a>

    <div id="collapseTwo_2" class="collapse" aria-labelledby="headingTwo_2" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @if(Auth::user()->permissionsGroup->dispo1p_status)
                <a class="collapse-item {{ (request()->is('dis1')) ? 'active' : '' }}" href="{{ url('dis1') }}">Disposisi 1
                @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitPermohonan")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitPermohonan")->count() }}</span>
                @endif
                </a>
            @endif
            @if(Auth::user()->permissionsGroup->dispo2p_status)
                <a class="collapse-item {{ (request()->is('dis2')) ? 'active' : '' }}" href="{{ url('dis2') }}">Disposisi 2
                @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis1Permohonan")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis1Permohonan")->count() }}</span>
                @endif
                </a>
            @endif
            @if(Auth::user()->permissionsGroup->dispo3p_status)
                <a class="collapse-item {{ (request()->is('dis3')) ? 'active' : '' }}" href="{{ url('dis3') }}">Disposisi 3
                @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis2Permohonan")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis2Permohonan")->count() }}</span>
                @endif
                </a>
            @endif
            @if(Auth::user()->permissionsGroup->dispo4p_status)
                <a class="collapse-item {{ (request()->is('dis4')) ? 'active' : '' }}" href="{{ url('dis4') }}">Disposisi 4
                @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis3Permohonan")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis3Permohonan")->count() }}</span>
                @endif
            </a>
            @endif
        </div>
    </div>
</li>
@endif

@if(Auth::user()->permissionsGroup->dispo1s_status||Auth::user()->permissionsGroup->dispo2s_status)
<li class="nav-item {{ (request()->is('dis5')) ? 'active' : '' }} {{ (request()->is('dis6')) ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo_3" aria-expanded="true" aria-controls="collapseTwo_3">
        <i class="fa fa-fw fa-book"></i>
        <span>SPJ</span>
        @if(Auth::user()->permissionsGroup->dispo1s_status)
            @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitSPJ")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitSPJ")->count() }}</span>
            @endif
        @elseif(Auth::user()->permissionsGroup->dispo2s_status)
            @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis1SPJ")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis1SPJ")->count() }}</span>
            @endif
        @endif
    </a>
    <div id="collapseTwo_3" class="collapse" aria-labelledby="headingTwo_3" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @if(Auth::user()->permissionsGroup->dispo1s_status)
                <a class="collapse-item {{ (request()->is('dis5')) ? 'active' : '' }}" href="{{ url('dis5') }}">Disposisi 1
                @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitSPJ")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitSPJ")->count() }}</span>
                @endif
                </a>
            @endif
            @if(Auth::user()->permissionsGroup->dispo2s_status)
                <a class="collapse-item {{ (request()->is('dis6')) ? 'active' : '' }}" href="{{ url('dis6') }}">Disposisi 2
                @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis1SPJ")->count() != 0)
                <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis1SPJ")->count() }}</span>
                @endif
                </a>
            @endif
        </div>
    </div>
</li>
@endif
{{-- ! Disposisi --}}

{{-- Histori --}}
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item {{ request()->is('histori') ? 'active' : '' }}">
    <a href="{{ url('histori') }}" class="nav-link">
      <i class="fas fa-fw fa-history"></i>
      <span>Histori Permohonan</span>
      @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis2SPJ")->count() != 0)
        <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\Dis2SPJ")->count() }}</span>
      @endif
    </a>
</li>
{{-- ! Histori --}}


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

{{-- @if ()
    <hr class="sidebar-divider">
@endif --}}