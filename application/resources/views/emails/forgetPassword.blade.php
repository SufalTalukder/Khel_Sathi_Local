<!DOCTYPE html>
<html>

<head>
    <title>Login Credentials for Khel Sathi Portal</title>
</head>

<body>
<?php $form_type = session()->get('form_type'); ?>


    <p>Dear {{$name}},</p>
    <br>
    <p>
    @if($form_type == 4)To avail  Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension
    @elseif($form_type == 5) To avail Online Application Submission for Direct Recruitment as Gazetted Officer
    @elseif($form_type == 11)To avail Online Application Submission for Admission in Sport College
    @elseif($form_type == 12)
    You have been successfully registered on Khel Sathi Portal to avail online Application service. Kindly login with the User ID {{$email}} and Password {{$password}}. To avail the required service, kindly login with the mentioned login credentials and furnish necessary details.
    @elseif($form_type == 13)
    To avail online Application service on Khel Sathi Portal kindly login with the User ID {{$email}} and Password {{$password}}.
    @else Nomination Form to Seek Reward from Government of UP  @endif
    @if($form_type == 11) service on Khel Sathi Portal kindly login with your registered  User Id {{$email}}@else Email ID {{$email}}  and Password {{$password}} .</p>@endif
    <br>
    @if($form_type == 4)
    <p>Login  URL: {{  url('') }}</p>
    @elseif($form_type == 5)
    <p>Login  URL: https://khelsathi.in</p>
    @elseif($form_type == 11)
    <p>Login  URL: {{  route('onlineAdmission.loginForm') }}</p>
    @elseif($form_type == 12)
    <p>Login  URL: {{  route('onlineAdmission.loginForm') }}</p>

    @elseif($form_type == 13)
    <p>Login  URL: {{  route('onlineAdmission.loginForm') }}</p>
    @else
    <p>Login URL: {{  url('') }}</p>
    @endif
    <br>
    {{-- <p>For any technical support regarding the software, contact our Helpline No. +91XXXXXXX or Email your query to sport@gmail.com.</p> --}}
    <br>
    <p>Regards,</p>
    <p>Department of Sports, Uttar Pradesh</p>
    <br>
</body>

</html>
