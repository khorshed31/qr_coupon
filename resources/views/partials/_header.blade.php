
@php
    $bg_color= "#1F3075";
    $text_color= "white";


    $withdraw_request = \Module\Product\Models\Withdraw::query()->where('request_status',0)->count();

@endphp
<style>
    .navbar {
        background: #1F3075;
    }

    .topbar-text-color {
        color: {{ $text_color }};
    }
    .navbar .navbar-brand {
        color: #FFF;
        font-size: 24px;
        text-shadow: none;
        padding-top: 0px;
        padding-bottom: 0px;
        height: auto;
    }
</style>
<div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left pt-1">
            <a href="{{ url('home') }}" class="navbar-brand" >
                <small class="text-primary font-weight-bold" style="font-weight: 600">

                    {{-- @if(file_exists(auth()->user()->image))
                        <img style="height: 50px !important;border-radius: 10px;width:110px" class="logos" src="{{ asset(auth()->user()->image) }}" alt="" >

                    @endif --}}
                        <span class="white">
                            {{-- <i class="fa fa-flag"></i> --}}
                            {{ optional(businessInfo())->name }}
                        </span>
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">


                <li class="light-10 dropdown-modal" title="Recommend Notifications">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-2x fa-bell" style="margin-top: 10px;"></i>
                            <sup style="color: white;font-size: 12px;margin-left: -16px;background-color: red;padding: 2px;border-radius: 50%;">
                                <b>{{ $withdraw_request }}</b>
                            </sup>

                    </a>

                    <ul class="dropdown-menu-right dropdown-navbar navbar-default dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="ace-icon fa fa-bell"></i>
                            {{ $withdraw_request }} Total Notifications
                        </li>

                        <li class="dropdown-content">
                            <ul class="dropdown-menu dropdown-navbar navbar-default">

                                    <li>
                                        <a href="{{ route('product.withdraw_requests.index') }}?request_status=0">
                                            <div class="clearfix">
                                            <span class="pull-left text-dark">
                                                Pending Request
                                            </span>
                                                <span class="pull-right">
                                                <span class="badge badge-danger" style="border-radius: 50%;">{{ $withdraw_request }}</span>
                                            </span>
                                            </div>
                                        </a>
                                    </li>

                            </ul>
                        </li>

                    </ul>
                </li>
                <!--  Leave Application Notification End  -->





                <li class="light-10 dropdown-modal"

                    @if(strlen(optional(auth()->user())->name) >= 10)
                        style="width: 180x"
                    @endif
                >
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle dark">

                        @if(optional(businessInfo())->logo)
                                <img class="nav-user-photo" height="35px" src="{{ asset(optional(businessInfo())->logo) }}" alt="User Photo" />
                        @else
                            <img class="nav-user-photo" height="35px" src="{{ asset('assets/images/gulf_logo.webp') }}" alt="User Photo" />
                        @endif
                        <span class="user-info" style="color:white;">
                            <small >Welcome,</small>
                            {{ optional(auth()->user())->name }}
                        </span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>


                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                        <li>
                            <a href="{{ route('product.change.password') }}">
                                <i class="ace-icon fa fa-user"></i>
                                Change Password
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>
