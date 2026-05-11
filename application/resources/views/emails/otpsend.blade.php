<!DOCTYPE html>
<html>

<head>
    <title>OTP to Register</title>
</head>

<body>
<?php $form_type = session()->get('form_type'); ?>
    <p>Dear User,</p>
    <br>
    <p>
        @if($form_type == 4)Your OTP to Register on Khel Sathi Portal to avail Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension
        @elseif($form_type == 5) Your OTP to Register on Khel Sathi Portal to avail Online Application Submission for Direct Recruitment as Gazetted Officer
        @elseif($form_type == 11)Your OTP to Register on Khel Sathi Portal to avail Online Application Submission for Admission in Sport College
        @elseif($form_type == 1)

        Your OTP to Register on Khel Sathi Portal to avail
        @elseif($form_type == 22)Your OTP to Register on Khel Sathi Portal to avail Facility Booking

        @else Nomination Form to Seek Reward from Government of UP
        @endif
        service is {{$otp}}. Kindly verify the OTP on respective page and proceed for further action.</p>
    <br>
    {{-- <p>For general query, contact our Helpline No. +91XXXXXXX or Email ID khelsathi@gmail.com..</p> --}}
    <br>

    @if($form_type == 4)
    <p>Portal URL: {{  url('') }}</p>
    @elseif($form_type == 5)
    <p>Login  URL: {{  url('') }}</p>
    @elseif($form_type == 11)
    <p>Login  URL: https://khelsathi.in/</p>
    @elseif($form_type == 1)
    <p>Login  URL: https://khelsathi.in/</p>
    @else
    <p>Portal URL: {{  url('') }}</p>
    @endif
    <br>
    <p>Regards,</p>
    <p>Department of Sports, Uttar Pradesh</p>
</body>

</html>
