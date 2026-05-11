<div class="col-auto">
    <nav class="navbar navbar-expand-lg topmenu">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                @if( DB::table('user_award_apply_master')->where('user_id', Auth::user()->id)->whereIn('award_type_id', [4,5])->exists())
                <a class="nav-link" href="{{ route('fadashboard') }}"><span class="icons icon-speedometer"></span> Dashboard/डैशबोर्ड</a>
                @else
                <a class="nav-link" href="{{ route('faprofile') }}"><span class="icons icon-speedometer"></span> Profile</a>
                @endif
                    
                </li>
                <li class="nav-item"><a href="javascript:void(0)" class="profileicon">
                        <span class="icons icon-user"></span></a>
                    <div class="sidebar">
                        <div class="profiletitle">{{ Auth::user()->fullname }}<span class="text-uppercase">{{ Auth::user()->sport_type }}</span> <span>Last Login/पिछली बार लॉगिन का समय : {{last_login(Auth::user()->id)}} </span></div>
                        <div class="scrollwrap">
                            <div >
                                <ul class="navsidebar">
                                    <li class="nav-item"><a href="{{ route('faprofile') }}"><span class="icons icon-user"></span> Profile/प्रोफाइल</a> </li>
                                    <li class="nav-item"><a href="{{ route('fachangePassword') }}"><span class="icons icon-lock"></span> Change Password/पासवर्ड बदलें</a> </li>
                                </ul>
                            </div>
                        </div>                        
                        <div class="logoutbutton"><a href="{{ route('fasignOut') }}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout/लॉगआउट करें</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<nav class="navbar navbar-expand-lg mainmenu">
    <div class="container-fluid p-0">
		<span class="nav-text">Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension/वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
        <div class="collapse navbar-collapse" id="Div1">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
					<a class="nav-link module-name" href="#"></a>
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
