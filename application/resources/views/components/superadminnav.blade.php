<header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 col-md-1 b-right">
                        <img src="{{ asset('') }}/assets_admin/images/logo.png" alt="" class="dash-logo" />
                    </div>
					<div class="col-9 col-md-11">
						<div class="row modulebg">
                            <div class="col">
                                <h4 class="moudlename">Khel Sathi Portal
                            </h4>
                            </div>
                            <div class="col-auto">
                                <nav class="navbar navbar-expand-lg topmenu">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item active"><a class="nav-link" href="{{route('superdashboard')}}"><span class="icons icon-speedometer"></span> Dashboard </a></li>
                                            <li class="nav-item"><a href="javascript:void(0)" class="profileicon">
                                                <span class="icons icon-user"></span></a><div class="sidebar">

                                                <div class="profiletitle">@if( Auth::guard('admin')->user()){{ Auth::guard('admin')->user()->username }} @else Darpan @endif <span class="text-uppercase">Last Login/पिछली बार लॉगिन का समय : </span> </div>
                                                    <div class="scrollwrap">
                                                        <div >
                                                            <ul class="navsidebar">
                                                                <li class="nav-item"><a href="{{route('superprofile')}}"><span class="icons icon-user"></span> Profile</a> </li>
                                                                <li class="nav-item"><a href="{{ route('superChangePassword') }}"><span class="icons icon-lock"></span>  Change Password</a> </li>
                                                                <!-- <li class="nav-item"><a href="{{ route('changePassword') }}"><span class="icons icon-lock"></span>  Change Password</a> </li> -->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @if( Auth::guard('admin')->user())
                                                    <div class="logoutbutton"><a href="{{ route('susignOuts') }}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a></div>
                                                    @endif
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <nav class="navbar navbar-expand-lg mainmenu">
                                <div class="container-fluid p-0">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                                    <div class="collapse navbar-collapse" id="Div1">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item">
                                                <a class="nav-link module-name" href="#">
                                                Government of Uttar Pradesh
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
