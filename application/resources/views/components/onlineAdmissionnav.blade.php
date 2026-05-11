<div class="col-auto">
    <nav class="navbar navbar-expand-lg topmenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="#" class="profileicon"> <span class="icons icon-user"></span> </a>
                <div class="sidebar">
                    @if(Auth::guard('OnlineAdmission')->check())
                    <div class="profiletitle">{{Auth::guard('OnlineAdmission')->user()->fullname}} <span class="text-uppercase">Applicant</span> <span>Last Login : {{dmy(Auth::guard('OnlineAdmission')->user()->last_login_attempt_time)}} </span></div>
                    @else
                    <div class="profiletitle">Welcome Guest <span class="text-uppercase">Applicant</span></div>
                    @endif
                    <div class="scrollwrap">
                        <div class="nano-content">
                            <ul class="navsidebar">
                                {{-- <li class="nav-item "><a href="{{route('onlineAdmissionTest.dashboard')}}"><span class="icons icon-speedometer"></span> Dashboard/डैशबोर्ड </a></li>
                                <li class="nav-item"><a href="{{ route('onlineAdmissionTest.ChangePassword') }}"><span class="icons icon-lock"></span> Change Password/पासवर्ड बदलें</a> </li> --}}
                            </ul>
                        </div>
                    </div>
                    @if(Auth::guard('OnlineAdmission')->check())
                    {{-- <div class="logoutbutton"><a href="{{ route('onlineAdmissionTest.logout') }}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a></div> --}}
                    @endif
                </div>
            </li>
        </ul>
    </nav>
</div>
<nav class="navbar navbar-expand-lg mainmenu">
    <div class="container-fluid p-0">
        <div class="mshed">
            Government of Uttar Pradesh /उत्तर प्रदेश सरकार
        </div>
    </div>
</nav>
