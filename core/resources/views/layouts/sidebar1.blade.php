<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <span>
        <small>
            <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>&nbsp;Dashboard</span>
                </a>
            </li>
        </small>   
    </span>
</ul>

{{-- @if(auth()->user()->role->crud_permission == 1)
      <li class="nav-item {{ request()->is('permission') ? 'active' : '' }}">
        <a href="{{ url('permission') }}" class="nav-link">
          <i class="fas fa-fw fa-key"></i><span> Permission</span>
        </a>
      </li>
    @endif

    @if(auth()->user()->role->crud_user == 1)
      <div class="nav-item {{ request()->is('user') ? 'active' : '' }}">
        <a href="{{ url('user') }}" class="nav-link">
          <i class="fas fa-fw fa-users"></i><span> Manajemen User</span>
        </a>
      </div>
    @endif

    @if(auth()->user()->role->edit_category == 1)
    <div class="nav-item {{ request()->is('kategori') ? 'active' : '' }}">
      <a href="{{ url('kategori') }}" class="nav-link">
        <i class="fas fa-fw fa-th"></i><span> Manajemen Kategori</span>
      </a>
    </div>
    @endif

    @if (auth()->user()->role->add_content == 1 || auth()->user()->role->approve_content == 1 || auth()->user()->role->edit_content == 1)
    <div class="nav-item {{ request()->is('news') ? 'active' : '' }}">
      <a href="{{ route('news') }}" class="nav-link">
        <i class="fas fa-fw fa-newspaper"></i>
        <span> Manajemen Berita&nbsp;
          @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitNews")->count() == 0)
          @else
            <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitNews")->count() }}</span>
          @endif

          @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\RejectNews")->count() == 0)
          @else
            <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\RejectNews")->count() }}</span>
          @endif
        </span>
      </a>
    </div>
    @endif

    @if (auth()->user()->role->add_content == 1 || auth()->user()->role->approve_content == 1 || auth()->user()->role->edit_content == 1)
    <div class="nav-item {{ request()->is('headline') ? 'active' : '' }}">
      <a href="{{ route('headline') }}" class="nav-link">
        <i class="fas fa-fw fa-heading"></i>
        <span> Manajemen Headline&nbsp;
          @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitHeadlines")->count() == 0)
          @else
            <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitHeadlines")->count() }}</span>
          @endif

          @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\RejectHeadlines")->count() == 0)
          @else
            <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\RejectHeadlines")->count() }}</span>
          @endif
        </span>
      </a>
    </div>
    @endif

    @if (auth()->user()->role->add_content == 1 || auth()->user()->role->approve_content == 1 || auth()->user()->role->edit_content == 1)
    <div class="nav-item {{ request()->is('gallery') ? 'active' : '' }}">
      <a href="{{ route('gallery') }}" class="nav-link">
        <i class="fas fa-fw fa-images"></i>
        <span> Manajemen Galeri&nbsp;
          @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitGallery")->count() == 0)
          @else
            <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\SubmitGallery")->count() }}</span>
          @endif

          @if (auth()->user()->unreadNotifications()->where("type", "App\Notifications\RejectGallery")->count() == 0)
          @else
            <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->where("type", "App\Notifications\RejectGallery")->count() }}</span>
          @endif
        </span>
      </a>
    </div>
    @endif

    @if (auth()->user()->role->add_content == 1 || auth()->user()->role->approve_content == 1)
    <div class="nav-item {{ request()->is('konten') ? 'active' : '' }}">
      <a href="{{ route('konten') }}" class="nav-link">
        <i class="fas fa-fw fa-list"></i>
        <span>

          @if (auth()->user()->role->crud_permission == 1)
              List Konten&nbsp;
          @elseif(auth()->user()->role->add_content == 1)
              Konten Saya&nbsp;
          @elseif(auth()->user()->role->approve_content == 1)
              List Konten&nbsp;
          @endif
          
          @php
            $approve1 = auth()->user()->unreadNotifications()->where("type", "App\Notifications\ApproveNews")->count();
            $approve2 = auth()->user()->unreadNotifications()->where("type", "App\Notifications\ApproveHeadlines")->count();
            $approve3 = auth()->user()->unreadNotifications()->where("type", "App\Notifications\ApproveGallery")->count();

            $badge_count = $approve1+$approve2+$approve3;

            if ($badge_count != 0){
              echo '<span class="badge badge-pill badge-danger">' . $badge_count . '</span>';
            }

          @endphp

        </span>
      </a>
    </div>
    @endif

    @if (auth()->user()->role->edit_component == 1)
      <div class="nav-item {{ request()->is('components') ? 'active' : '' }}">
        <a href="{{ route('components') }}" class="nav-link">
          <i class="fas fa-fw fa-puzzle-piece"></i>
          @if (auth()->user()->role->edit_component == 1)
              <span>Komponen Website &nbsp;</span>
          @endif
        </a>
      </div>
    @endif

    @if (auth()->user()->role->edit_component == 1)
      <div class="nav-item {{ request()->is('apps') ? 'active' : '' }}">
        <a href="{{ route('apps.index') }}" class="nav-link">
          <i class="fas fa-fw fa-th"></i>
            <span>Aplikasi Paud Dikmas &nbsp;</span>
        </a>
      </div>
    @endif

    @if (auth()->user()->role->edit_component == 1)
      <div class="nav-item {{ request()->is('pengumum') ? 'active' : '' }}">
        <a href="{{ route('pengumum.index') }}" class="nav-link">
          <i class="fas fa-fw fa-info-circle"></i>
            <span>Pengumuman &nbsp;</span>
        </a>
      </div>
    @endif --}}