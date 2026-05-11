<table  id="dataTable" class="table table-bordered">
    <tr>
        <td colspan="6" class="bg-light">
            <strong>Basic Details</strong>
        </td>
    </tr>
    <tr>
        <td><b>Applicant Name</b>
        </td>
        <td>{{Auth::guard('hostel')->user()->name}}   </td>
        <td><b>Date of Birth</b>
        </td>
        <td>{{Auth::guard('hostel')->user()->dob}}</td>
        <td rowspan="5" colspan="2"><b>Photograph of Applicant</b><br/>
            <div class="text-center">
                <img src="{{url('public/hostelapplicant/applicant_file/')}}/@isset(Auth::guard('hostel')->user()->applicationBasicDetasils){{Auth::guard('hostel')->user()->applicationBasicDetasils->applicant_file}} @endisset" class="img-fluid" style="width: 140px;"/>
            </div>
        </td>
    </tr>
    <tr>
        <td><b>Aadhar Number</b>
        </td>
        <td>{{Auth::guard('hostel')->user()->aadhar}}</td>
        <td><b>Aadhar Card</b>
        </td>
        <td><a href="{{url('public/hostelapplicant/aadhar_card_file/')}}/@isset(Auth::guard('hostel')->user()->applicationBasicDetasils){{Auth::guard('hostel')->user()->applicationBasicDetasils->aadhar_card_file}} @endisset" class="btn btn-success btn-xs" target="_blank">Uploaded</strong></td>
</tr>
<tr>
<td><b>Mobile Number</b></td>
<td>{{Auth::guard('hostel')->user()->mobile}}</td>
<td><b>Email ID</b></td>
<td>{{Auth::guard('hostel')->user()->email}}</td>
</tr>
<tr>
<td><b>District</b></td>
<td> @isset(Auth::guard('hostel')->user()->applicationBasicDetasils){{Auth::guard('hostel')->user()->applicationBasicDetasils->district->city}}   @endisset</td>
<td><b>Regional Sports Office</b></td>
<td>  @isset(Auth::guard('hostel')->user()->applicationBasicDetasils){{Auth::guard('hostel')->user()->applicationBasicDetasils->region_office->region_office}}  @endisset</td>
</tr>
<tr>
<td><b>Sports Name</b></td>


<td></td>
<td><b>Category</b></td>
<td>
    @isset(Auth::guard('hostel')->user()->applicationBasicDetasils){{Auth::guard('hostel')->user()->applicationBasicDetasils->category}} @endisset
</td>
</tr>
<tr>
<td><b>Sub Category</b></td>
<td> @isset(Auth::guard('hostel')->user()->applicationBasicDetasils){{Auth::guard('hostel')->user()->applicationBasicDetasils->sub_category}} @endisset
    </td>
<td><b>Father’s Name</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationBasicDetasils){{Auth::guard('hostel')->user()->applicationBasicDetasils->father_name}} @endisset
</td>
<td rowspan="2" colspan="2"><b>Signature  of Applicant</b><br />
    <div class="text-center">
        <img src="{{url('public/hostelapplicant/aadhar_card_file/')}}/@isset(Auth::guard('hostel')->user()->applicationBasicDetasils){{Auth::guard('hostel')->user()->applicationBasicDetasils->aadhar_card_file}} @endisset" class="img-fluid" style="width: 140px;" />
    </div>
</td>

</tr>
<tr>

<td><b>Occupation</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->father_occuption}} @endisset
</td>
<td>Mother's Name<b>
</b>@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->mother_name}} @endisset</td>
<td>-</td>
</tr>
<tr>
<td style="width: 15%"><b>Occupation</b></td>
<td style="width: 20%">@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->mother_occuption}} @endisset</td>
<td style="width: 15%"><b>Height (in centimeter)</b></td>
<td style="width: 20%">@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->height}} @endisset</td>
<td style="width: 15%"><b>Weight (in Kg)</b></td>
<td style="width: 15%">@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->weight}} @endisset</td>
</tr>
<tr>
<td><b>Blood Group</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->blood_group}} @endisset</td>
<td><b>Class for which admission is to be taken</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->class_for_which_admission}} @endisset</td>
<td><b>Domicile of Uttar Pradesh</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->domicle}} @endisset</td>
</tr>
<tr>
<td><b>Domicile Certificate</b></td>
<td><strong class="btn btn-success btn-xs disabled">Uploaded</strong></td>
<td><b>Identification Mark</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->identification_mark}} @endisset</td>
<td><b>Number of Teeth</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->number_of_teeth}} @endisset</td>
</tr>
<tr>
<td colspan="2"><b>Suffering from Skin Disease/Fits/Other Disease</b></td>
<td colspan="2">@isset(Auth::guard('hostel')->user()->applicationBasicDetasils)	{{Auth::guard('hostel')->user()->applicationBasicDetasils->disease}} @endisset</td>
<td><b>Medical Certificate</b></td>
<td><strong class="btn btn-success btn-xs disabled">Uploaded</strong></td>
</tr>
<tr>
<td colspan="6" class="bg-light">
    <strong>Communication Details</strong>
</td>
</tr>
<tr>
<td colspan="6">
    <strong style="font-size: 15px;">Permanent Address</strong>
</td>
</tr>
<tr>
<td><b>Gram/Mohalla</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->p_gram_mohalla}} @endisset</td>
<td><b>Post</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->p_post}} @endisset</td>
<td><b>Thana</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->p_thana}} @endisset</td>
</tr>
<tr>

<td><b>State</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->pstate->name}} @endisset</td>
<td><b>District</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->pdistrict->city}} @endisset</td>
<td><b>Mobile No.</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->p_mobile}} @endisset</td>
</tr>
<tr>
<td><b>Alternate Contact No.</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->p_alt_mobile}} @endisset</td>
<td><b>Email ID</b></td>
<td colspan="3">@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->p_email}} @endisset</td>
</tr>
<tr>
<td colspan="6">
    <strong style="font-size: 15px;">Correspondence Address</strong>
</td>
</tr>
<tr>
<td><b>Gram/Mohalla</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->c_gram_mohalla}} @endisset</td>
<td><b>Post</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->c_post}} @endisset</td>
<td><b>Thana</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->c_thana}} @endisset</td>
</tr>
<tr>
<td><b>State</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->cstate->name}} @endisset</td>
<td><b>District</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->cdistrict->city}} @endisset</td>
<td><b>Mobile No.</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->c_mobile}} @endisset</td>
</tr>
<tr>
<td><b>Alternate Contact No.</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->c_alt_mobile}} @endisset</td>
<td><b>Email ID</b></td>
<td colspan="3">@isset(Auth::guard('hostel')->user()->applicationCommunicationDetails){{Auth::guard('hostel')->user()->applicationCommunicationDetails->c_email}} @endisset</td>
</tr>
<tr>
<td colspan="6" class="bg-light">
    <strong>Educational Qualification</strong>
</td>
</tr>
<tr>
<td><b>Class</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationQualificationDetails){{Auth::guard('hostel')->user()->applicationQualificationDetails->class}} @endisset</td>
<td><b>School/College Name</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationQualificationDetails){{Auth::guard('hostel')->user()->applicationQualificationDetails->school_college}} @endisset</td>
<td><b>Year of Passing</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationQualificationDetails){{Auth::guard('hostel')->user()->applicationQualificationDetails->passing_year}} @endisset</td>
</tr>
<tr>
<td>@isset(Auth::guard('hostel')->user()->applicationQualificationDetails){{Auth::guard('hostel')->user()->applicationQualificationDetails->obtain_mark}} @endisset</td>
<td><b>Maximum Marks</b></td>
<td>@isset(Auth::guard('hostel')->user()->applicationQualificationDetails){{Auth::guard('hostel')->user()->applicationQualificationDetails->total_mark}} @endisset</td>


</tr>
</table>
