@extends('layouts/admin_layout')
@section('content')

               <div class="pageheader" id="menu-margin">
				    <h4> Admission Detail Edit

                        <a href="{{ url('collegeadmin/dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end  mr-2"><span class="icons icon-arrow-left"></span>Back/पीछे</a>


                      </h4>

		</div>
        <div class="card">

            <div class="card-body">
                <div class="table-responsive" id="examples">   <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                    <tr>
                        <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                            <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                            <!-- <img src="{{ url('onlineAdmission') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                <div style="font-size: 3vw; font-weight: bold;">
                                    <!-- Department of Sports -->
                                    Khel Sathi Portal
                                </div>
                                <div style="font-size: 2vw; font-weight: bold;">
                                    Government of Uttar Pradesh
                                </div>
                                <div style="font-size: 2vw; font-weight: bold;">
                                  Sport College online application form 2024-25
                                </div>
                            </div>
                        </td>
                    </tr>



                    <form action="" method="post"></form>



                    </div>
            </div>
        </div>




@endsection
@push('custom-scripts')

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
//=============================
function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }

</script>
@endpush
