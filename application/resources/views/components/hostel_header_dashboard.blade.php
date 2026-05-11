<style>
    .moudlename .department-logo {

        font-size: .9rem;
    }

    .profileicon {

        color: #ffb300;
    }

    .profileicon:hover {
        color: #fff;
    }

    .moudlename {
        padding: 5px 0 0;
        font-size: 1.1rem;

    }

    .header .dash-logo {
        max-width: 60px;
    }

    @media only screen and (max-width: 1024px) {
        .header .dash-logo {
            margin: 2px auto;
        }
    }

    @media only screen and (max-width: 768px) {
        .header .dash-logo {
            max-width: 45px;
            margin: 10px 0px;
        }
    }

    @media only screen and (max-width: 425px) {
        .header .dash-logo {
            max-width: 50px;
        }

        .list-group-item {
            padding: 0.5rem 0.5rem;
            font-size: 12px;
        }
    }
</style>

<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 col-md-1 b-right">
                <img src="{{ asset('assets_admin/images/logo.png') }}" alt="" class="dash-logo" />
            </div>
            <div class="col-10 col-md-11">
                <div class="row modulebg">
                    <div class="col">
                        <h3 class="moudlename">Khel Sathi Portal/खेल साथी पोर्टल<span class="department-logo">Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</span></h3>
                        <p style="margin: 0;color: #fff;font-size: 78%;"><b>Application for Hostel Admission/छात्रावास में प्रवेश हेतु आवेदन</b></p>
                    </div>
                    <div class="col-auto">
                        <nav class="navbar navbar-expand-lg topmenu">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item"><a href="#" class="profileicon">
                                        <span class="icons icon-user"></span></a>
                                    <div class="sidebar">
                                        <div class="profiletitle">{{Auth::guard('hostel')->user()->name}}<span>Last Login : {{dmy(Auth::guard('hostel')->user()->last_login)}}</span></div>
                                        <div class="scrollwrap">
                                            <div>
                                                <ul class="navsidebar">
                                                    <li class="nav-item"><a href="{{route("hostel.dashboard")}}"><span class="icons icon-speedometer"></span> Dashboard </a></li>
                                                    <li class="nav-item"><a href="{{route("hostel.changePassword")}}"><span class="icons icon-lock"></span> Change Password</a> </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="logoutbutton"><a href="{{route('hostel.logout')}}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a></div>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
