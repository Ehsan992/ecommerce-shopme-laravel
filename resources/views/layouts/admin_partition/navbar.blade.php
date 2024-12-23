<main class="main-wrap">
  <header class="main-header navbar">
    <div class="col-search">
      
    </div>
    <div class="col-nav">
      <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="material-icons md-apps"></i> </button>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
        </li>
        <li class="nav-item">
          <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
        </li>
        <li class="dropdown nav-item">
          <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownLanguage" aria-expanded="false"><i class="material-icons md-public"></i></a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
            <a class="dropdown-item text-brand" href="#"><img src="{{asset('admin')}}/imgs/theme/flag-us.png" alt="English">English</a>
            <a class="dropdown-item" href="#"><img src="{{asset('admin')}}/imgs/theme/flag-fr.png" alt="Français">Français</a>
            <a class="dropdown-item" href="#"><img src="{{asset('admin')}}/imgs/theme/flag-jp.png" alt="Français">日本語</a>
            <a class="dropdown-item" href="#"><img src="{{asset('admin')}}/imgs/theme/flag-cn.png" alt="Français">中国人</a>
          </div>
        </li>
        <li class="dropdown nav-item">
          <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{ asset(str_replace('/write', '', Auth::user()->user_photo)) }}" alt="User"></a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
            <a class="dropdown-item" href="{{ route('profile.setting') }}"><i class="material-icons md-settings"></i>Account Settings</a>
            <a class="dropdown-item text-danger" id="logout" href="{{ route('admin.logout') }}"><i class="material-icons md-exit_to_app"></i>{{ __('Logout') }}</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </div>
  </header>
</main>