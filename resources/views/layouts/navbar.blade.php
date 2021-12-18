<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{url('/')}}" class="sidebar-brand">
            Lawyer<span> App</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            @if(auth()->user()->parent_id == null)
                @php
                    $expiry_date = auth()->user()->expiry_date;
                    $expiry_package = auth()->user()->expiry_package;
                    $package_name = auth()->user()->Package->name ;
                @endphp
            @else
                @php
                    $parent_user = \App\User::where('id',auth()->user()->parent_id)->first();
                    $expiry_date = $parent_user->expiry_date;
                    $expiry_package = $parent_user->expiry_package;
                    $package_name = $parent_user->Package->name ;
                @endphp
            @endif
            @php $user_type = auth()->user()->type; @endphp
            @if($user_type != 'manager')

                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">{{trans('site_lang.side_home')}}</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ url('/users') }}">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">{{trans('site_lang.side_users')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/clients') }}" class="nav-link">
                        <i class="link-icon" data-feather="globe"></i>
                        <span class="link-title">{{trans('site_lang.side_clients')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false"
                       aria-controls="uiComponents">
                        <i class="link-icon" data-feather="briefcase"></i>
                        <span class="link-title">{{trans('site_lang.side_cases')}}</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="uiComponents">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{url('/addCase')}}" class="nav-link">{{trans('site_lang.side_add_case')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/caseDetails') }}"
                                   class="nav-link">{{trans('site_lang.side_search_case')}}</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/mohdareen')}}">
                        <i class="link-icon" data-feather="check-square"></i>
                        <span class="link-title">{{trans('site_lang.side_mohdar')}}</span>
                    </a>
                </li>
                @if($user_type == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/categories')}}">
                            <i class="link-icon" data-feather="inbox"></i>
                            <span class="link-title">{{trans('site_lang.side_categories')}}</span>
                        </a>

                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#charts" role="button" aria-expanded="false"
                       aria-controls="charts">
                        <i class="link-icon" data-feather="pie-chart"></i>
                        <span class="link-title">{{trans('site_lang.side_reports')}}</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{url('/dailyReport')}}"
                                   class="nav-link">{{trans('site_lang.side_reports_daily')}}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/MonthlyReport') }}"
                                   class="nav-link">{{trans('site_lang.side_reports_monthly')}}</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if( auth()->user()->type == 'manager')
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/manager/home')}}">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">{{trans('site_lang.side_ControlPanel')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/subscribers')}}">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">{{trans('site_lang.side_clients')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/packages')}}">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">{{trans('site_lang.side_Packages')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/points')}}">
                        <i class="link-icon" data-feather="check-circle"></i>
                        <span class="link-title">{{trans('site_lang.points')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/governments')}}">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">{{trans('site_lang.governments')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('employers.index')}}">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">{{trans('site_lang.employers')}}</span>
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('suggestions.index')}}">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">{{trans('site_lang.suggestions')}}</span>
                            &nbsp; &nbsp; &nbsp;
                            <span style="color: red" >5</span>
                        </a>

                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('settings.index')}}">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">{{trans('site_lang.settings')}}</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="javascript:void(0);" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">theme</h6>
        <div class="row">
            <div class="form-check form-check-inline">
                <a class="btn @if(auth()->user()->them == 'light') btn-success @else btn-dark @endif "
                   href="{{url('theme/light')}}" id="theme" role="button" data-toggle="" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="" title="light" id="light"></i>
                    <span class="font-weight-medium ml-1 mr-1">light</span>
                </a>
            </div>
            <div class="form-check form-check-inline">
                <a class="btn @if(auth()->user()->them == 'dark') btn-success @else btn-dark @endif"
                   href="{{url('theme/dark')}}" id="theme" role="button" data-toggle="" aria-haspopup="true"
                   aria-expanded="false">
                    <i class="" title="dark" id="dark"></i>
                    <span class="font-weight-medium ml-1 mr-1">dark</span>
                </a>
            </div>
        </div>

    </div>
</nav>
