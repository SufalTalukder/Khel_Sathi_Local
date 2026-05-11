@extends( 'layouts\private_coaching_auth_layout' )
@section('content')


<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="mb-0">Profile Details</h4>
                        </div>
                        <div class="col-md-3 text-end mb-2">

                        </div>
                    </div>
                </div>
                <div class="bhoechie-tab-container">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="prodiv">
                                        <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="table-responsive"><table class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                            <tbody><tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>A. Registration Details/पंजीकरण के विवरण</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>1.) Full Name/पूरा नाम</strong></td>
                                                                <td> {{Auth::guard('PrivateCoaching')->user()->name}}</td>
                                                                <td><strong>2. Designation/पदनाम</strong></td>
                                                                <td>{{Auth::guard('PrivateCoaching')->user()->designation}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>3.) Email ID/ईमेल आईडी </strong></td>
                                                                <td>{{Auth::guard('PrivateCoaching')->user()->email}}</td>
                                                                <td><strong>4.) Mobile No./मोबाइल नंबर </strong></td>
                                                                <td>{{Auth::guard('PrivateCoaching')->user()->mobile}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>5.) Photo/फोटो </strong></td>
                                                                <td>  <a href="{{ asset('public/private_coaching_storage/photo_upload/') }}/{{ $profile->photo_upload }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>B. Address Details/पते का विवरण</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>1.) Office Address/कार्यालय का पता </strong></td>
                                                                <td>{{$profile->office_address}}</td>
                                                                <td><strong>2.) State/राज्य </strong></td>
                                                                <td>Uttar Pradesh</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>3.) City/शहर </strong></td>
                                                                <td>{{districtName($profile->district)}}</td>
                                                                <td><strong>4.) Pincode/पिन कोड </strong></td>
                                                                <td>{{$profile->pin}}</td>
                                                            </tr>
                                                          
                                                            <tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>D. Institution/संस्थान</strong></td>
                                                            </tr>
                                                            <tr>
                                                        
                                                                <td><strong>1.) Institution Name/संस्था का नाम </strong></td>
                                                                <td>{{$profile->institute_name}}</td>
                                                            </tr>
                                                        </tbody></table></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
