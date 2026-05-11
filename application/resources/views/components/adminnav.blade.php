<style>
	.profileicon {
		color: #c68686 !important
	}
</style>
<header class="header menuheader-width">
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<h4 class="moudlename">
					<div class="list-control">
						<a class="sidemenutoggle">
							<span class="icons icon-menu"></span>
						</a>
						<div class="menusidebar menusidebar-width">
							<div class="profiletitle">
								<img src="{{ asset('') }}/assets_admin/images/logo.png" alt="" class="dash-logo" />
								<span class="logotxt">Department of Sports Government of Uttar Pradesh</span>
							</div>
							<div class="menuscrollwrap">
								<div class="nano-content f">
									<x-sidebar_left_menu />
								</div>
							</div>
							@if( Auth::guard('admin')->user())
							<div class="logoutbutton"><a href="{{ route('signOuts') }}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a>
							</div>
							@endif
						</div>
					</div>
					Department of Sports Government of Uttar Pradesh</span>
				</h4>
			</div>
			<div class="col-md-auto">
				<a href="javascript:void()" class="profileicon">
					<span class="icons icon-user"></span>
				</a>
				<?php //echo '<pre>'; print_r(Auth::guard('admin')->user()); die; 
				?>
				<div class="sidebar">
					<div class="profiletitle">@if(Auth::guard('admin')->user()){{ Auth::guard('admin')->user()->username }} @else Darpan @endif <span class="text-uppercase">Last Login/पिछली बार लॉगिन का समय : <!--last_login(Auth::guard('admin')->user()->id)--></span></div>
					<div class="scrollwrap">
						<div class="nano-content">
							<ul class="navsidebar">
								<li class="nav-item"><a href="{{route('adminprofile')}}"><span class="icons icon-user"></span> Profile</a> </li>
								<li class="nav-item"><a href="{{ route('adminChangePassword') }}"><span class="icons icon-lock"></span> Change Password</a> </li>
								<!-- <li class="nav-item"><a href="{{ route('changePassword') }}"><span class="icons icon-lock"></span>  Change Password</a> </li> -->
							</ul>
						</div>
					</div>
					{{-- @if( Auth::guard('admin')->user())
					<div class="logoutbutton"><a href="{{ route('signOuts') }}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a>
				</div>
				@endif --}}
			</div>
		</div>
	</div>
	</div>
</header>
