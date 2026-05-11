@extends( 'layouts/coaching_camp_auth' )
@section('content')
{{-- <div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <form action="{{route('coaching_camp_changepasswordStore')}}" id="formsubmit" class="needs-validation" novalidate method="post">
@csrf
    <div class="row">
      <div class="col-12">
        <div class="pageheader" id="menu-margin">
          <h4 class="mb-0">Change Password</h4>
        </div>
      </div>
      <div class="col-md-12 mb-0">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="mb-1 col-md-3">
                <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                    <input type="password" placeholder="Password/पासवर्ड" name="old_password" class="form-control text-start" id="password-field1" value="{{old('oldpassword')}}" required>
                    <span toggle="#password-field1" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
              </div>
              <div class="mb-1 col-md-3">
                <label for="exampleFormControlInput2" class="form-label">New Password</label>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                    <input type="password" placeholder="Password/पासवर्ड" name="new_password" minlength="8" class="form-control text-start" id="password-field" value="{{old('newpassword')}}" required>
                    <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
              </div>
              <div class="mb-1 col-md-3">
                <label for="exampleFormControlInput3" class="form-label">Create Password</label>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                    <input type="password" placeholder="Password/पासवर्ड" minlength="8" name="confirm_password" class="form-control text-start" id="password-field2" value="{{old('confirmpassword')}}" required>
                    <span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
              </div>
              <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <br>
                <button type="submit" class="btn btn-outline-danger rounded-pill">Change Password</button>
            </div>
            </div>

          </div>
        </div>
      </div>
    </div>
</form>
    </div>
  </div>
  @endsection

  @push('custom-scripts')

  <script>



      $("#formsubmit").submit(function (e) {

          e.preventDefault();
          if ($("#formsubmit")[0].checkValidity() === false) {
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
          $("#formsubmit").addClass("was-validated");
      });




      </script>
  @endpush

 --}}



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container-fluid pagecontentbody">
  <div class="row">
    <div class="col-12">
      {{-- <div class="col-md-12 pageheader mb-0">

            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('student.profile')}}">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
              </ol>
            </nav>

      </div> --}}
      <div class="tab-content border-all-side">
        <div class="pagebody sidepage-pading pt-3 pb-3">
          <div class="p-2 alert alert-danger text-center"><b>Note:- Due to security reasons, please change your auto-generated password before proceeding further./सुरक्षा कारणों से, कृपया आगे बढ़ने से पूर्व अपना स्वतः जनित पासवर्ड बदलें। </b></div>
          <div class="card mt-3 mb-3">
            <div class="card-body">
                <form action="{{route('coaching_camp_changepasswordStore')}}" id="formsubmit" class="needs-validation" novalidate method="post">
                    @csrf
                <div class="row">
                <div class="mb-1 col-md-4">
                  <label for="exampleFormControlInput1" class="form-label">Current Password/वर्तमान पासवर्ड
                  <span class="text-danger">*</span></label>
                  <div class="input-group mb-4"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                    <input type="password" name="old_password" required  maxlength="15" class="form-control" id="password-field1">
                    <span toggle="#password-field1" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
                </div>
                <div class="mb-1 col-md-4">
                  <label for="exampleFormControlInput2" class="form-label">New Password/नया पासवर्ड
                  <span class="text-danger">*</span></label>
                  <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                    <input id="password" name="new_password" maxlength="15" required type="password" class="form-control input-md" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
                    <span toggle="#password" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
                </div>
                <div class="mb-1 col-md-4">
                  <label for="exampleFormControlInput3" class="form-label">Retype New Password/नया पासवर्ड पुनः भरें
                  <span class="text-danger">*</span></label>
                  <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                    <input type="password" name="confirm_password" maxlength="15" id="confirm-password" required  class="form-control" id="password-field2">
                    <span toggle="#confirm-password" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
                  <span class="text-danger" id="mismatch"></span> </div>
                <div id="popover-password">
                  <p>Password Strength: <span id="result"> </span></p>
                  {{-- <div class="progress">
                    <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%"> </div>
                  </div> --}}
                  <ul class="list-unstyled">
                    <li class=""><span class="low-upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span> 01 Lower and 01 Upper Case Character/01 अपर व 01 लोअर केस का वर्ण</li>
                    <li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> 01 Numeric Character/01 संख्यात्मक वर्ण</li>
                    <li class=""><span class="one-special-char"><i class="fa fa-file-text" aria-hidden="true"></i></span> 01 Special Character/01 विशेष वर्ण</li>
                    <li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span> At least 08 Characters/न्यूनतम 08 वर्ण</li>
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
@endsection
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
          {
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
          if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
              strength += 1;
              $('.low-upper-case').addClass('text-success');
              $('.low-upper-case i').removeClass('fa-file-text').addClass('fa-check');
              $('#popover-password-top').addClass('hide');


          } else {
              $('.low-upper-case').removeClass('text-success');
              $('.low-upper-case i').addClass('fa-file-text').removeClass('fa-check');
              $('#popover-password-top').removeClass('hide');
          }

          if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
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
    }

</script>

