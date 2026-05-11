<div class="col-auto">
    <nav class="navbar navbar-expand-lg topmenu">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active"><a class="nav-link" href="{{ route('drdashboard') }}"><span class="icons icon-speedometer"></span> Applied Jobs / नौकरी के लिए आवेदन</a></li>
                <li class="nav-item"><a href="javascript:void(0)" class="profileicon">
                        <span class="icons icon-user"></span></a>
                    <div class="sidebar">
                        <div class="profiletitle">{{ Auth::guard('direct_recruitment')->user()->fullname }}<span class="text-uppercase">{{ Auth::guard('direct_recruitment')->user()->sport_type }}</span> <span>Last Login/पिछली बार लॉगिन का समय : {{last_login(Auth::guard('direct_recruitment')->user()->user_id)}} </span></div>
                        <div class="scrollwrap">
                            <div >
                                <ul class="navsidebar">
                                    <li class="nav-item"><a href="{{ route('drchangePassword') }}"><span class="icons icon-lock"></span>Change Password/पासवर्ड बदलें</a> </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="logoutbutton"><a href="{{ route('drsignOut') }}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;
  Logout/लॉगआउट करें</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<nav class="navbar navbar-expand-lg mainmenu">
    <div class="container-fluid p-0">
        <!--button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button-->
        <div class="collapse navbar-collapse" id="Div1">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link module-name" >
                    ONLINE APPLICATION SUBMISSION FOR DIRECT RECRUITMENT AS GAZETTED OFFICER/राजपत्रित अधिकारी के रूप में सीधी भर्ती हेतु ऑनलाइन आवेदन
                    <!-- GOVERNMENT OF UTTAR PRADESH -->
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    $('body,html').click(function(e){
       $('#hide-menu').removeClass('header header-width');
});
    </script>
