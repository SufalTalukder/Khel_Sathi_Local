<!DOCTYPE html>
<html>

<head>
    <title>Confrimation Mail</title>
</head>

<body>
<?php $session_detail = session()->get('session_detail'); ?>
  
    <p>Dear {{$name}},</p>
    <br>
    @if($session_detail['form_status']==1)
        @if($session_detail['form_type'] == 1)
        <p>Your form has been accepted for <b>Laxman Award</b>.</p>
        @elseif($session_detail['form_type'] == 2)
        <p>Your form has been accepted for <b>Ranilaxmibai Award</b>.</p>
        @elseif($session_detail['form_type'] == 3)
        <p>Your form has been accepted for <b>Prize Money</b>.</p>
        @elseif($session_detail['form_type'] == 4)
        <p>Your form has been accepted for <b>Financial Assistance</b>.</p>
        @elseif($session_detail['form_type'] == 5)
        <p>Your form has been accepted for <b>Monthly Pension</b>.</p>
        @elseif($session_detail['form_type'] == 7)
        <p>Your form has been accepted for <b>Eklavya Krida Kosh</b>.</p>
        @endif
    @endif

    @if($session_detail['form_status']==2)
        @if($session_detail['form_type'] == 1)
        <p>Your form has been rejected for <b>Laxman Award</b>.</p>
        @elseif($session_detail['form_type']== 2)
        <p>Your form has been rejected for <b>Ranilaxmibai Award</b>.</p>
        @elseif($session_detail['form_type']== 3)
        <p>Your form has been rejected for <b>Prize Money</b>.</p>
        @elseif($session_detail['form_type']== 4)
        <p>Your form has been rejected for <b>Financial Assistance</b>.</p>
        @elseif($session_detail['form_type']== 5)
        <p>Your form has been rejected for <b>Monthly Pension</b>.</p>
        @elseif($session_detail['form_type'] == 7)
        <p>Your form has been accepted for <b>Eklavya Krida Kosh</b>.</p>
        @endif
    @endif
    <br>
    <p>Regards,</p>
    <p>Department of Sports, Uttar Pradesh</p>
    <br>
</body>

</html>
