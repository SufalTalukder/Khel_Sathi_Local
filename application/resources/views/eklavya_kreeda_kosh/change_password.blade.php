@extends( 'layouts\eklavya_kreeda_kosh_dashboard_layout' )
@section('content')


<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
    <div class="row">
      <div class="col-12">
        <div class="pageheader" id="menu-margin">
          <h4 class="mb-0">Change Password <a href="{{ route('eklavya_kreeda_kosh_dashboard')}}"


												 class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"

				><span class="icons icon-arrow-left"></span>Back to Dashboard</a></h4>
        </div>
      </div>
      <div class="col-md-12 mb-0">
        <div class="card">
            <form action="{{ route('eklavya_kreeda_kosh_changepasswordStore') }}" id="eklsubmit" class="needs-validation" novalidate method="post">
          <div class="card-body">
            <div class="row">
              <div class="mb-1 col-md-3">
                <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                  <input type="password" placeholder="Password" class="form-control" name="old_password" id="password-field1" required>
                  @error('old_password')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                  <span toggle="#password-field1" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
              </div>
              <div class="mb-1 col-md-3">
                <label for="exampleFormControlInput2" class="form-label">New Password</label>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                  <input type="password" placeholder="Password" class="form-control" name="new_password" id="password-field" required>
                  @error('new_password')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                  <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
              </div>
              <div class="mb-1 col-md-3">
                <label for="exampleFormControlInput3" class="form-label">Confirm Password</label>
                <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                  <input type="password" placeholder="Password" name="confirm_password"  class="form-control" id="password-field2" required>
                  @error('confirmpassword')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                  <span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span> </div>
              </div>
              <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <br>
                <button type="submit" class="btn btn-outline-danger rounded-pill">Change Password</button> </div>
            </div>
            {{-- <p>Last Changed 7/29/2020, 9:50 am</p> --}}
          </div>
        </form>
        </div>
      </div>
    </div>
    </div>
  </div>

  @endsection


  @push('custom-scripts')
  <script>


  $("#eklsubmit").submit(function (e) {

  e.preventDefault();
  if ($("#eklsubmit")[0].checkValidity() === false) {
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
  $("#eklsubmit").addClass("was-validated");
  });

  </script>
  @endpush


