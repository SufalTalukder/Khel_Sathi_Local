@extends('layouts/admin_layout')
@section('content')
<style>
    .mr-2 {
        margin-right: 4px !important;
    }

    .pagebody.sidepage-pading {
        padding: 0px 0px 0px 0px !important;
    }
</style>
  
  <div class="container-fluid pagecontentbody">
            <div class="tab-content">
                <div class="pagebody removebg-color">
                    <div class="pageheader">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="mb-0">Dashboard</h4>
                            </div>
                            <div class="col-md-2 d-grid">
                                <!--<a class="btn btn-sm btn-dark" href="ApplicationForm.html"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Form</a>-->
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5> List of Applications</h5>
                                        <!-- <h5> {{$title_h}} ApplicationsList</h5> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                 <div class="table-responsive" style="max-height: 350px;">
                                     <table  id="dataTable" class="table table-bordred table-hover bg-white">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Total Application Received</th>
                                            <th>Total Application Forwarded</th>
                                            <th>Total Pending Applications</th>
                                            <th>Total Accepted Applications</th>
                                            <th>Total Rejected Applications</th>
                                            <th>Application Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @if($list != 0)
                                            <td>1</td>
                                            <td>{{$list}}</td>
                                            <td>0</td>
                                            <td>{{$list}}</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>pending</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>  
                                  </div>                          
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection
