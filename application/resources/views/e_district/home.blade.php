<html lang="en">
<head>
  <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ asset('public/e-district/css/mian-landing.css') }}" rel="stylesheet">
    <link href="{{ asset('public/e-district/css/Bootstrapv4.css') }}" rel="stylesheet">
</head>
  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-light bg-cstm static-top">
      <div class="container">
        <div class="logo-header mostion"><a href="#" class="dez-page"><img src="{{ asset('public/e-district/img/logo6.png') }}" alt="Integrated Platform for Department of Tourism"></a>
          </div>
      </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead text-white text-center mt-4">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1>UP Sports Department Schemes</h1>
          </div>
        </div>
      </div>
    </header>

    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
      <div class="container">
        <div class="row">
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Sr. No.</th>
                  <th scope="col">List of Departmental Schemes 2024-2025</th>
                  @if(Session::get('sessDetails') && Session::get('sessDetails')['RequestKey'])
                  <th scope="col">Apply for the Schemes</th>
                  @endif
                  <th scope="col">Application Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Monthly financial assistance to former famous players of the state</td>
                  @if(Session::get('sessDetails') && Session::get('sessDetails')['RequestKey'])
                  <td class="text-center"><a href="{{ route('signUp',16601) }}" target="_blank" class="green external" rel="nofollow noopener noreferrer">Apply Now</a></td>
                  @endif
                  <td class="text-center"><a href="javascript:void(0)"  class="gray external"  onclick="checkStatus(16601)">Check Status</a></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Prize Money for 1st, 2nd and 3rd position holder in National and International Competitions</td>
                  @if(Session::get('sessDetails') && Session::get('sessDetails')['RequestKey'])
                  <td class="text-center"><a href="{{ route('signUp',16602) }}" target="_blank" class="green external" rel="nofollow noopener noreferrer">Apply Now</a></td>
                  @endif
                  <td class="text-center"><a href="javascript:void(0)"  class="gray external"  onclick="checkStatus(16602)">Check Status</a></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Laxman and Rani Laxmi Bai Award</td>
                  @if(Session::get('sessDetails') && Session::get('sessDetails')['RequestKey'])
                  <td class="text-center"><a href="{{ route('signUp',16603) }}" target="_blank" class="green external" rel="nofollow noopener noreferrer">Apply Now</a></td>
                 @endif
                  <td class="text-center"><a href="javascript:void(0)" class="gray external"  onclick="checkStatus(16603)">Check Status</a></td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>Appointment of medal-winning players in International games to gazetted posts as per Uttar Pradesh International Medal Winner Direct Recruitment Rules, 2022</td>
                  @if(Session::get('sessDetails') && Session::get('sessDetails')['RequestKey'])
                  <td class="text-center"><a href="{{ route('signUp',16604) }}" target="_blank" class="green external" rel="nofollow noopener noreferrer">Apply Now</a></td>
                 @endif
                  <td class="text-center"><a href="javascript:void(0)"  class="gray external"  onclick="checkStatus(16604)">Check Status</a></td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>Admission in Sports College</td>
                  @if(Session::get('sessDetails') && Session::get('sessDetails')['RequestKey'])
                  <td class="text-center"><a href="{{ route('onlineAdmission.register',16605) }}" target="_blank" class="green external" rel="nofollow noopener noreferrer">Apply Now</a></td>
                 @endif
                  <td class="text-center"><a href="javascript:void(0)"class="gray external"  onclick="checkStatus(16605)">Check Status</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
      <!-- Modal -->
<div class="modal exampleModal" id="exampleModal" >
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check Application Status</h5>
        <button type="button" class="close" onclick="closestatus()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="{{ route('e_district_application_status') }}" method="post" id="reloadd" class="needs-validation" novalidate >
            @csrf
        <div class="row">


        <div class="col-md-12">
          <div class="form-group mb-3">
            <input type="hidden" class="form-control" name="servicecode" id="servicecodeid" value="">
            <label class="placeholder">Enter Application Number </label>
            <input type="number" class="form-control" name="applicationNo" id="applicationNo" required>
          </div>
        </div>

        <div class="col-md-3 mt-4">
          <button type="submit" class="btn btn-success mt-2">Submit</button>
        </div>
    </div>
    </form>
    <div id="responsestatus">

    </div>

        {{-- <div class="alert alert-warning" role="alert">Your Application is In-process</div>
        <div class="alert alert-success" role="alert">Your Application is Accepted</div>
        <div class="alert alert-danger" role="alert">Your Application is Rejected</div> --}}
      </div>

      <!--<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>-->
    </div>
  </div>
</div>

<div class="modal exampleModal" id="exampleModal1" >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Check Application Status</h5>
          <button type="button" class="close" onclick="closestatus()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="{{ route('e_district_application_status') }}" method="post" id="reloaddd" class="needs-validation" novalidate >
              @csrf
          <div class="row">


          <div class="col-md-12">
            <div class="form-group mb-3">
              <input type="hidden" class="form-control" name="servicecode" id="servicecodeid1" value="">
              <label class="placeholder">Enter Application Number </label>
              <input type="number" class="form-control" name="applicationNo" id="applicationNo1" required>
            </div>
          </div>
          <div class="col-md-12">
              <div class="form-group mb-3">
                <label class="placeholder">Gender</label>
               <select name="gender" class="form-control"  required>
                  <option value=""> Select</option>
                  <option value="1">Male</option>
                  <option value="2">Female</option>
               </select>
              </div>
            </div>
          <div class="col-md-3 mt-4">
            <button type="submit" class="btn btn-success mt-2">Submit</button>
          </div>
      </div>
      </form>
      <div id="responsestatus1">

      </div>

          {{-- <div class="alert alert-warning" role="alert">Your Application is In-process</div>
          <div class="alert alert-success" role="alert">Your Application is Accepted</div>
          <div class="alert alert-danger" role="alert">Your Application is Rejected</div> --}}
        </div>

        <!--<div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>-->
      </div>
    </div>
  </div>
    <!-- Footer -->
    <footer class="footer">
      <div class="pd-15">
        <div class="row">
            <div class="col-lg-12 h-100 text-center my-auto">
              <p class="text-white mb-4 mb-lg-0">This is the official Website of Department of Sports, State Government of Uttar Pradesh, India.</p>
              <p>Content on this website is published and managed by Department of Sports, UP State Government.</p>
              <p>© Department of Sports, U.P., India | All rights reserved.</p>
            </div>
          </div>
      </div>
    </footer>
  </body>

  <script src="{{ asset('public/e-district/js/jquery-min.js') }}"></script>
  <script src="{{ asset('public/e-district/js/bootstrap.js') }}"></script>
  <script>
    function checkStatus(serviceCode){

        closestatus();


        if(serviceCode == 16603){
   $("#servicecodeid1").val(serviceCode);
    $('#applicationNo1').val('');
    $("#responsestatus1").empty();
     $('#exampleModal1').show();
        }else{
            $("#servicecodeid").val(serviceCode);
       $('#applicationNo').val('');
       $("#responsestatus").empty();
        $('#exampleModal').show();
        }




    }

    function closestatus(){
        $('.exampleModal').hide();
    }


    $("#reloadd").submit(function (e) {


        e.preventDefault();
        $("#responsestatus").empty();

        if ($("#reloadd")[0].checkValidity() === false) {
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

                                    if(res.msg == 1){
                                        $("#responsestatus").append('<div class="alert alert-success" role="alert">Your Application is Accepted</div>');

                                    }else if(res.msg == 2){
                                        $("#responsestatus").append('<div class="alert alert-danger" role="alert">Your Application is Rejected</div>');

                                     }else{
                                        $("#responsestatus").append('<div class="alert alert-warning" role="alert">Your Application is In-process</div>');
                                    }




                                } else {
                                    $("#responsestatus").append(' <div class="alert alert-danger" role="alert">No Record Found.</div>');
                                }

                                $('#applicationNo').val('');
                        },
                });
        }
        $("#reloadd").addClass("was-validated");
});


$("#reloaddd").submit(function (e) {


e.preventDefault();
$("#responsestatus1").empty();

if ($("#reloaddd")[0].checkValidity() === false) {
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

                            if(res.msg == 1){
                                $("#responsestatus1").append('<div class="alert alert-success" role="alert">Your Application is Accepted</div>');

                            }else if(res.msg == 2){
                                $("#responsestatus1").append('<div class="alert alert-danger" role="alert">Your Application is Rejected</div>');

                             }else{
                                $("#responsestatus1").append('<div class="alert alert-warning" role="alert">Your Application is In-process</div>');
                            }




                        } else {
                            $("#responsestatus").append(' <div class="alert alert-danger" role="alert">No Record Found.</div>');
                        }

                        $('#applicationNo').val('');
                },
        });
}
$("#reloaddd").addClass("was-validated");
});
  </script>
</html>
