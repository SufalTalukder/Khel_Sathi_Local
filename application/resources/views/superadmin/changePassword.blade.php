@extends( 'layouts/superadmin_layout' )
@section( 'content' )
	<!-- <div class="container-fluid pagecontentbody"> -->
		<!-- <div class="tab-content">
			<div class="pagebody removebg-color"> -->
			<div class="pageheader" id="menu-margin">
                <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('superdashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
            </div>
				<div class="col-md-12">
					<div class="row" id="menu-margin">
						<x-sidebar_left_menu />
						<div class="col-md-10">
							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col-md-11">
											<h5>Change Password</h5>
											<!-- <span><a href="{{route('user_manager_add')}}" class="btn btn-primary btn-sm float-end" >Add User</a></span> -->
										</div>
										<form action="{{ route('adminupdatePassword') }}" method="post" id="ajxReload" class="needs-validation" novalidate>
                                
                                    <div class="row">
                                        <div class="mb-1 col-md-3">
                                            <label for="exampleFormControlInput1" class="form-label">Current Password</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                                <input required type="password" name="old_password" placeholder="Password/पासवर्ड" class="form-control" id="password-field1">
                                                <span toggle="#password-field1" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                            </div>
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <label for="exampleFormControlInput2" class="form-label">New Password</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                                <input required type="password" name="password" placeholder="Password/पासवर्ड" class="form-control" id="password-field">
                                                <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                            </div>
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <label for="exampleFormControlInput3" class="form-label">Confirm Password</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                                <input required type="password" name="password_confirmation" placeholder="Password/पासवर्ड" class="form-control" id="password-field2">
                                                <span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <label class="form-label">&nbsp;</label><br>
                                            <button type="submit" class="btn btn-info">Change Password</button>
                                        </div>
                                    </div>
                                </form>
									</div>
								</div>
								<div class="card-body">
                                
                            </div>
							</div>
						</div>

					</div>
				</div>


			<!-- </div>
		</div> -->
	<!-- </div> -->

@endsection
