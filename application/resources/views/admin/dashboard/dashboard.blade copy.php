@extends('layouts/admin_layout')
@section('content')

   
   <div class="container-fluid pagecontentbody">
            <div class="tab-content">
                <div class="pagebody removebg-color row">
                    <div class="pageheader">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="mb-0">Dashboard</h4>
                            </div>
                            <div class="col-md-2 d-grid">
                                <a class="btn btn-sm btn-dark" href="{{route('applicantDashboard')}}"><i class="fa fa-plus"></i>&nbsp;&nbsp; List of Applicant</a>
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                  <p class="card-text">Online Request For Direct Recruitment of Players as Gazetted Officers</p>
                                  <a href="{{route('directRecruitmentPlayers')}}" class="btn btn-primary">View Report</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                  <p class="card-text">Online Request For Financial Assistance to Former Sports Person of UP</p>
                                  <a href="{{route('formerSportsPerson')}}" class="btn btn-primary">View Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                  <p class="card-text">Laxman/Rani Laxmi Bai Award</p>
                                  <a href="{{route('awardList')}}" class="btn btn-primary">View Report</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                  <p class="card-text">Award to 1st, 2nd & 3rd Position Holders at National/International Level </p>
                                  <a href="{{route('positionHolders')}}" class="btn btn-primary">View Report</a>
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

@push('custom-scripts')
<script type="text/javascript">
    $(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('projectlist') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },
                {
                    data: 'project_id',
                    name: 'project_id'
                },
                {
                    data: 'project_name',
                    name: 'project_name'
                },
                {
                    data: 'application_date',
                    name: 'application_date'
                },
                {
                    data: 'current_status',
                    name: 'current_status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'view',
                    name: 'view',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
@endpush