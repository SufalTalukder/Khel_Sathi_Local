@extends( 'layouts\eklavya_kreeda_kosh_dashboard_layout' )
@section('content')
<div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="col-md-12 pageheader pb-2">
                <div class="row">
                    <div class="col-md-9">
                        <h4 class="mb-0">Dashboard/डैशबोर्ड</h4>
                    </div>
                    <div class="col-md-3 d-grid">
                        <a class="btn btn-outline-danger btn-sm  rounded-pill" href="{{ route('eklavya_kreeda_kosh_applicationpreview') }}"><i class="fa fa-plus"></i>&nbsp; Application Preview</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h5>Applicant Details/आवेदक का विवरण</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordred table-hover bg-white">
                        <thead>
                            <tr >
                                <th class="ellipsis">S.No.</th>
                                <th class="ellipsis">Puprose</th>
                                <th class="ellipsis">Application No.</th>
                                <th class="ellipsis">Applicant Name</th>
                                <th class="ellipsis">District</th>
                                <th class="ellipsis">DOB</th>
                                <th class="ellipsis">Sport Level</th>
                                <th class="text-center" style="width:10%;">Sport Name</th>
                                <th class="text-center" style="width:10%;">Query Status</th>
                                <th class="text-center" style="width:10%;">Status</th>
                                <th class="text-center" style="width:10%;">Application Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php //dd(Auth::guard('EklavyaKreedaKosh')->user()); ?>
                                <td>1</td>
                                <td class="ellipsis"><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#Puprose">
                                        <i class="far fa-eye"></i>
                                    </button></td>
                                <td>@if (Auth::guard('EklavyaKreedaKosh')->user()->application_no)
                                    {{ Auth::guard('EklavyaKreedaKosh')->user()->application_no }}
                                @else
                                    NA
                                @endif</td>
                                <td> {{ Auth::guard('EklavyaKreedaKosh')->user()->name }}</td>
                                <td>{{ districtName($applicationview->permanent_district) }}</td>
                                <td>{{ dmy($applicationview->dob) }}</td>
                                <td>Applicant's Sport Level</td>
                                <td>Applicant's Sport Name</td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">NA</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Submitted successfully</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white rounded-pill ">NA</span>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>2</td>
                                <td class="ellipsis"><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#Puprose">
                                        <i class="far fa-eye"></i>
                                    </button></td>
                                <td>SG001</td>
                                <td>Avinash Verma</td>
                                <td>Lucknow</td>
                                <td>24/07/2000</td>
                                <td>Applicant's Sport Level</td>
                                <td>Applicant's Sport Name</td>
                                <td class="text-center">
                                    <span class="badge bg-danger rounded-pill">Not Marked</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger rounded-pill"> Incomplete Form</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary text-white rounded-pill">Directorate Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="ellipsis"><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#Puprose">
                                        <i class="far fa-eye"></i>
                                    </button></td>
                                <td>SG001</td>
                                <td>Avinash Verma</td>
                                <td>Lucknow</td>
                                <td>24/07/2000</td>
                                <td>Applicant's Sport Level</td>
                                <td>Applicant's Sport Name</td>
                                <td class="text-center">
                                    <span class="badge bg-warning text-white rounded-pill">Replied</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger rounded-pill"> Incomplete Form</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Accepted Successfully</span>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="ellipsis"><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#Puprose">
                                        <i class="far fa-eye"></i>
                                    </button></td>
                                <td>SG001</td>
                                <td>Avinash Verma</td>
                                <td>Lucknow</td>
                                <td>24/07/2000</td>
                                <td>Applicant's Sport Level</td>
                                <td>Applicant's Sport Name</td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white rounded-pill ">Pending</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Submitted successfully</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white rounded-pill ">RSO Pending</span>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Puprose" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Puprose</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">@if ($applicationview->purpose == 1)
                    Provide fellowships to athletes to enhance their performance and motivation.
                        @elseif ($applicationview->purpose == '2')
                           Prepare athletes for National and International competitions.


                        @elseif ($applicationview->purpose == 3)
                           Offer International Training opportunities and expertise to both Athletes and Coaches.

                        @elseif ($applicationview->purpose == 4)
                      Ensure that athletes have access to comprehensive Health Insurance coverage.

                        @elseif ($applicationview->purpose == 5)
                        Fund “Sports Research Projects” through financial grants.

                        @elseif ($applicationview->purpose == 6)
                        Allocate additional incentives for athletes with disabilities, transgender athletes, and female athletes.

                        @elseif ($applicationview->purpose == 7)
                        Organize promotional visits for sports organizations to districts in UP for talent hunting.

                        @elseif ($applicationview->purpose == 8)
                        Supply athletes with the necessary sports equipment they require.
                    @endif</p>
            </div>

        </div>
    </div>
</div>


@endsection
