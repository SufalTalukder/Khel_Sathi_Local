<div class="col-auto">


    <nav class="navbar navbar-expand-lg topmenu">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-2">
                <li class="nav-item active">

                @if(Auth::user()->profile_complete==1)

                    <a class="nav-link" href="{{ route('dashboard') }}"><span class="icons icon-speedometer"></span> Dashboard/डैशबोर्ड </a>
                @else
                <a class="nav-link" href="{{ url('profile') }}"><span class="icons icon-speedometer"></span> Profile</a>
                @endif
                </li>

                <li class="nav-item">
                    <a href="javascript:void(0)" class="profileicon">
                        <span class="icons icon-user"></span>
                    </a>

                    <div class="sidebar">
                        <div class="profiletitle">{{ Auth::user()->fullname }}<span class="text-uppercase">{{ Auth::user()->sport_type }}</span> <span></span></div>



                        <div class="scrollwrap">
                            <div>
                                <ul class="navsidebar">
                                    <li class="nav-item"><a href="{{ url('profile') }}"><span class="icons icon-user"></span> Profile</a> </li>
                                    <li class="nav-item"><a href="{{ route('changePassword') }}"><span class="icons icon-lock"></span> Change Password/पासवर्ड बदलें</a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="logoutbutton">
                            <a href="{{ route('signOut') }}">
                                <span class="fas fa-power-off"></span>&nbsp;&nbsp; Logout/लॉगआउट करें
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<nav class="navbar navbar-expand-lg mainmenu">
    <div class="container-fluid p-0">
        <span class="nav-text">Nomination Form to Seek Reward from Government of UP / उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र</span>
        <?php  $iso_detail = isp_common(Auth::id(), Auth::user()->email); ?>
        @if ($iso_detail)
            

        <a class="btn btn-success btn-sm float-right" href="http://164.100.181.91/Dashboard" style="margin-right: 5px;">Back to ISP Portal</a>
        @endif
        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
        <div class="collapse navbar-collapse" id="Div1">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
            </ul>
        </div> --}}
    </div>
</nav>
<script>
    $('body,html').click(function(e) {
        $('#hide-menu').removeClass('header header-width');
    });
</script>
