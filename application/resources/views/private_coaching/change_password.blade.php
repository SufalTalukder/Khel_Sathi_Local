@extends( 'layouts\private_coaching_auth_layout' )
@section('content')

<style>

    </style>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <div class="container-fluid pagecontentbody">
    <div class="row">
      <div class="col-12 mt-10" >

        <div class="tab-content border-all-side">
          <div class="pagebody sidepage-pading pt-3 pb-3">

            <div class="card mt-3 mb-3">
              <div class="card-body">
                <form action="{{ route('private_coaching_change_password_store') }}"   class="needs-validation" id="submitform" novalidate method="POST">
                  @csrf
                  <div class="row">
                  <div class="mb-1 col-md-4">
                    <label for="exampleFormControlInput1" class="form-label">Current Password
                    <span class="text-danger">*</span></label>
                    <div class="input-group mb-4"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                      <input type="password" name="old_password" required  maxlength="15" class="form-control" id="password-field1">
                      <span toggle="#password-field1" class="input-group-text toggle-password1 toggle-password fa fa-fw fa-eye"></span> </div>
                  </div>
                  <div class="mb-1 col-md-4">
                    <label for="exampleFormControlInput2" class="form-label">New Password
                    <span class="text-danger">*</span></label>
                    <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                      <input id="password" name="password" maxlength="15" required type="password" class="form-control input-md" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
                      <span toggle="#password" class="input-group-text toggle-password toggle-password3 fa fa-fw fa-eye"></span> </div>
                   <div class="invalid-feedback">
												Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
											</div>
                    </div>
                  <div class="mb-1 col-md-4">
                    <label for="exampleFormControlInput3" class="form-label">Retype New Password
                    <span class="text-danger">*</span></label>
                    <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                      <input type="password" name="password_confirmation" maxlength="15" id="confirm-password" required  class="form-control" id="password-field2">
                      <span toggle="#confirm-password" class="input-group-text toggle-password toggle-password2 fa fa-fw fa-eye"></span> </div>
                    <span class="text-danger" id="mismatch"></span> </div>
                  <div id="popover-password">
                    <p>Password Strength: <span id="result"> </span></p>
                    {{-- <div class="progress">
                      <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%"> </div>
                    </div> --}}
                    <ul class="list-unstyled">
                      <li class=""><span class="upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span>  01 Upper Case Character</li>
                      <li class=""><span class="low-case"><i class="fa fa-file-text" aria-hidden="true"></i></span> 01 Lower Case Character</li>
                      <li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> 01 Numeric Character</li>
                      <li class=""><span class="one-special-char"><i class="fa fa-file-text" aria-hidden="true"></i></span> 01 Special Character</li>
                      <li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span> At least 08 Characters</li>
                    </ul>
                  </div>
                  <div class="col-md-3">
                  <label class="form-label">&nbsp;</label>
                  <br>
                  <button type="submit" id="change_password1" class="btn btn-info">
                  Change Password</a>
                  </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function  check_password(value)
     {
       const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$/gm;
       if (!regex.test(value))
          alert('Minimum eight and maximum 15 characters, at least one uppercase letter, one lowercase letter, one number and one special character');
     }


   </script>
   <script>
    window.onload=()=>{


         $('#password').keyup(function() {

             var password = $('#password').val();
             $('#change_password1').attr('disabled', true);
             if(password=='')
             {  console.log('password');
               // $('#result').removeClass()
               // $('#password-strength').removeClass();

             }
             if (checkStrength(password) == false) {

                 $('#change_password1').attr('disabled', true);
             }
         });
         $('#confirm-password').keyup(function() {
              var password=$('#password').val();

             if ( password!== $('#confirm-password').val()) {
                  $("#mismatch").text('Password Mismatched');
                 $('#change_password1').attr('disabled', true);
             } else {
               $("#mismatch").text('');
               $('#change_password1').attr('disabled', false);
             }
         });




         function checkStrength(password) {
             var strength = 0;
             if (password.match(/([a-z])/) || (password.match(/([0-9])/) && password.match(/([a-z])/))) {
                 strength += 1;
                 $('.low-case').addClass('text-success');
                 $('.low-case i').removeClass('fa-file-text').addClass('fa-check');
                 $('#popover-password-top').addClass('hide');


             } else {
                 $('.low-case').removeClass('text-success');
                 $('.low-case i').addClass('fa-file-text').removeClass('fa-check');
                 $('#popover-password-top').removeClass('hide');
             }

             if (password.match(/([A-Z])/) || (password.match(/([0-9])/) && password.match(/([A-Z])/))) {
                 strength += 1;
                 $('.upper-case').addClass('text-success');
                 $('.upper-case i').removeClass('fa-file-text').addClass('fa-check');
                 $('#popover-password-top').addClass('hide');


             } else {
                 $('.upper-case').removeClass('text-success');
                 $('.upper-case i').addClass('fa-file-text').removeClass('fa-check');
                 $('#popover-password-top').removeClass('hide');
             }

             if ((password.match(/([0-9])/)) || (password.match(/([0-9])/) && password.match(/([a-zA-Z])/))) {
                 strength += 1;
                 $('.one-number').addClass('text-success');
                 $('.one-number i').removeClass('fa-file-text').addClass('fa-check');
                 $('#popover-password-top').addClass('hide');

             } else {
                 $('.one-number').removeClass('text-success');
                 $('.one-number i').addClass('fa-file-text').removeClass('fa-check');
                 $('#popover-password-top').removeClass('hide');
             }
             if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
                 strength += 1;
                 $('.one-special-char').addClass('text-success');
                 $('.one-special-char i').removeClass('fa-file-text').addClass('fa-check');
                 $('#popover-password-top').addClass('hide');

             } else {
                 $('.one-special-char').removeClass('text-success');
                 $('.one-special-char i').addClass('fa-file-text').removeClass('fa-check');
                 $('#popover-password-top').removeClass('hide');
             }

             if (password.length > 7) {
                 strength += 1;
                 $('.eight-character').addClass('text-success');
                 $('.eight-character i').removeClass('fa-file-text').addClass('fa-check');
                 $('#popover-password-top').addClass('hide');

             } else {
                 $('.eight-character').removeClass('text-success');
                 $('.eight-character i').addClass('fa-file-text').removeClass('fa-check');
                 $('#popover-password-top').removeClass('hide');
             }

             if (strength < 2) {
                 $('#result').removeClass()
                 $('#password-strength').addClass('progress-bar-danger');

                 $('#result').addClass('text-danger').text('Very Weak');
                 $('#password-strength').css('width', '10%');
             } else if (strength == 2) {
                 $('#result').addClass('good');
                 $('#password-strength').removeClass('progress-bar-danger');
                 $('#password-strength').addClass('progress-bar-warning');
                 $('#result').addClass('text-warning').text('Weak')
                 $('#password-strength').css('width', '60%');
                 return 'Weak'
             } else if (strength == 4) {
                 $('#result').removeClass()
                 $('#result').addClass('strong');
                 $('#password-strength').removeClass('progress-bar-warning');
                 $('#password-strength').addClass('progress-bar-success');
                 $('#result').addClass('text-success').text('Strength');
                 $('#password-strength').css('width', '100%');

                 return 'Strong'
             }

         }




       $(".toggle-password1").click(function() {
           $(this).toggleClass("fa-eye fa-eye-slash");

       if ($('#password-field1').attr("type") == "password") {
           $('#password-field1').attr("type", "text");
       } else {
           $('#password-field1').attr("type", "password");
       }
       });

       $(".toggle-password3").click(function() {
           $(this).toggleClass("fa-eye fa-eye-slash");

       if ($('#password').attr("type") == "password") {
           $('#password').attr("type", "text");
       } else {
           $('#password').attr("type", "password");
       }
       });


       $(".toggle-password2").click(function() {
           $(this).toggleClass("fa-eye fa-eye-slash");

       if ($('#confirm-password').attr("type") == "password") {
           $('#confirm-password').attr("type", "text");
       } else {
           $('#confirm-password').attr("type", "password");
       }
       });










$("#submitform").submit(function (e) {

e.preventDefault();
if ($("#submitform")[0].checkValidity() === false) {
    e.stopPropagation();
} else {
    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (res) {
            if (res.error == false) {
                success(res.msg);

                window.location.href = res.url;


            } else {
                error(res.msg);
            }
        },
    });
}
$("#submitform").addClass("was-validated");
});

       }




   </script>


   @endsection
