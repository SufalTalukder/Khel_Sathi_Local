@extends('layouts/drlayout')
@section('content')

<div class="dashbg">
    <div class="pageheader mb-0">
        <div class="row">
            <div class="col-md-12">
                <h4>Change Password/पासवर्ड बदलें <a href="{{ route('drdashboard') }}" class="btn btn-outline-info btn-sm backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a></h4>
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard/डैशबोर्ड
                            </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password/पासवर्ड बदलें</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-body">
            <form action="{{ route('drupdatePassword') }}" method="post" id="ajxReload" class="needs-validation" novalidate>
                <div class="row">
                    <div class="mb-1 col-md-3">
                        <label for="exampleFormControlInput1" class="form-label">Current Password
                            <br>वर्तमान पासवर्ड</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                            <input required type="password" name="old_password" placeholder="Password/पासवर्ड" class="form-control" id="password-field1">
                            <span toggle="#password-field1" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                        </div>
                    </div>
                    <div class="mb-1 col-md-3">
                        <label for="exampleFormControlInput2" class="form-label">New Password<br>नया पासवर्ड</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                            <input required type="password" name="password" placeholder="Password/पासवर्ड" class="form-control" id="password-field">
                            <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                        </div>
                    </div>
                    <div class="mb-1 col-md-3">
                        <label for="exampleFormControlInput3" class="form-label">Confirm Password<br>पासवर्ड की पुष्टि कीजिये</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                            <input required type="password" name="password_confirmation" placeholder="Password/पासवर्ड" class="form-control" id="password-field2">
                            <span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label><br><br>
                        <button type="submit" class="btn btn-info">Change Password/पासवर्ड बदलें</button>
                    </div>
                </div>
            </form>




            <!-- <p>Last Changed 7/29/2020, 9:50 am</p> -->
        </div>
    </div>



</div>

@endsection
