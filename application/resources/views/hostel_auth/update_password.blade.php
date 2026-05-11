@extends('layouts\admin_hostel_dashboard')
@section('hostelDashboard')


        <div class="container-fluid pagecontentbody">



                    <div class="pageheader mb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Change Password/पासवर्ड बदलें  <a href="{{route('hostel.dashboard')}}" class="btn btn-outline-info backbtn float-end" style="width: auto;"><span class="icons icon-arrow-left"></span>Dashboard</a></h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Dashboard/डैशबोर्ड</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Change Password/पासवर्ड बदलें</li>
                                    </ol>
                                </nav>
                            </div>

                               </div>
                    </div>
                   <div class="card mt-3 mb-3">
                                <div class="card-body">
                                 <form action="{{route('hostel.changepasswordStore')}}" class="needs-validation" novalidate method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="mb-1 col-md-3">
                                            <label for="exampleFormControlInput1" class="form-label">Current Password/वर्तमान पासवर्ड</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                                <input type="password" placeholder="Password/पासवर्ड" name="oldpassword" class="form-control" id="password-field1" value="{{old('oldpassword')}}" required>
                                                <span toggle="#password-field1"   class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                                @error('oldpassword')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <label for="exampleFormControlInput2" class="form-label">New Password/नया पासवर्ड</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                                <input type="password" placeholder="Password/पासवर्ड"  name="newpassword" minlength="8" class="form-control" id="password-field" value="{{old('newpassword')}}" required>
                                                <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                                <div class="invalid-feedback">
												Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
											    </div>
                                                @error('newpassword')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <label for="exampleFormControlInput3" class="form-label">Retype New Password/नया पासवर्ड पुनः भरें</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                                <input type="password" placeholder="Password/पासवर्ड"  minlength="8"name="confirmpassword" class="form-control" id="password-field2" value="{{old('confirmpassword')}}" required>
                                                <span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                                @error('confirmpassword')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <label class="form-label">&nbsp;</label><br>
                                            <button type="submit" class="btn btn-info">Change Password/पासवर्ड बदलें</a>

                                        </div>
                                    </div>
                                 </form>


                                </div>
                            </div>


            </div>


        <footer>
            <div class="row">
                <div class="col-md-8">
				<ul class="foot-list">
                        <li>Copyright &copy; Department of Sports</li>
                    </ul>
                </div>
                <div class="col-md-4">
				<ul class="foot-list float-end">
                        <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
@endsection
