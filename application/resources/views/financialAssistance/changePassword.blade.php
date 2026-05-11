@extends('layouts/financelayout')
@section('content')
<div class="tab-content">
    <div class="pagebody removebg-color">
        <div class="pageheader">
            <h4 class="mb-0"> Change Password/पासवर्ड बदलें
                <!-- <a href="{{ route('fadashboard') }}" class="btn btn-dark backbtn float-end">
                    <span class="icons icon-arrow-left"></span> Back/पीछे
                </a> -->
            </h4>
        </div>
        <div class="bhoechie-tab">
            <div class="bhoechie-tab-content active">
                <div class="form-scroll">
                    <form action="{{ route('faupdatePassword') }}" method="post" id="ajxReload" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="mb-1 col-md-3">
                                <label for="exampleFormControlInput1" class="form-label">Old Password</label>
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
                                    <input required type="password" name="password" placeholder="Password/पासवर्ड" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="password-field">
                                    <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                    <div class="invalid-feedback">
												Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
											</div>
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
        </div>
    </div>
</div>
@endsection
