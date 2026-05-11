@extends('layouts/facility_booking_auth')
@section('content')
    <div class="container-fluid pagecontentbody">
        <div class="pagebody removebg-color">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <h4 class="mb-0">Change Password <a href="{{ route('facility_booking_dashboard') }}"
                                class="btn btn-outline-success btn-sm backbtn float-end "><span
                                    class="icons icon-arrow-left"></span>Back to Dashboard</a></h4>
                    </div>
                </div>
                <div class="col-md-12 mb-0">
                    <div class="card">
                        <div class="card-body">
                            <form     id="preregister" action="{{ route('facility_booking_change_password') }}" class="mt-2 needs-validation"
                                novalidate method="post">
                                @csrf
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
                                                <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password/पासवर्ड"  name="new_password" minlength="8" class="form-control" id="password-field" value="{{old('newpassword')}}" required>
                                                <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                            </div>
                                            <div class="invalid-feedback">
                                                Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
                                            </div>


                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <label for="exampleFormControlInput3" class="form-label">Retype New Password/नया पासवर्ड पुनः भरें</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                                <input type="password" placeholder="Password/पासवर्ड"  minlength="8"name="confirm_password" class="form-control" id="password-field2" value="{{old('confirmpassword')}}" required>
                                                <span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                                @error('confirmpassword')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">

                                            <button type="submit" class="btn btn-info  mt-4">Change Password/पासवर्ड बदलें</a>

                                        </div>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
