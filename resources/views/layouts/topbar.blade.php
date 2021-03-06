<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
{{--            <li class="nav-item dropdown">--}}

{{--                @if(session('lang')=='en')--}}
{{--                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    <i class="flag-icon flag-icon-us mt-1" title="us" id="us"></i> <span class="font-weight-medium ml-1 mr-1">English</span>--}}
{{--                </a>--}}
{{--                @else--}}
{{--                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    <i class="flag-icon flag-icon-eg mt-1" title="us" id="us"></i> <span class="font-weight-medium ml-1 mr-1">العربيه</span>--}}
{{--                </a>--}}
{{--                @endif--}}
{{--                <div class="dropdown-menu" aria-labelledby="languageDropdown">--}}
{{--                    <a href="{{url('lang/en')}}" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ml-1"> English </span></a>--}}
{{--                    <a href="{{url('lang/ar')}}" class="dropdown-item py-2"><i class="flag-icon flag-icon-eg" title="ar" id="ar"></i> <span class="ml-1"> العربيه </span></a>--}}

{{--                </div>--}}
{{--            </li>--}}
{{--            <li class="nav-item dropdown nav-apps">
                <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="grid"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="appsDropdown">

                    <div class="dropdown-body">
                        <div class="d-flex align-items-center apps">
                            <a href="{{ url('/users') }}"><i data-feather="users" class="icon-lg"></i>
                                <p>{{trans('site_lang.side_users')}}</p>
                            </a>
                            <a href="{{ url('/clients') }}"><i data-feather="globe" class="icon-lg"></i>
                                <p>{{trans('site_lang.side_clients')}}</p>
                            </a>
                            <a href="{{url('/mohdareen')}}"><i data-feather="check-square" class="icon-lg"></i>
                                <p>{{trans('site_lang.side_mohdar')}}</p>
                            </a>
                            <!-- <a href="{{url('userprofile')}}"><i data-feather="instagram" class="icon-lg"></i>
                                <p>{{trans('site_lang.profile')}}</p>
                            </a> -->
                        </div>
                    </div>

                </div>
            </li>--}}
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('uploads/userprofile/'.Auth::user()->image) }}" alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="{{ asset('uploads/userprofile/'.Auth::user()->image) }}" alt="">
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{Auth::user()->name}}</p>
                            <p class="email text-muted mb-3">{{Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{url('userprofile')}}" class="nav-link">
                                    <i data-feather="user"></i>
                                    <span>{{trans('site_lang.profile')}}</span>
                                </a>
                            </li>
                            @if(auth()->user()->parent_id == null)
                                <li class="nav-item">
                                    <a href="{{url('my_package')}}" class="nav-link">
                                        <i data-feather="user"></i>
                                        <span>{{trans('site_lang.my_package')}}</span>
                                    </a>
                                </li>
                            @endif
                            <!-- <li class="nav-item">
                                <a href="javascript:;" class="nav-link">
                                    <i data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a href="javascript:;" class="nav-link">
                                    <i data-feather="repeat"></i>
                                    <span>Switch User</span>
                                </a>
                            </li> -->
                            <li class="nav-item">

                                <a href="{{ route('logout') }}" type='submit' class="nav-link" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out"></i>
                                    <span>{{trans('site_lang.side_exit')}}</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>


                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
