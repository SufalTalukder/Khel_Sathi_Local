
@extends('layouts/web')
@section('content')
     <div class="row">
             <div class="col-md-6 loginsidebar">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-2 text-center mb-3">
                        <img src="{{ asset('') }}/images/logo.png" class="img-fluid" />
                    </div>
                    <div class="col-md-12 col-12 deptname">
                        <h1>Uttar Pradesh New & Renewable Energy Development Agency</h1>
                        <h2>Department of AdditIonal Sources of Energy, Government of Uttar Pradesh</h2>
                    </div>
                    <div class="col-md-12 pt-2 deptname">
                        <h3 class="text-success">Solar Energy Portal</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-light1">
                <div class="p-4 p-lg-5 login-form">
                    <div class="text-center text-md-center mb-2 mt-md-0">
                        <h3 class="mb-0">Forgot Password?</h3>
                        <p>Please submit your User ID below and we'll send you a link to recover your password.</p>
                        <!--<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account? <a href="./sign-up.html" class="fw-bold">Create account</a></span></div>-->
                    </div>
                    <form action="#" class="mt-4">
                        <div class="form-group mb-4">
                            <label for="email">User ID</label>
                            <input type="email" class="form-control" id="email">
                        </div>

                        <div class="d-grid"><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verify">Submit</a> </div>
                        <div class="d-flex justify-content-between align-items-top mt-3">
                            <div><a href="{{ url('/') }}" class="small text-right">Back/????</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection
