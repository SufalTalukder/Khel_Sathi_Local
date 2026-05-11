<style>
    table,
    td,
    th {
        border: 1px solid;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .border {
        border: 0px !important;
    }
</style>


<table style="background-color: #2ec52e2e;">
    <tbody>

        <tr>
            <th colspan="6" style="text-align:center; background-color: #fdf8f8;" height="70" width="70">
                DEPARTMENT OF ADDITIONAL SOURCES OF ENERGY, GOVERNMENT OF UTTAR PRADESH<br>
                <?= $project_name ?><br>
            </th>
        </tr>
        <tr>
            <th colspan="6" style="text-align:center;">
                Organisation Details
            </th>
        </tr>
        <tr>
            <th colspan="3" style="text-align:left;">
                Project Name : <?= $project_name ?>
            </th>
            <th colspan="3" style="text-align:left;">
                Print Date : <?= date('Y-m-d'); ?>
            </th>
        </tr>

        @if($project_name!='')

        <tr style="text-align: left;">

            <th colspan="3" class="border">
                Organisation/Company/Firm Name :
                {{ $profile->company_name }}
            </th>
            <th colspan="3" class="border">
                Authorize Person :
                {{ $profile->fullname }}
            </th>


        </tr>
        <tr style="text-align: left;">
            <th colspan="3" class="border">
                Legal Status :
                {{ $profile->legal_status }}

            </th>
            <th colspan="3" class="border">

                Email ID :
                {{ $profile->email }}

            </th>
        </tr>
        <tr style="text-align: left;">

            <th colspan="3" class="border">
                Mobile Number :
                {{ $profile->mobile }}

            </th>
            <th colspan="3" class="border">
                GST No. :
                {{ $profile->gstin_no }}

            </th>
        </tr>
        <tr>
            <th colspan="6" style="text-align:center;">
                Project Details
            </th>
        </tr>
        <tr>
            <th colspan="3" style="text-align:left;">
                Preference 1 :
                @foreach($state as $item)
                @if($items->preference_first==$item->id)
                {{ $item->name}}
                @endif
                @endforeach
            </th>
            <th colspan="3" style="text-align:left;">
                Preference 2 :
                @foreach($state as $item)
                @if($items->preference_second==$item->id)
                {{ $item->name}}
                @endif
                @endforeach
            </th>

        </tr>
        <tr>
            <th colspan="3" style="text-align:left;">
                Preference 3 :
                @foreach($state as $item)
                @if($items->preference_third==$item->id)
                {{ $item->name}}
                @endif
                @endforeach
            </th>

            <th colspan="3" style="text-align:left;">
                Proposed Area of Land (in Acre) : {{ $items->area_of_land }}
            </th>
        </tr>

        @if($type == 'SG004')

        <tr>
            <th colspan="3" style="text-align:left;">
                Connectivity : {{ $items->connectivity }}
            </th>

            <th colspan="3" style="text-align:left;">
                Do you want to setup for solar park MNRE : {{ $items->setup_for_solar_park_mnre }}
            </th>
        </tr>


        <tr>
            <th colspan="3" style="text-align:left;">
                Do you want status of solar park from MNRE : {{ $items->status_of_solar_park }}
            </th>

            <th colspan="3" style="text-align:left;">
                Do you want to avail grant form MNRE : {{ $items->grant_form_mnre }}
            </th>
        </tr>

        @endif


        @if($type == 'SG003' || $type == 'SG004')


        @if($type != 'SG004')

        <tr>
            <th colspan="6" style="text-align:left;">
                Have you received any approval of Park from Government of India :
                {{ $items->approval_of_park }}
            </th>
        </tr>
        @endif

        <tr>
            <th colspan="3" style="text-align:left;">
                Sanction Number : {{ $items->sanction_number }}
            </th>

            <th colspan="3" style="text-align:left;">
                Sanction Date : {{ dmy($items->sanction_date) }}
            </th>
        </tr>

        <tr>
            <th colspan="3" style="text-align:left;">
                Sanction Capacity (Megawatt) : {{ $items->sanction_capacity }}
            </th>

            <th colspan="3" style="text-align:left;">
                Preferred Sub Station :
                @foreach($station as $item)
                @if($items->sub_station==$item->id)
                {{ $item->name}}
                @endif
                @endforeach
            </th>
        </tr>

        <tr>
            <th colspan="6" style="text-align:left;">
                Voltage (Kilowatt) : {{ $items->voltage }}
            </th>
        </tr>

        @endif

        @else


        <tr>
            <th colspan="3" style="text-align:left;">
                <div class="alert alert-danger" role="alert">
                    No records Found!.
                </div>
            </th>
        </tr>

        @endif
    </tbody>
</table>
