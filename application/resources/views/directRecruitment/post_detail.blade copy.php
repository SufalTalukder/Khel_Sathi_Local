<!DOCTYPE html>
<html lang="en">

<head>
  <title>Advertisement Post Detail</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <base href="{{ url('/public') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="shortcut icon" href="favicon.png" />
  <link href="{{ asset('/public') }}/admin/css/bootstrap.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/admin/css/all.css" rel="stylesheet" />
  <link href="{{ asset('/public') }}/admin/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/admin/css/custom_theme.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/admin/css/draggle.css" rel="stylesheet">
  <link href="{{ asset('/public') }}/admin/css/default.css" rel="stylesheet">
  <link href="{{ asset('/public') }}/admin/css/responsive.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/admin/css/datepicker.css" rel="stylesheet" media="all" />
  <link href="{{ asset('/public') }}/admin/css/toast.css" rel='stylesheet' />
  <script type="text/javascript" src="{{ asset('/public') }}/admin/js/jquery-min.js"></script>
  <style>
    .advhed{background-color: #ffffff !important;
    color: #009688 !important;
    font-size: 15px;
    font-weight: 500;
    padding: 0 !important;
    line-height: 50px;}
  </style>
</head>

<body class="dashbg">
  <div class="contentwraper">
    <header class="header">
      <div class="container-fluid">
        <div class="row">

          <div class="col-3 col-md-1 b-right">
            <img src="{{ asset('/public') }}/admin/images/logo.png" alt="" class="dash-logo" />
          </div>
					<div class="col-9 col-md-11">
						<div class="row modulebg">
              <div class="col">
                <h4 class="moudlename">Khel Sathi Portal / खेल साथी पोर्टल
				  
				  <span class="department-logo">Online Application Submission for Direct Recruitment as Gazetted Officer/राजपत्रित अधिकारी के रूप में सीधी भर्ती हेतु ऑनलाइन आवेदन</span>
				  
				  </h4>
              </div>
              <div class="col-auto">
                <nav class="navbar navbar-expand-lg topmenu">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                  
                </nav>
              </div>
              <!--nav class="navbar navbar-expand-lg mainmenu">
                <div class="container-fluid p-0">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                  <div class="collapse navbar-collapse" id="Div1">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link module-name" href="#"></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav-->
            </div>
          </div>
        </div>
      </div>
    </header>
    
    <div class="container-fluid pagecontentbody">
      <div class="tab-content">
        <div class="pagebody removebg-color ">
        
			  
			  <div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Advertisement Post Detail  <a href="{{route('drloginForm')}}" class="btn btn-outline-primary float-end btn-xs btn-block proceed">Proceed</a> </h4>
		</div>
			  
         
  
       
              <div class="card">
                <div class="card-body">
                  
        {{-- <div class="table-responsive">
                   	<table  id="dataTable" class="table table-bordred table-hover bg-white "> --}}

                      <?php
                      $i = 0;
                      
                      //dd($data);
                      foreach ($data as $val) {
                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-bordred table-hover bg-white'>";
                        echo "<thead><tr>";
                        echo "<th colspan='7' class='advhed'><b>Advertisment Number : </b> " . $val['advt'] . "</th>";
                        echo "</tr>
                            <tr>
                              <th>Post Name</th>
                              <th width='120px' class='text-center'>Start Date</th>
                              <th width='120px' class='text-center'>End Date</th>
                              <th width='120px' class='text-center'>No. of Posts</th>
                              <th width='120px' class='text-center'>Status</th>
                            </tr>
                        </thead>";
                        foreach ($val['data'] as $val2) {
                          $i++; ?>
                          <tbody>
                            <tr>
                              <td><a style=" text-decoration: none; font-weight: bold; "href="javascript:void(0)"><span class='adv_id' ><?php echo $val2->post_name; ?></span></a></td>
                              {{-- <td><?php $items=sportName($val2->sport_type);?>
                                @foreach($items as $key=>$itemss)
                                @if($key != 0),@endif 
                                {{$itemss->name}}
                                @endforeach
                              </td> --}}
                              <td  class='text-center'><?php echo dmy($val2->start_date);  ?></td>
                              <td  class='text-center'><?php echo dmy($val2->end_date); ?></td>
                              <td  class='text-center'><?php echo ($val2->total_post); ?></td>
                             {{-- <td  class='text-center'>
                                @if($val2->adevertisment_doc !='')
                                @php
                                $img = url('storage/app/public/adevertisment_doc').'/'.$val2->adevertisment_doc;
                                $img1 = url('public/images/images.svg');
                                $doc = explode('.',$val2->adevertisment_doc);
                                if($doc[1]=='pdf')
                                $img1 = url('public/images/pdf.svg');
                                @endphp
                                <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" style=" width: 25px; " class="img-fluid" />
                                @endif
                              </td>--}}
                              <td  class='text-center'>
                                <?php
                                $date = strtotime(date('d-m-Y'));
                                $startdate = strtotime(dmy($val2->start_date));
                                $enddate =  strtotime(dmy($val2->end_date));
                                $chekk=$val2->advertisment_no;
                                // $chekk=str_replace('/','_',$val2->advertisment_no);
                                // dd($date);
                                
                                if ($startdate > $date ) { ?>
                                  <a class="btn btn-outline-primary btn-xs btn-block" href="javascript:void(0)">Not Open</a>
                                <?php }  
                               else if ($startdate <= $date && $date <= $enddate) { ?>
                                <a class="btn btn-outline-primary btn-xs btn-block"  data-id="{{$val['advt']}}">Open</a>
                                  <!-- <a class="btn btn-primary btn-xs btn-block"  >Proceed</a> -->
                                  
                                  <?php } else { ?>
                                    
                                  <a class="btn btn-outline-danger btn-xs btn-block" href="javascript:void(0)">Closed</a>
                                <?php } ?>
                              </td>
                            </tr>
                          </tbody>
                      <?php }?>
                      </table>
                  </div>
                      <?php } ?>
                  
       
                </div>
              </div>
           
        </div>
      </div>
    </div>
    


    <footer>
      <div class="row">
        <div class="col-md-8">
				<ul class="foot-list">
            <li>Copyright &copy; Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
          </ul>
        </div>
        <div class="col-md-4">
				<ul class="foot-list float-end">
            <li>Powered by <a href="http://otpl.co.in/" target="_blank">OmniNet</a></li>
          </ul>
        </div>
      </div>
    </footer>


    <script>
      var ajaxUrl = "{{ url('') }}";
    </script>

    <!-- <script type="text/javascript" src="{{ asset('/public') }}/js/jquery-min.js"></script> -->
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/builder.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/beautifyhtml.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/dragble.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/datepicker.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/datepicker.en.js"></script>
    <script type="text/javascript" src="{{ asset('/public') }}/admin/js/theme-script.js"></script>
    <!-- <script type="text/javascript" src="{{ url('/public') }}/js/sweetalert.js"></script> -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="{{ url('/public') }}/admin/js/toast.js"></script>
    <script type="text/javascript" src="{{ url('/public') }}/admin/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  

    <x-message />

    <script>
      $(".adv_id").click(function() {

        var id = $(this).text();
        console.log(id);
        // alert(id);
      
        $.ajax({
            type: "POST",
            url: ajaxUrl + "/direct-recruitment/advertisment_details",
            data: {id : id},
         
            success: function (res) {
                if (res.error == false) {
                  var first_date = moment(res.data['min_age_from']).format('DD-MM-YYYY');  
                  // console.log(first_date)
                  $('#total_post').html("<b>Total Post :-" +res.data['total_post'] + "</b> <br/> General Post :-" +res.data['general_post']+ " <br/> OBC Post :-" +res.data['obc_post']+ " <br/> SC Post :-" +res.data['sc_post']+ " <br/> ST Post :-" +res.data['st_post']+ " <br/> PWD Post :-" +res.data['pwd_post']+ " <br/> EWS Post :-" +res.data['ews_post']);
                 if(res.data['is_age_relaxation'] == 1){
                  $('#age_relax').html("<b> YES </b> <br/>  OBC Post :-" +res.data['age_relax_obc']+ " <br/> SC Post :-" +res.data['age_relax_sc']+ " <br/> ST Post :-" +res.data['age_relax_st']+ " <br/> PWD Post :-" +res.data['age_relax_pwd']+ " <br/> EWS Post :-" +res.data['age_relax_ews']);
                  }
                 else{
                  $('#age_relax').html("NO");
                 }
                 if(res.data['is_experience_required'] == 1){
                  $('#exp_req').html("<b> YES </b> <br/>  Total Experience :-" +res.data['exp_req']);

                 }
                 else{
                  $('#exp_req').html("NO");

                 }
                  $('#age_from').text( first_date);
                  $('#min_age').text(res.data['min_age']);
                  $('#max_age').text(res.data['max_age']);
                  $('#adv_detail').modal('show');
                } else {
                    error(res.msg);
                }
            },
        });
       
      });
      $(".proceed").click(function() {

            var id = $(this).data("id");
            // console.log($(this).data("id"));

            $.ajax({
                type: "POST",
                url: ajaxUrl + "/direct-recruitment/advertisment-session",
                data: {id : id},
            
                success: function (res) {
                    if (res.error == false) {
                      window.location.href = res.url;
                    } else {
                        error(res.msg);
                    }
                },
            });

            });
     
    </script>
    @stack('custom-scripts')

    <div class="modal fade" id="adv_detail" tabindex="-1" aria-labelledby="adv_detail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="FeasibleLabel">Post Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
 
                <table  id="dataTable" class="table table-bordered table-striped">
                    
                     
                      
                    <thead>
                        <tr>
                          <th>Total Post</th>
                          <th>Age Criteria</th>
                          <th>Age Relaxation</th>
                          <th>Experience Required</th>
                        </tr>
                    </thead>
                      <tbody>
                   
                        <tr>
                          <td style="width: 120px;" id="total_post">
                           
                          </td>
                          <td style="width: 120px;" ><span> Age from Date :- <span id="age_from"></span></span></br><span> Min Age :- <span id="min_age"></span> </span></br><span>Max Age :- <span id="max_age"></span> </span></td>
                          <td style="width: 120px;" id="age_relax"> </td>
                          <td style="width: 120px;" id="exp_req"> </td>
                       
                      </tbody>
                </table>
                </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Submit/दर्ज करे</button> -->
                </div>
        </div>
    </div>
</div>
</body>

</html>