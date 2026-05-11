<div class="table-responsivde">
    <table  id="dataTable" class="table table-striped table-bordered" width="100%">
        <tr>
            <th>S.No.</th>
            <th>User Name</th>
            <th>Project ID</th>
            <th>Project Name</th>
            <th>Date of Application</th>
            <th>Preferred Location</th>
            <th>Status</th>
            <th>Remark</th>
            <th class="text-center">Action</th>
            <th class="text-center">View</th>
        </tr>
        @foreach($collection as $key=>$row)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $row->fullname }}</td>
            <td>{{ $row->p_code }}</td>
            <td>{{ $row->project_name }}</td>
            <td>{{ dmy($row->application_date) }}</td>
            <td><?= getPreferenceStation($row->type, $row->id); ?></td>
            <td>
                @if($row->application_status!="Forwarded")
                <strong class='badge bg-light' style="color: black;font-size: 12px;">
                    {{ $row->application_status }}
                </strong>
                @else
                @if($row->application_status=="Rejected")

                <span class="badge bg-light" style="color: black;font-size: 12px;">
                    Reject <br> By <br>{{ $row->full_name }}
                </span>

                @else

                <span class="badge bg-light" style="color: black;font-size: 12px;">
                    Admin Forwarded <br>to <br>{{ $row->full_name }}
                </span>

                @endif
                @endif
            </td>
            <td>
                @if($row->forward_remark!='')
                <b>Forwarded Remark:</b> <br>{{ $row->forward_remark }}
                @endif
                @if($row->is_reverted==1 || $row->application_status=='Rejected')
                    @if($row->application_status!='Rejected')
                        Feasibility&nbsp;:&nbsp;{{ $row->feasibility==1?'Yes':'No' }}<br>
                    @endif
                        <br><b>{{$row->application_status!='Rejected'?'Reverted':'Rejected'}} Remark :</b><br> {{ $row->revert_remark }}
                @endif

            </td>
            <td id="replace{{$row->id}}">
                @if($row->type=='SG003' || $row->type=='SG004' || $row->type=='SG009')
                @if($row->forwarded==0)
                <a href="javascript:void(0)" class='btn btn-primary btn-xs' style="width: 100px;" onclick="showForwordModal(<?= $row->id; ?>)"><i class='fas fa-share'></i>&nbsp;Forward</a>
                @else
                @if($row->is_reverted==1)
                <span class="badge bg-warning">Reverted</span><br>
                Feasibility&nbsp;:&nbsp;{{ $row->feasibility==1?'Yes':'No' }}<br>
                {{ $row->revert_remark }}
                @endif
                @endif
                @endif
            </td>
            <td>
                <a href="{{route('projectdeatil', ['id' => $row->id, 'type' => $row->type])}}" class='btn btn-primary btn-xs btn-block'>
                    <i class='fas fa-eye'></i>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-sm-7">
            <div class="col-sm-12 pagignation">
                {!! $collection->links() !!}
            </div>
        </div>
        <div class="col-md-5 text-end">
            <div class="dataTables_info">
                <?= showPages($collection, 'cities'); ?>
            </div>
        </div>
    </div>
</div>
