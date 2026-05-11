<table>
    <tbody>
        <tr>
            <th colspan="9" style="text-align:center;background-color: #fdf8f8;font-size: 13px;" height="55">
            <strong> Khel Sathi Portal/खेल साथी पोर्टल </strong><br>
            <strong>Government of Uttar Pradesh/उत्तर प्रदेश सरकार  </strong><br>
            <strong>{{$formName}}</strong>
            </th>
        </tr>
        <tr style="background-color: #fdf8f8;">
            <td colspan="5">
            <strong>Report Period :</strong> {{$data['from_date']}} to {{$data['to_date']}}
            </td>
            <td colspan="4" style="text-align:right;">
            <strong> Report Printed on :</strong> <?= date('d-m-Y'); ?>
            </td>
        </tr>
        <tr style="font-size: 13px;">
            <th>S.No.</th>
            <th>Application No.</th>
            @if($type == 6)
            <th>Post Name</th>
            @endif
            <th>Applicant’s Name</th>
            <th>Email ID</th>
            <th>Sport Name</th>
            <th>Date of Application</th>
            <th>Application Status</th>
            <th>Query Status</th>
            @if($type != 6)
            <th>Amount</th>
            @endif
        </tr>
        @if(count($collection) > 0)
        @foreach($collection as $key=>$list)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$list->application_no}}</td>
            @if($type == 6)
            <td>{{AppliedPostName($list->user_id)}}</td>
            @endif
            <td>{{$list->fullname}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->sportName}}</td>
            <td>{{date('d-m-Y',strtotime($list->created_at))}}</td>
            <td>
                <?php if($list->form_status == 1) { ?>
                <span class="btn btn-success">Accepted</span>
                <?php } elseif($list->form_status == 3) { ?>
                <span class="btn btn-danger">Pending</span>
                <?php } elseif($list->form_status == 2) { ?>
                <span class="btn btn-danger">Declined</span>
                <?php } else { ?>
                <span class="btn btn-warning">Pending</span>
                <?php } ?>
            </td>
            <?php $abc=marked_status( $list->user_id,3);?>
            <td>
                @if(isset($abc) && ($list->form_status == 0) && ($abc->is_closed == 0)) @if(($abc->query_status) == 0)
                <strong class="btn btn-primary btn-xs btn-block">Marked</strong> @else
                <strong class="btn btn-primary btn-xs btn-block">@if($abc->current_status == "User") User @endif Replied</strong> @endif @else
                <strong class="btn btn-danger btn-xs disabled">Not Marked</strong> @endif
            </td>
            @if($type != 6)
            <td>
                <?php if($list->is_forwarded_by_rso == 1) { ?>
                <?php if($list->amount_release_status == 1) { ?>
                <strong class="btn btn-success btn-xs disabled btn-block">Released</strong>
                <?php } else { ?>
                <a href="#" class="btn btn-info btn-xs btn-block show_released_id" data-id="{{$list->id}}" data-bs-toggle="modal" data-bs-target="#releasebtn1">Release</a>
            <!-- </td> -->
            <?php } ?>
            <?php } else { ?>
            <strong class="btn btn-info btn-xs disabled btn-block">Not Released</strong>
            <?php } ?>
            </td>
            @endif
        </tr>
        @endforeach
        @else
            <tr>
                <th colspan="9" style="text-align:center;font-weight:bold">
                    No records Found!.
                </th>
            </tr>
        @endif
    </tbody>
</table>