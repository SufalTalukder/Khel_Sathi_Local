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
                                        <h5>List of Applications</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                 <div class="table-responsive" style="max-height: 350px;">
                                     <table  id="dataTable" class="table table-bordred table-hover bg-white">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Application No.</th>
                                            <th>Applicant Name</th>
                                            <th>Email ID</th>
                                            <th>Sports Name</th>
                                            <th>Date of Application</th>
                                            <th>Application Status</th>
                                            <th>Query Status</th>
                                            <th class="text-center">View</th>
                                            <th>Forward to Directorate</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>SG001</td>
                                            <td>avinashverma@gmail.com</td>
                                            <td>1234567891234</td>
                                            <td>Cricket</td>
                                            <td>02/12/2022</td>
                                            <td>Forwarded</td>
                                            <td><a href="#" class="btn btn-primary btn-xs btn-block" data-bs-toggle="modal" data-bs-target="#markedquery5">Marked</a></td>
                                            <td class="text-center"><a class="btn btn-sm btn-dark" href="ApplicationPreviewFinancialAssistance.html"><i class="fa fa-eye"></i></a></td>
                                            <td><a href="#" class="btn btn-success btn-xs btn-block" data-bs-toggle="modal" data-bs-target="#forwardedbtn1">Forward</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>Accepted</td>
                                            <td><span class="btn btn-danger btn-xs disabled">Not Marked</span></td>
                                            <td class="text-center"><a class="btn btn-sm btn-dark" href="ApplicationPreviewMonthlyPension.html"><i class="fa fa-eye"></i></a></td>
                                            <td><span class="btn btn-success btn-xs disabled btn-block">Forward</span></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>Declined</td>
                                            <td><strong class="btn btn-success btn-xs disabled btn-block">Replied</strong></td>
                                            <td class="text-center"><a class="btn btn-sm btn-dark" href="ApplicationPreviewMonthlyPension.html"><i class="fa fa-eye"></i></a></td>
                                            <td><strong class="btn btn-success btn-xs disabled btn-block">Forward</strong></td>
                                        </tr>
                                    </tbody>
                                </table>  
                                  </div>                          
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Camping Evaluation Marks</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: 350px;">
                                     <table  id="dataTable" class="table table-bordred table-hover bg-white">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Activities</th>
                                            <th>Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                         <tr>
                                            <td>4</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </table>    
                                </div>                        
                            </div>
                        </div>
                    </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!--Marked PopUp-->

        <div class="modal fade" id="markedquery5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Query</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center"></h3>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Respond</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
                <!--Forwarded Button-->
                <div class="modal fade" id="forwardedbtn1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Forward to Directorate</h5>
                                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                            </div>
                            <div class="modal-body">
                                <h3 class="text-center"></h3>
                            </div>
                            <div class="modal-footer">
                                <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Yes</button>
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="modal fade" id="paymentnote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment Note</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Registration Fees - <span class="text-success"><i class="fa fa-rupee-sign"></i>5500.00</span></h3>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Proceed To Pay</button>
                    </div>
                </div>
            </div>
        </div>
        
@endsection
