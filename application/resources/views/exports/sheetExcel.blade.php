<table>
    <tbody>
        <?php 
            if($type==6){
                $cola="12";
                $colb="7";
                $colc="5";
            }
            if($type==4 || $type==5){
                $cola="14";
                $colb="9";
                $colc="5";
            }
            if($type==1 || $type==2 ){
                $cola="16";
                $colb="10";
                $colc="6";
            }
            if($type==3 || $type==7 ){
                $cola="18";
                $colb="12";
                $colc="6";
            }
            
            ?>
        <tr>
            <th colspan="{{$cola}}" style="text-align:center;background-color: #fdf8f8;font-size: 13px;" height="55">
            <strong> Khel Sathi Portal/खेल साथी पोर्टल </strong><br>
            <strong>Government of Uttar Pradesh/उत्तर प्रदेश सरकार  </strong><br>
            <strong>{{$formName}}</strong>
            </th>
        </tr>
        <tr style="background-color: #fdf8f8;">
            <td colspan="{{$colb}}">
            <strong>Report Period :</strong> {{$data['from_date']}} to {{$data['to_date']}}
            </td>
            <td colspan="{{$colc}}" style="text-align:right;">
            <strong> Report Printed on :</strong> <?= date('d-m-Y'); ?>
            </td>
        </tr>
        <tr style="font-size: 13px;">
            @if ($type != 6)
            <th>S.No.</th>
            <th>Application No.</th>
            <th>Applicant’s Name</th>
            <th>Contact Details</th>
            <th>Father Name</th>
            <th>Address</th>
            <th>District</th>
            <th>Sports </th>
            @if($type == 1 || $type == 2 || $type == 3 || $type == 7)
            <th  >Sports Competition Name</th>
            @if($type == 3 || $type == 7)
            <th>Event type</th>
            <th width="20%">Event Name</th>
            @endif
            <th  >Position / Medal</th>
            <th width="20%">Period Of Competition</th>
            <th>Venue</th>
            @endif
            @if($type == 4 )
            <th  >Achievement Level</th>
            @endif
            @if($type == 5 )
            <th  >Award Category</th>
            @endif
            <th  >Remark</th>
            <th>Date of Application</th>
            <th>Application Status</th>
            <th>Query Status</th>
            <th>Amount (In INR)</th>
        </tr>
        @else
            <th>Sr No.</th>
            <th>Application No.</th>
            <th>Applicant Name</th>
            <th>Post Name</th>
            <th>Contact Details</th>
            <th>Father Name</th>
            <th>Sports </th>
            <th>Sports Competition Name</th>
            <th>Position / Medal</th>
            <th width="20%">Period Of Competition</th>
            
            <th>Status</th>
            <th>Query Status</th>
        @endif
        @if(count($collection) > 0)
        @foreach($collection as $key=>$list)
        @if($type !=6)
                <tr>

                    <td>{{ $key + 1 }}</td>
                    <td>{{ $list->application_no }}</td>
                    @if ($type == 6)
                        <td>{{ ucwords(strtolower(AppliedPostName($list->user_id))) }}</td>
                    @endif
                    <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->fullname ))}}</td>
                    <td>
                        Email : - {{ $list->email }}<br>
                        Mobile : - {{ $list->mobile }}

                    </td>
                    <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->father_name ))}}</td>
                    <td>{{ $list->permanent_address }}</td>
                    <td>{{ districtName($list->permanent_district) }}</td>
                    <td>{{ $list->sportName }}</td>
                    @if($type == 1 || $type == 2)
                    <?php $data=AllCompetition($list->application_no,$type);?>
                    <td>
                       {{-- {{dd($data)}}  --}}
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{sportEventName($item->sport_achievement)}} <br>
                        @endforeach
                        @endif

                    </td>
                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{$item->sport_achievement_position}} <br>
                        @endforeach
                        @endif
                    </td>

                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        <span>{{$item->competition_from_date}} to {{$item->competition_to_date}}</span> <br>
                        @endforeach
                        @endif
                        
                    </td>
                    <td>
                        
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{($item->sport_achievement_State_Institution)}} <br>
                        @endforeach
                        @endif

                    </td>

                    @endif

                    @if($type == 3 || $type == 7)
                    <?php $data=PosiCompetition($list->application_no);?>
                    {{-- {{dd($data)}} --}}
                    <td>
                        
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{PosiEventName($item->competition_name)}} <br>
                        @endforeach
                        @endif

                    </td>
                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        @if($item->event_type ==1) Individual @elseif($item->event_type ==2)
                        Team @elseif($item->event_type ==3)Both @else -- @endif   <br>
                        @endforeach
                        @endif

                    </td>
                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{PosiEventMaster($item->event_name)}} <br>
                        @endforeach
                        @endif

                    </td>
                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{$item->earned_medals}} <br>
                        @endforeach
                        @endif
                    </td>

                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        <span>{{$item->competition_from_date}} to {{$item->competition_to_date}}</span> <br>
                        @endforeach
                        @endif
                        
                    </td>
                    <td>
                        
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{($item->sport_place)}} <br>
                        @endforeach
                        @endif

                    </td>

                    @endif
                    @if($type == 4 )
                    <td>{{ $list->level_of_report }}</td>
                    @endif
                    @if($type == 5 )
                    <td>{{ $list->honoured_award }}</td>
                    @endif
                    <td>{{ $list->remark }}</td>
                    <td>{{ date('d-m-Y', strtotime($list->created_at)) }}</td>
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
                    <?php $abc = marked_status($list->user_id, 3); ?>
                    <td>
                        @if (isset($abc) && $list->form_status == 0 && $abc->is_closed == 0)
                            @if ($abc->query_status == 0)
                                <span class="btn btn-primary btn-xs btn-block">Marked</span>
                            @else
                                <span class="btn btn-primary btn-xs btn-block">
                                    @if ($abc->current_status == 'User')
                                        User
                                    @endif Replied
                                </span>
                            @endif
                        @else
                            <span class="btn btn-danger btn-xs disabled">Not Marked</span>
                        @endif
                    </td>
                    <td>
                        {{-- <?php if($list->is_forwarded_by_rso == 1) { ?> --}}
                        <?php if (($list->is_forwarded_by_rso == 1 && $type == 3  && $list->form_status == 1) || (isset($list->is_forwarded_by_association) && $list->is_forwarded_by_association == 1) && ($type == 1 ||  $type == 2 ||  $type == 4 ||  $type == 5)  && $list->form_status == 1) { ?>
                        <?php if($list->amount_release_status == 1) { ?>
                        <strong
                            class="btn btn-success btn-xs disabled btn-block">Released</strong>
                        <?php } else { ?>
                    
                        <strong
                        class="btn btn-success btn-xs disabled btn-block">Release</strong>
                
                        <?php } ?>
                        <?php } else { ?>
                        <strong class="btn btn-info btn-xs disabled btn-block">Not
                            Released</strong>
                        <?php } ?>
                    </td>
                </tr>
            @else
                <tr>

                    <td>{{ $key + 1 }}</td>
                    <td>{{ $list->application_no }}</td>
                    <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->fullname ))}}</td>
                    <td>{{ ucwords(strtolower(AllAppliedPost($list->application_no))) }}</td>
                    <td>{{ $list->email }}</td>
                    <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->father_name ))}}</td>
                    <?php $data=AllCom($list->application_no);?>
                    <td>
                        {{-- @if(count($data)>0)
                        @foreach($data as $item)
                        {{sport_name($item->sport_name)}} <br>
                        @endforeach
                        @endif --}}
                        {{($list->sportName)}}
                    </td>
                    
                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{sportNEventName($item->sport_event)}} <br>
                        @endforeach
                        @endif

                    </td>
                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        {{$item->medal}} <br>
                        @endforeach
                        @endif
                    </td>

                    <td>
                        @if(count($data)>0)
                        @foreach($data as $item)
                        <span>{{$item->competition_from_date}} to {{$item->competition_to_date}}</span> <br>
                        @endforeach
                        @endif
                        
                    </td>
                        
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
                    <?php $abc = marked_status($list->user_id, 3); ?>
                    <td>
                        @if (isset($abc) && $list->form_status == 0 && $abc->is_closed == 0)
                            @if ($abc->query_status == 0)
                                <span class="btn btn-primary btn-xs btn-block">Marked</span>
                            @else
                                <span class="btn btn-primary btn-xs btn-block">
                                    @if ($abc->current_status == 'User')
                                        User
                                    @endif Replied
                                </span>
                            @endif
                        @else
                            <span class="btn btn-danger btn-xs disabled">Not Marked</span>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
        @else
            <tr>
                <th colspan="{{$cola}}" style="text-align:center;font-weight:bold">
                    No records Found!.
                </th>
            </tr>
        @endif
    </tbody>
</table>
