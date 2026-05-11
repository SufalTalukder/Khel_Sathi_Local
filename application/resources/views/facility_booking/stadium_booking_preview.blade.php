@extends('layouts/facility_booking_auth')
@section('content')
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Stadium Booking Preview/स्टेडियम बुकिंग पूर्वावलोकन
                        <a href="dashboard.html" class="btn btn-outline-success btn-sm backbtn float-end ">
                            <span class="icons icon-arrow-left"></span>Back to Dashboard
                        </a>
                        <button type="button" class="btn btn-outline-primary backbtn btn-sm float-end me-1" data-print="modal" onclick="PrintDoc()"><i class="fa fa-print"></i> Print</button>
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                            <div class="bhoechie-tab-content active" id="prodiv">
                                <div id="content" style="position:relative;">
                                    <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                                        <thead class="dn">
                                            <tr>
                                                <th colspan="2">
                                                    <div style="padding: 0 15px 10px; margin-bottom: 10px; border-bottom: 2px solid #000; position: relative;">
                                                        <img src="images/logo.png"
                                                             style="width: 70px; height: auto; position: absolute; top: 0px; left: 5px;">
                                                        <h1 style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
                                                            Sports Directorate, Govt. of Uttar Pradesh
                                                        </h1>
                                                        <h5 style="text-align: center; margin:10px 0px 0px 0px; font-size:12pt; padding: 0px; color:#383838; font-weight: bold;">
                                                            Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
                                                        </h5>
                                                    </div>
                                                    <h6 style="text-align: center; margin:10px 0px 15px 0px; font-size:12pt; padding: 0px; color:#383838; font-weight: bold; text-decoration:underline;">
                                                        Stadium Booking Application Form
                                                    </h6>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 10pt; text-align:left">
                                                </th>
                                                <th style="text-align: right; font-size: 10pt;">
                                                    <strong>Generated On : </strong> 09/07/2024 | 11:00 AM
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" border="0" cellspacing="0" cellpadding="3" width="100%" style="border-collapse:collapse; font-size:10pt;">
                                                            <tbody>
                                                                <tr>
                                                                    <td><b>Full Name/पूरा नाम</b></td>
                                                                    <td colspan="3">Avinash Verma</td>
                                                                    <td rowspan="6" style="width:15%;">
                                                                        <div class="text-center" style="padding: 0px;" align="center"> <img src="{{ asset('facility_booking_storage') }}/images/profile-pic.jpg" class="img-fluid" style="width: 140px; border: 1px solid #ccc;" /> </div>
                                                                        <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ asset('facility_booking_storage') }}/images/signature.png" class="img-fluid" style="width: 140px; border:1px solid #ccc;" /> </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Email ID/ईमेल आईडी</b></td>
                                                                    <td colspan="3">mail@mail.com</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Moblie No./मोबाइल नंबर</b></td>
                                                                    <td colspan="3">9876543210</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" style="background-color:#eee;"><b>Address Details/पते का विवरण</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b> Address/पता</b></td>
                                                                    <td colspan="3">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>State/राज्य</b></td>
                                                                    <td colspan="3">-</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width:22%"><b>City/शहर</b></td>
                                                                    <td style="width:25%"></td>
                                                                    <td style="width:22%"><b>PIN Code/पिन कोड</b></td>
                                                                    <td colspan="2"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;"><b>Service Details/सेवा का विवरण</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Service/सेवा</b></td>
                                                                    <td></td>
                                                                    <td><b>Location/स्थान </b></td>
                                                                    <td colspan="2"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Stadium/स्टेडियम  </b></td>
                                                                    <td></td>
                                                                    <td><b>Sport Name/खेल का नाम</b></td>
                                                                    <td colspan="2"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Purpose/उद्देश्य </b></td>
                                                                    <td></td>
                                                                    <td><b>Date Range/दिनांक सीमा</b></td>
                                                                    <td colspan="2"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Time Range/समय सीमा</b></td>
                                                                    <td colspan="4"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;"><b>Organization Details(Optional)/संगठन का विवरण(वैकल्पिक)</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Organization Name<br />संगठन का नाम</b></td>
                                                                    <td></td>
                                                                    <td><b>Organization Registration Number<br />संगठन पंजीकरण संख्या</b></td>
                                                                    <td colspan="2"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Organization Document<br />/संगठन का दस्तावेज़ </b></td>
                                                                    <td></td>
                                                                    <td><b>Fee Exemption<br />शुल्क में छूट</b></td>
                                                                    <td colspan="2"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;"><b>Attachments/संलग्नक</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Aadhaar Card/आधार कार्ड</b></td>
                                                                    <td colspan="4"><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;"><strong>Declaration/घोषणा</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5">I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be canceled, for which all responsibility will be mine. I have read all the facts thoroughly and after admission I will strictly follow the hostel rules.<br>मैं घोषणा करता हूं कि उपरोक्त विवरण मेरी सर्वोत्तम जानकारी के अनुसार सत्य हैं। यदि मेरा कोई भी तथ्य गलत पाया जाये तो मेरा प्रवेश निरस्त कर दिया जाये, जिसकी समस्त जिम्मेदारी मेरी होगी। मैंने सभी तथ्यों को अच्छी तरह से पढ़ लिया है और प्रवेश के बाद मैं छात्रावास के नियमों का सख्ती से पालन करूंगा। </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" align="center">
                                                                        <input type="checkbox" checked="checked" />
                                                                        &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot class="dn">
                                                                <tr>
                                                                    <td colspan="5" style="border:0; height:30px;">&nbsp;</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="bhoechie-footer">
                                <div class="row justify-content-center">
                                    <div class="col-md-3 text-center">
                                        <a href="Dashboard.html" class="btn btn-outline-info">Submit Application</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
