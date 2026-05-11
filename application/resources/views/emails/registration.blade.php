<!DOCTYPE html>
<html>

<head>
    <title>Login Credentials for Khel Sathi Portal</title>
</head>

<body>
<?php $form_type = session()->get('form_type'); ?>


    <p>Dear {{$name}},</p>
    <br>


    <p>You have been successfully registered on Khel Sathi Portal to avail
         @if($form_type == 4) Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension
         @elseif($form_type == 5)Hostel Admission service.
         @elseif($form_type == 11 || $form_type == 12)Online Application Submission for Admission
         @elseif($form_type == 21)Pvt. Coaching Academies / Associations ,Gyms, Swimming Pools
         @elseif($form_type == 22)Facility Booking
         @else Nomination Form to Seek Reward from Government of UP
          @endif service.
           Kindly login with your registered @if($form_type == 11 || $form_type == 12) User @else Email @endif ID {{$email}} and Password {{$password}} .
    To avail the required service, kindly login with the mentioned login credentials and furnish necessary details .</p>
    <br>
    @if($form_type == 4)
    <p>Login  URL: {{  url('') }}</p>
    @elseif($form_type == 5)
    <p>Login  URL: https://khelsathi.in/</p>
    @elseif($form_type == 11)
    <p>Login  URL: https://khelsathi.in/</p>
    @elseif($form_type == 21 || $form_type == 22)
    <p>Login  URL: https://khelsathi.in/</p>
    @else
    <p>Login  URL: {{  url('') }}</p>
    @endif
    <br>
    {{-- <p>For any technical support regarding the software, contact our Helpline No. +91XXXXXXX or Email your query to sport@gmail.com.</p> --}}
    <br>
    <br>
    <p>Regards,</p>
    <p>Department of Sports, Uttar Pradesh</p>
    <br>
</body>

</html>
