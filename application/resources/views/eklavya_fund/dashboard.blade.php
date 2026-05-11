@extends( 'layouts\eklavya_fund_dashboard_layout' )
@section('content')
   <!-- InstanceBeginEditable name="Content Area" -->
   <div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="col-md-12 pageheader pb-2">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="mb-0">Dashboard</h4>
                    </div>
                    <div class="col-md-2 d-grid">
                        <a class="btn btn-success" href="{{url('eklavyaFund/application_form')}}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Form</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-11">
                                    <h5>Applicant Details</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 350px;">
                                <table class="table table-bordred table-hover bg-white">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Application No.</th>
                                            <th>Academy Name</th>
                                            <th>Email ID</th>
                                            <th>Sports Name</th>
                                            {{-- <th>Query</th> --}}
                                            <th class="text-center">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fund_data as $key=>$item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->application_no}}</td>
                                            <td>{{ Auth::guard('EklavyaFund')->user()->academy_name  }}</td>
                                            <td>{{ Auth::guard('EklavyaFund')->user()->email  }}</td>
                                            <td>{{ sport_name(Auth::guard('EklavyaFund')->user()->sport_id)  }}</td>
                                            {{-- <td><strong class="btn btn-success btn-xs disabled btn-block">Precessing</strong></td> --}}
                                            <td class="text-center"><a class="btn btn-sm btn-dark" href="{{url('eklavyaFund/application_preview/')}}/{{$item->id}}"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                        @endforeach
                                       
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
<!-- InstanceEndEditable -->


@endsection
