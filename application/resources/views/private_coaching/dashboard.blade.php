@extends('layouts.private_coaching_auth_layout')
@section('content')

    <div class="container-fluid pagecontentbody">
        <div class="tab-content">
            <div class="pagebody removebg-color">
                <div class="col-md-12 pageheader pb-2">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="mb-0">Applicant Details</h4>
                        </div>
                        <div class="col-md-2 d-grid">
                            <a class="btn btn-outline-success" href="{{ route('private_apply_for') }}">
                                <i class="fa fa-plus"></i>&nbsp; Apply For
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        @if(
                                $academyApplication->isEmpty() && $associationApplication->isEmpty() &&
                                $swimmingApplication->isEmpty() && $gymApplication->isEmpty()
                            )
                            <div class="alert alert-info">No applications found.</div>
                        @else
                            <table class="table table-bordred table-hover bg-white">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Type</th>
                                        <th>Application No.</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Institution Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile No.</th>
                                   
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 1; @endphp

                                    <!-- Academy Applications -->
                                    @foreach ($academyApplication as $item)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>Academy</td>
                                            <td>{{ $item->application_no ?? 'N/A' }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->designation }}</td>
                                            <td>{{ $item->institute_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->mobile }}</td>
                                  

                                            <td class="text-center">
                                                @if($item->final_submit == 1)
                                                    @if ($item->status == 1 )
                                                        <button class="btn btn-outline-success btn-sm">Accepted</button>
                                                    @elseif ($item->status == 2 )
                                                        <button class="btn btn-outline-danger btn-sm">Rejected</button>
                                                    @elseif($item->query_status == 2)
                                                        <button class="btn btn-outline-primary btn-sm">Re-Submitted</button>
                                                    @elseif($item->query_status == 1)
                                                        <button class="btn btn-outline-warning btn-sm">Query Marked</button>
                                                    @else
                                                        <span class="badge bg-success">Submitted</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-primary">Pending</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-xs btn-outline-primary"
                                                    href="{{ route('academies_application_preview', $item->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if($item->final_submit != 1)
                                                    <a class="btn btn-xs btn-outline-success"
                                                        href="{{ route('private_coaching_academies', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- Association Applications -->
                                    @foreach ($associationApplication as $item)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>Association</td>
                                            <td>{{ $item->application_no ?? 'N/A' }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->designation }}</td>
                                            <td>{{ $item->institute_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->mobile }}</td>
                          

                                            <td class="text-center">
                                                @if($item->final_submit == 1)
                                                    @if ($item->status == 1 )
                                                        <button class="btn btn-outline-success btn-sm">Accepted</button>
                                                    @elseif ($item->status == 2 )
                                                        <button class="btn btn-outline-danger btn-sm">Rejected</button>
                                                    @elseif($item->query_status == 2)
                                                        <button class="btn btn-outline-primary btn-sm">Re-Submitted</button>
                                                    @elseif($item->query_status == 1)
                                                        <button class="btn btn-outline-warning btn-sm">Query Marked</button>
                                                    @else
                                                        <span class="badge bg-success">Submitted</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-primary">Pending</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-xs btn-outline-primary"
                                                    href="{{ route('private_coaching_application_preview', $item->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if($item->final_submit != 1)
                                                    <a class="btn btn-xs btn-outline-success"
                                                        href="{{ route('private_coaching_application_form', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- Swimming Applications -->
                                    @foreach ($swimmingApplication as $item)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>Swimming Pool</td>
                                            <td>{{ $item->application_no ?? 'N/A' }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->designation }}</td>
                                            <td>{{ $item->institute_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->mobile }}</td>
                                       

                                            <td class="text-center">
                                                @if($item->final_submit == 1)
                                                    @if ($item->status == 1 )
                                                        <button class="btn btn-outline-success btn-sm">Accepted</button>
                                                    @elseif ($item->status == 2 )
                                                        <button class="btn btn-outline-danger btn-sm">Rejected</button>
                                                    @elseif($item->query_status == 2)
                                                        <button class="btn btn-outline-primary btn-sm">Re-Submitted</button>
                                                    @elseif($item->query_status == 1)
                                                        <button class="btn btn-outline-warning btn-sm">Query Marked</button>
                                                    @else
                                                        <span class="badge bg-success">Submitted</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-primary">Pending</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-xs btn-outline-primary"
                                                    href="{{ route('swimming_pool_application_preview', $item->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if($item->final_submit != 1)
                                                    <a class="btn btn-xs btn-outline-success"
                                                        href="{{ route('private_coaching_swimming_pool', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- Gym Applications -->
                                    @foreach ($gymApplication as $item)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>Gym</td>
                                            <td>{{ $item->application_no ?? 'N/A' }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->designation }}</td>
                                            <td>{{ $item->institute_name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->mobile }}</td>
                                   

                                            <td class="text-center">
                                                @if($item->final_submit == 1)
                                                    @if ($item->status == 1 )
                                                        <button class="btn btn-outline-success btn-sm">Accepted</button>
                                                    @elseif ($item->status == 2 )
                                                        <button class="btn btn-outline-danger btn-sm">Rejected</button>
                                                    @elseif($item->query_status == 2)
                                                        <button class="btn btn-outline-primary btn-sm">Re-Submitted</button>
                                                    @elseif($item->query_status == 1)
                                                        <button class="btn btn-outline-warning btn-sm">Query Marked</button>
                                                    @else
                                                        <span class="badge bg-success">Submitted</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-primary">Pending</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <a class="btn btn-xs btn-outline-primary"
                                                    href="{{ route('gyms_application_preview', $item->id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if($item->final_submit != 1)
                                                    <a class="btn btn-xs btn-outline-success"
                                                        href="{{ route('private_coaching_gyms', $item->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentnote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Note</h5>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Registration Fees - <span class="text-danger"><i
                                class="fa fa-rupee-sign"></i>5500.00</span></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Proceed To Pay</button>
                </div>
            </div>
        </div>
    </div>

@endsection
