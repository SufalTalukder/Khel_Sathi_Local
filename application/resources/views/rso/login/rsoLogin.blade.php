@extends('layouts/rso_web')
@section('content')

        <div class="row">
            <div class="col-md-6 loginsidebar">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-2 text-center mb-3">
                        <img src="{{ asset('assets_admin/images/logo.png') }}" class="img-fluid" />
                    </div>
                    <div class="col-md-12 col-12 deptname">
                    <h1 class="hd-org">Khel Sathi Portal</h1>
                        <h2>Department of Sports, Government of Uttar Pradesh</h2>
                    </div>
                    <!-- <div class="col-md-12 pt-1 deptname">
                        <h3 class="text-success">RSO/Inspection Committee Login</h3>
                    </div> -->
                </div>
            </div>
            <div class="col-md-6 bg-light1">
                <div class="p-4 p-lg-5 login-form">
                    <div class="text-center text-md-center mb-2 mt-md-0">
                        <h3 class="mb-0">RSO/Inspection Committee Login</h3>
                        <!--<div class="d-flex justify-content-center align-items-center mt-2"><span class="fw-normal">Don't have an account? <a href="./index.html" class="fw-bold">Create account</a></span></div>-->
                    </div>
                    <form action="{{ route('rso_login') }}" method="post" id="adminlogin" class="mt-2 row g-3 required" novalidate>
                        <div class="form-group">
                            <label for="email">Registered Email ID</label>
                            <input type="email" class="form-control" id="email"  name="email" required>
                            <div class="invalid-feedback">
                            Please Enter Registered Email ID.
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="password-field">Password</label>
                                <input type="password" class="form-control" id="password-field" name="password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                <div class="invalid-feedback">
                                Please Enter Password.
                                </div>
                            </div>
                        </div>    

                        <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="captcha">
                                <label class="btn-block">Captcha</label>
                                <span class="unselectable" id="cp_refresh">{{$capchaCode}}</span>
                            </div>
                        </div>
                        <div class="col-md-1 refresh">
                            <div class="cp_refresh"><a href="javascript:void(0)" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                        </div>
                        <div class="col-md-6">
                            <label>Enter Captcha</label>
                            <input name="captcha" id="captcha" type="text" required pattern="[0-9]{5}$" class="form-control">
                            <div class="invalid-feedback">
                                Please provide a valid captcha.
                            </div>
                        </div>
                    </div>
                </div>
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="captcha">
                                            <label class="btn-block">Captcha</label>
                                            <img src="images/captcha.jpg" alt="Captcha" title="Captcha">
                                        </div>
                                    </div>
                                    <div class="col-md-1 refresh">
                                        <div class="cp_refresh"><a href="#" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Enter Captcha</label>
                                        <input name="" type="text" class="form-control">
                                    </div>
                                </div>
                            </div> -->
                        
                        <div class="d-grid mb-3"><button type="submit" class="btn btn-info w-100">Login</button> </div>
                        <div class="clearfix"></div>
                        <input type="hidden" name="capchaCode" id="capchaCode" class="refreshc" value="{{$capchaCode}}">
                        <!-- <div class="d-flex justify-content-between align-items-top">
                            <a href="./forgot-password.html" class="small text-right">Forgot Password?</a>
                            <input class="form-check-input" type="checkbox" value="" id="remember">
                            <label class="form-check-label mb-0" for="remember">Remember me</label>
                        </div> -->
                    </form>
                </div>
            </div>

        @endsection
