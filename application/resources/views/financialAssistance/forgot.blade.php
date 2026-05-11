@extends('layouts/web')
@section('content')
<style>
      .unselectable {
        -webkit-user-select: none;
        -webkit-touch-callout: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
    </style>
<div class="row">
<div class="col-md-6 loginsidebar">
        <div class="row justify-content-center">
            <div class="col-4 col-lg-2 text-center mb-3">
                <img src="{{ asset('') }}/images/-logo.png" class="img-fluid mobile-resp" />
            </div>
            <div class="col-md-12 col-12 deptname">
                        <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
                        <h3>Department of Sports, Government of Uttar Pradesh<br>खेल विभाग, उत्तर प्रदेश सरकार</h3>
                    </div>
            <div class="col-md-12 col-12 deptname">
            <h5 class="text-success">Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension<br>वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली</h5>
            </div>
        </div>
    </div> 
    <div class="col bg-light">
        <div class="p-4 p-lg-5 login-form">
            <div class="text-center text-md-center mb-2 mt-md-0">
                <h3 class="mb-0">Forgot Password?</h3>
                <div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">
                Please submit your Registered Email ID below and we'll send you a password on your mobile number.

                </span>
            </div>
            </div>
            <form action="{{ route('faforgot') }}" method="post"id="reload" class="mt-2  g-3 required" novalidate>
                <div class="form-group">
                    <label for="email">Registered Email ID/पंजीकृत ईमेल आईडी</label>
                    <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">
                        Please enter email.
                    </div>
                </div>
               
                <div class="form-group"><button type="submit" class="btn btn-info w-100">Submit/दर्ज करे</button> </div>
                
                <div class="form-group">
                            <a href="{{url('/financial-assistance')}}" class="small text-right">Back/वापस</a>
                       </div>
           </form>
        </div>
    </div>
</div>

@endsection
