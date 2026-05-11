@extends('layouts/admin_layout')
@section('content')
    <style>
        .nowraptd {
            white-space: nowrap;
        }

        .dn {
            display: none;
        }
    </style>
    <style>
        .hide-panel {
            background: #f7f7f7;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px dashed #ccc;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="pageheader" id="menu-margin">
                <h4 class="mb-0">
                    बिन्दु-10 -व्ययाधिक्य बचत की सूचना
                    <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i
                            class="icons icon-printer"></i> प्रिंट</a>
                            <button onclick="PrintExce('Vyadhik Bachat')" class="btn btn btn-outline-primary float-end">Excel</button>
                </h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (Auth::guard('admin')->user()->admin_role != 1)
                        <form action="{{ url('admin/information/vyayaadhi_bachat') }}" class="needs-validation"
                            id="reload_two" novalidate method="post" autocomplete="off">
                            @csrf
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="placeholder">माह <span class="text-danger">*</span></label>
                                            <select name="month" required class="form-control form-select">
                                                <option value=''>--select--</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 1) selected @endif value='1'>
                                                    Janaury</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 2) selected @endif value='2'>
                                                    February</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 3) selected @endif value='3'>
                                                    March</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 4) selected @endif value='4'>
                                                    April</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 5) selected @endif value='5'>May
                                                </option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 6) selected @endif value='6'>
                                                    June</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 7) selected @endif value='7'>
                                                    July</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 8) selected @endif value='8'>
                                                    August</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 9) selected @endif value='9'>
                                                    September</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 10) selected @endif value='10'>
                                                    October</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 11) selected @endif value='11'>
                                                    November</option>
                                                <option @if (isset($ed_data->month_name) && $ed_data->month_name == 12) selected @endif value='12'>
                                                    December</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if (isset($ed_data->id))
                                        <input type="hidden" value="{{ $ed_data->id }}" name="id">
                                    @endif
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="placeholder">वर्ष <span class="text-danger">*</span></label>
                                            <select name="year" required class="form-control form-select">
                                                <option value=''>--select--</option>
                                                @for ($i = 2000; $i <= date('Y'); $i++)
                                                    {
                                                    <option @if (isset($ed_data->year) && $ed_data->year == $i) selected @endif
                                                        value={{ $i }}>{{ $i }}</option>
                                                    }
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label class="form-label">जनपद का नाम <span class="text-danger">*</span></label>
                                            <select name="district_name" required id="district_name"
                                                class="form-control form-select">
                                                <option value="">--select--</option>
                                                @foreach ($districts as $key => $district)
                                                    <option value="{{ $district->id }}"
                                                        @if (isset($ed_data->district_id) && $ed_data->district_id == $district->id) selected @endif>
                                                        {{ $district->city }}</option>
                                                    data-badge="">{{ $district->city }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="division_filter">मद का नाम (राजस्वा लेखा )<span
                                                    class="text-danger">*</span></label>
                                            <select required class="form-select" onchange="getval(this);" name="item_name"
                                                required>
                                                <option disabled selected value="">--All--</option>
                                                <option value="1" @if (isset($ed_data->item_name) && $ed_data->item_name == 1) selected @endif>
                                                    2013-मंत्रि परिशद 105-मंत्रियों द्वारा विवेकाधीन अनुदान 03-क्रीड़ा
                                                    मंत्री द्वारा विवेकाधीन अनुदान 42-अन्य व्यय</option>
                                                <option value="2" @if (isset($ed_data->item_name) && $ed_data->item_name == 2) selected @endif>
                                                    2059.लोक निर्माण कार्य 80.सामान्य 053.रखरखाव तथा मरम्मत 03.मेयोहाल
                                                    इलाहाबाद के अनावासीय भवनों का अनुरक्षण 29-अनुरक्षण</option>
                                                <option value="3" @if (isset($ed_data->item_name) && $ed_data->item_name == 3) selected @endif
                                                    id="pl-2204">2204-खेलकूद तथा युवा सेवायें 001-निदेषन तथा प्रषासन
                                                    03-खेलकूद निदेषालय</option>
                                                <option value="4" @if (isset($ed_data->item_name) && $ed_data->item_name == 4) selected @endif
                                                    id="pl-104">104-खेलकूद</option>
                                                <option value="5" @if (isset($ed_data->item_name) && $ed_data->item_name == 5) selected @endif
                                                    id="pl-105">800-अन्य व्यय 03-मेजर ध्यानचन्द विश्वविद्यालय, मेरठ
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3" style="display: none;" id="play-2204">

                                        <div class="form-group">
                                            <label for="division_filter"> उपमद का नाम <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="play-2204_fi" name="revenue_accounting">
                                                <option disabled selected value="">--All--</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 1) selected @endif value="1">
                                                    01-वेतन</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 2) selected @endif value="2">
                                                    03-मंहगाई भत्ता</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 3) selected @endif value="3">
                                                    04-यात्रा व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 4) selected @endif value="4">
                                                    05-स्थानान्तरण यात्रा व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 5) selected @endif value="5">
                                                    06-अन्य भत्ते</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 6) selected @endif value="6">
                                                    07-मानदेय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 7) selected @endif value="7">
                                                    08-कार्यालय व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 8) selected @endif value="8">
                                                    09-विद्युत देय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 9) selected @endif value="9">
                                                    10-जलकर/जल प्रभार</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 10) selected @endif value="10">
                                                    11-लेखन सामग्री और फार्मो की छपाई</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 11) selected @endif value="11">
                                                    12-कार्यालय फर्नीचर एवं उपकरण</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 12) selected @endif value="12">
                                                    13-टेलीफोन पर व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 13) selected @endif value="13">
                                                    15-गाड़ियो का अनुरक्षण और पेट्रोल आदि की खरीद</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 14) selected @endif value="14">
                                                    16-व्यावसायिक तथा विषेश सेवाओं के लिए भुगतान</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 15) selected @endif value="15">
                                                    17-किराया, उपषुल्क और कर स्वामित्व</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 16) selected @endif value="16">
                                                    22-आतिथ्य व्यय/व्यय विशयक भत्ता आदि</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 17) selected @endif value="17">
                                                    26-मषीने और सज्जा/उपकरण और संयंत्र</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 18) selected @endif value="18">
                                                    42-अन्य व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 19) selected @endif value="19">
                                                    44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 20) selected @endif value="20">
                                                    45-अवकाष यात्रा व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 21) selected @endif value="21">
                                                    46-कम्प्यूटर हार्डवेयर/साफ्टवेयर का क्रय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 22) selected @endif value="22">
                                                    47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 23) selected @endif value="23">
                                                    49-चिकित्सा व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 24) selected @endif value="24">
                                                    51-वर्दी व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 25) selected @endif value="25">
                                                    55-मकान किराया भत्ता</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 26) selected @endif value="26">
                                                    56-नगर प्रतिकर भत्ता</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 27) selected @endif value="27">
                                                    58-आउट सोर्सिंग सेवाओं हेतु भुगतान</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 28) selected @endif value="28">
                                                    59-एकमुश्त नियोक्ता अंशदान/ब्याज</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3" style="display: none;" id="play-104">

                                        <div class="form-group">
                                            <label for="division_filter"> उपमद का नाम <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="play-104_fi" onchange="getplay104(this);"
                                                name="revenue_accounting">
                                                <option disabled selected value="">--All--</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 1) selected @endif value="1">
                                                    03-सरकारी कर्मचारियों तथा उनके परिवारों के कल्याण सम्बन्धी कार्यकलाप
                                                    20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 2) selected @endif value="2">
                                                    04-क्रीड़ा छात्रावास के आवासीय खिलाड़ियों पर व्यय (बालिकाओं हेतु)
                                                    12-कार्यालय फर्नीचर एवं उपकरण</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 3) selected @endif value="3">
                                                    42-अन्य व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 4) selected @endif value="4">
                                                    05-भूतपूर्व प्रसिद्ध खिलाड़ियों तथा पहलवानों को वित्तीय सहायता 20-सहायता
                                                    अनुदान-सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 5) selected @endif value="5">
                                                    06-क्रीड़ा छात्रावास के आवासीय खिलाड़ियों पर व्यय (बालको हेतु)
                                                    12-कार्यालय फर्नीचर एवं उपकरण</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 6) selected @endif value="6">
                                                    42-अन्य व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 7) selected @endif id="pl-07"
                                                    value="7">07-उत्तर प्रदेश खेल विकास एवं प्रोत्साहन योजना 42-अन्य
                                                    व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 8) selected @endif value="8">
                                                    09-क्रीड़ागनों/स्टेडियमों/बहुउद्देषीय हालों/तरणतालांे/छात्रावासों एवं
                                                    भवनों का अनुरक्षण 29-अनुरक्षण</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 9) selected @endif value="9">
                                                    10-विषिश्ट खिलाड़ियों को प्रदेषीय पुरस्कार 20-सहायता अनुदान-सामान्य (गैर
                                                    वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 10) selected @endif value="10">
                                                    11-क्रीड़ा एवं खेलकूद प्रतियोगिताओं का आयोजन (राज्य से.) 42-अन्य व्यय
                                                </option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 11) selected @endif value="11">
                                                    12-खेलकूद उपकरण सामग्री की सम्पूर्ति 43-सामग्री एवं सम्पूर्ति</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 17) selected @endif value="17">
                                                    13- राष्ट्रीय/अन्तर्राष्ट्रीय प्रतियोगिताओं के विजेता खिलाड़ियों को
                                                    पुरस्कार 20-सहायता अनुदान - सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 18) selected @endif value="18">
                                                    14-लेखो इण्डिया यूनिवर्सिटी गेम्स का आयोजन हेतु 20-सहायता अनुदान -
                                                    सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 19) selected @endif value="19">
                                                    15-उ0प्र0 खेल विकास कोष 42-अन्य व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 12) selected @endif value="12">
                                                    16-प्रत्येक क्रीड़ांगन में एक फिजियोथैरेपी केन्द्र की स्थापना 42-अन्य
                                                    व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 13) selected @endif value="13">
                                                    18-प्रषिक्षण (राज्य सेक्टर)- 42-अन्य व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 14) selected @endif value="14">
                                                    21-राश्ट्रीय प्रतियोगिताओं में भाग लेने वाली प्रदेषीय टीम के खिलाड़ियों
                                                    हेतु किट की व्यवस्था 20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 15) selected @endif value="15">
                                                    29-राश्ट्रीय एवं अन्तर्राश्ट्रीय स्तर की खेल प्रतियोगिताओं का
                                                    आयोजन-20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 16) selected @endif value="16">
                                                    30-पंडित दीन दयाल उपाध्याय जी की जन्म षताब्दी के अवसर पर खेल
                                                    प्रतियोगिताओं का आयोजन 20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 20) selected @endif value="20">
                                                    33-सिविल सर्विसेज इन्स्टीटयूट, राजभवन कम्पाउण्ड क्लब लखनऊ 20-सहायता
                                                    अनुदान - सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 21) selected @endif value="21">
                                                    35-सैयद मोदी मेमोरियल आल इण्डिया प्राइजमनी बैडमिन्टन कम्पटीशन हेतु
                                                    सहायता 20-सहायता अनुदान - सामान्य (गैर वेतन)</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 22) selected @endif value="22">
                                                    36-एकलव्य क्रीडा कोष 42-अन्य व्यय</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-3" style="display: none;" id="play-105">

                                        <div class="form-group">
                                            <label for="division_filter"> उपमद का नाम <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="play-105_fi" name="revenue_accounting">
                                                <option disabled selected value="">--All--</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 1) selected @endif value="1">
                                                    01-वेतन</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 2) selected @endif value="2">
                                                    03-मंहगाई भत्ता</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 3) selected @endif value="3">
                                                    04-यात्रा व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 4) selected @endif value="4">
                                                    05-स्थानान्तरण यात्रा व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 6) selected @endif value="6">
                                                    07-मानदेय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 7) selected @endif value="7">
                                                    08-कार्यालय व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 8) selected @endif value="8">
                                                    09-विद्युत देय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 9) selected @endif value="9">
                                                    10-जलकर/जल प्रभार</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 10) selected @endif value="10">
                                                    11-लेखन सामग्री और फार्मो की छपाई</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 11) selected @endif value="11">
                                                    12-कार्यालय फर्नीचर एवं उपकरण</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 12) selected @endif value="12">
                                                    13-टेलीफोन पर व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 13) selected @endif value="13">
                                                    15-गाड़ियो का अनुरक्षण और पेट्रोल आदि की खरीद</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 14) selected @endif value="14">
                                                    16-व्यावसायिक तथा विषेश सेवाओं के लिए भुगतान</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 16) selected @endif value="16">
                                                    22-आतिथ्य व्यय/व्यय विशयक भत्ता आदि</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 18) selected @endif value="18">
                                                    42-अन्य व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 19) selected @endif value="19">
                                                    44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 21) selected @endif value="21">
                                                    46-कम्प्यूटर हार्डवेयर/साफ्टवेयर का क्रय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 22) selected @endif value="22">
                                                    47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 23) selected @endif value="23">
                                                    49-चिकित्सा व्यय</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 25) selected @endif value="25">
                                                    55-मकान किराया भत्ता</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 26) selected @endif value="26">
                                                    56-नगर प्रतिकर भत्ता</option>
                                                <option @if (isset($ed_data->revenue_accounting) && $ed_data->revenue_accounting == 27) selected @endif value="27">
                                                    58-आउट सोर्सिंग सेवाओं हेतु भुगतान</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3" style="display: none;" id="play-07">
                                        <label class="mb-3">उपमद का नाम <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select class="form-select" id="play-07_fi"
                                                name="uttar_pradesh_sports_development">
                                                <option disabled selected value="">--All--</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 1) selected @endif value="1">
                                                    08-मेयोहाल इलाहाबाद में स्थापित क्रीड़ा स्थल</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 2) selected @endif value="2">
                                                    01-वेतन</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 3) selected @endif value="3">
                                                    03-मंहगाई भत्ता</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 4) selected @endif value="4">
                                                    04-यात्रा व्यय</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 5) selected @endif value="5">
                                                    05-स्थानान्तरण यात्रा व्यय</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 6) selected @endif value="6">
                                                    06-अन्य भत्ते </option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 7) selected @endif value="7">
                                                    08-कार्यालय व्यय</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 8) selected @endif
                                                    value="8">09-विद्युत देय</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 9) selected @endif
                                                    value="9">10-जलकर/जल प्रभार</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 10) selected @endif
                                                    value="10">11-लेखन सामग्री और फार्मो की छपाई</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 11) selected @endif
                                                    value="11">12-कार्यालय फर्नीचर एवं उपकरण</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 12) selected @endif
                                                    value="12">13-टेलीफोन पर व्यय</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 13) selected @endif
                                                    value="13">43-सामग्री एवं सम्पूर्ति</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 14) selected @endif
                                                    value="14">44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय
                                                </option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 15) selected @endif
                                                    value="15">45-अवकाष यात्रा व्यय</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 16) selected @endif
                                                    value="16">47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय
                                                </option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 17) selected @endif
                                                    value="17">49-चिकित्सा व्यय</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 18) selected @endif
                                                    value="18">51-वर्दी व्यय</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 19) selected @endif
                                                    value="19">55-मकान किराया भत्ता</option>
                                                <option @if (isset($ed_data->uttar_pradesh_sports_development) && $ed_data->uttar_pradesh_sports_development == 20) selected @endif
                                                    value="20">56-नगर प्रतिकर भत्ता</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="">निदेशालय सत्तर पर आवंटित धन राशि रुपये में <span
                                                    class="text-danger">*</span></label>
                                            <input required
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');"
                                                type="text" name="directorate_seventy"
                                                @if (isset($ed_data->directorate_seventy)) value="{{ $ed_data->directorate_seventy }}" @endif
                                                id="directorate_seventy" class="form-control" onblur="calc()">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="">व्यय की गयी धन राशि रुपये में <span
                                                    class="text-danger">*</span></label>
                                            <input required
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');"
                                                type="text" class="form-control" id="amount_of_money_spent"
                                                name="amount_of_money_spent"
                                                @if (isset($ed_data->amount_of_money_spent)) value="{{ $ed_data->amount_of_money_spent }}" @endif
                                                onblur="calc()">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="">बचत/अवशेष <span class="text-danger">*</span></label>
                                            <input type="text" required
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');"
                                                name="savings"
                                                @if (isset($ed_data->savings)) value="{{ $ed_data->savings }}" @endif
                                                id="savings" class="form-control" readonly
                                                aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="">% व्यय <span class="text-danger">*</span></label>
                                            <input type="text" required
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');"
                                                name="savings_percent"
                                                @if (isset($ed_data->savings_percent)) value="{{ $ed_data->savings_percent }}" @endif
                                                id="savings_percent" class="form-control" readonly
                                                aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="">अभ्युक्ति </label>
                                            <textarea name="allegation" @if (isset($ed_data->comment)) value="{{ $ed_data->comment }}" @endif
                                                class="form-control" aria-describedby="emailHelp"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="bhoechie-footer">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2 d-grid">
                                            <button id="reset" type="reset"
                                                class="btn btn-outline-danger rounded-pill">रीसेट</button>
                                        </div>
                                        <div class="col-md-2 d-grid">
                                            <button type="submit" class="btn  btn-outline-info rounded-pill">सुनिश्चित
                                                करे</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    @endif
                    <div class="container removebg-color" style="background: #f0e7eb;padding: 10px;margin-bottom: 10px;">
                        <form action="{{ url('admin/information/vyayaadhi_bachat') }}" class="needs-validation"
                            method="get" novalidate autocomplete="off">
                            <div class="pageheaderr">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="form-label" style="margin-bottom: 0;">Division</label>
                                        <select name="division_name" id="division_name" class="form-control form-select">
                                            <option value="">--select--</option>
                                            @foreach ($division as $key => $division)
                                                <option
                                                    {{ $division->id == request()->input('division_name') ? 'selected' : '' }}
                                                    value="{{ $division->id }}" data-badge="">
                                                    {{ $division->division_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" style="margin-bottom: 0;">District</label>
                                        <input type="hidden" id="district_id"
                                            value="{{ request()->input('district_name') }}">
                                        <select name="district_name" id="district_name" class="form-control form-select">
                                            <option value="">--select--</option>
                                            @foreach ($districts as $key => $district)
                                                <option
                                                    {{ $district->id == request()->input('district_name') ? 'selected' : '' }}
                                                    value="{{ $district->id }}" data-badge="">{{ $district->city }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" style="margin-bottom: 0;">Year</label>
                                        <select name="year" id="year" class="form-control form-select">
                                            <option value="all">--all--</option>
                                            @for ($i = 2000; $i <=date('Y'); $i++)
                                            <option   {{$i == $s_year ? 'selected' : ''}} value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" style="margin-bottom: 0;">From Month</label>
                                        <select name="from_month" id="from_month" class="form-control form-select">
                                            <option value='all'>--all--</option>
                                            <option {{1 == $from_month ? 'selected' : ''}} value='1'>Janaury</option>
                                            <option {{2 == $from_month ? 'selected' : ''}} value='2'>February</option>
                                            <option {{3 == $from_month ? 'selected' : ''}} value='3'>March</option>
                                            <option {{4 == $from_month ? 'selected' : ''}} value='4'>April</option>
                                            <option {{5 == $from_month ? 'selected' : ''}} value='5'>May</option>
                                            <option {{6 == $from_month ? 'selected' : ''}} value='6'>June</option>
                                            <option {{7 == $from_month ? 'selected' : ''}} value='7'>July</option>
                                            <option {{8 == $from_month ? 'selected' : ''}} value='8'>August</option>
                                            <option {{9 == $from_month ? 'selected' : ''}} value='9'>September</option>
                                            <option {{10 == $from_month ? 'selected' : ''}} value='10'>October</option>
                                            <option {{11 == $from_month ? 'selected' : ''}} value='11'>November</option>
                                            <option {{12 == $from_month ? 'selected' : ''}} value='12'>December</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" style="margin-bottom: 0;">To Month</label>
                                        <select name="to_month" id="to_month" class="form-control form-select">
                                            <option value='all'>--all--</option>
                                            <option {{1 == $to_month ? 'selected' : ''}} value='1'>Janaury</option>
                                            <option {{2 == $to_month ? 'selected' : ''}} value='2'>February</option>
                                            <option {{3 == $to_month ? 'selected' : ''}} value='3'>March</option>
                                            <option {{4 == $to_month ? 'selected' : ''}} value='4'>April</option>
                                            <option {{5 == $to_month ? 'selected' : ''}} value='5'>May</option>
                                            <option {{6 == $to_month ? 'selected' : ''}} value='6'>June</option>
                                            <option {{7 == $to_month ? 'selected' : ''}} value='7'>July</option>
                                            <option {{8 == $to_month ? 'selected' : ''}} value='8'>August</option>
                                            <option {{9 == $to_month ? 'selected' : ''}} value='9'>September</option>
                                            <option {{10 == $to_month ? 'selected' : ''}} value='10'>October</option>
                                            <option {{11 == $to_month ? 'selected' : ''}} value='11'>November</option>
                                            <option {{12 == $to_month ? 'selected' : ''}} value='12'>December</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label" style="margin-bottom: 0;">Convert</label>
                                        <select name="convert" id="convert" class="form-control form-select">
                                            <option @if($convert==1) selected @endif value="1">In Rs</option>
                                            <option @if($convert==2) selected @endif value="2">In Lakhs</option>
                                            <option @if($convert==3) selected @endif value="3">In Crores</option>
                                            
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-3">
                                <label class="form-label" style="margin-bottom: 0;">From Date</label>
                                <input type="text" name="from_date" id="from_date" value="{{ request()->input('from_date') }}" placeholder="DD/MM/YYYY" class="form-control dateTime" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" style="margin-bottom: 0;">To Date</label>
                                <input type="text" name="to_date" id="to_date" value="{{ request()->input('to_date') }}" placeholder="DD/MM/YYYY" class="form-control dateTime" />
                            </div> -->
                                    <div class="col-md-1 custom-buton" style="padding-top: 1.4rem;">
                                        <button class="btn btn-primary btn-sm" type="submit" title="Search">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-1 custom-buton" style="padding-top: 1.4rem;">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ url('admin/information/vyayaadhi_bachat') }}"><i
                                                class="fas fa-refresh"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="prodiv">
                                <table border="0" cellspacing="0" cellpadding="4" width="100%"
                                    style="border-collapse:collapse;">
                                    <thead class="dn">
                                        <tr>
                                            <th colspan="2">
                                                <div
                                                    style="padding: 0 15px 3px; margin-bottom: 10px; border-bottom: 0px solid #000; position: relative;">
                                                    <h2
                                                        style="text-align: center; margin:0px 0px 15px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                                        बिन्दु-10
                                                    </h2>
                                                    <h2
                                                        style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                                        व्ययाधिक्य बचत की सूचना
                                                    </h2>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th style="font-size: 10pt; text-align: left;">
                                                <b>Year :</b> {{request()->input('year') ? request()->input('year'):date("Y")}} <b>@if(request()->input('from_month') != 'all' || request()->input('to_month') != 'all'  )  ,Month : @endif </b> {{request()->input('from_month') ? month_name(request()->input('from_month')):month_name(date("m"))}} @if(request()->input('from_month') != 'all' && request()->input('to_month') != 'all'  )  to @endif {{request()->input('to_month') ? month_name(request()->input('to_month')):month_name(date("m"))}}
                                            </th>
                                            <th style="font-size: 10pt; text-align:right">
                                                <strong>Report Period : </strong>
                                                {{ first_insert('vyayaadhi_bachat', 'created_on') }} to {{ date('d-m-Y') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover bg-white datatable mb-3"
                                                        id="dataTable" cellpadding="3">
                                                        <thead>
                                                            <tr>
                                                                <th>क्र.सं.</th>
                                                                <th><strong>मण्डल</strong><strong> का नाम</strong></th>
                                                                <th><strong>जिला </strong><strong> का नाम</strong></th>
                                                                {{-- <th><strong>तहसील</strong><strong> का नाम</strong></th> --}}
                                                                <th>माह</th>
                                                                <th>वर्ष</th>
                                                                <th><strong>मद का नाम </strong></th>
                                                                <th>उपमद का नाम </th>
                                                                <th>निदेशालय सत्तर पर आवंटित धन राशि रुपये में<br>
                                                                    (@if($convert==1)In Rs @elseif($convert==2) In Lakhs @elseif($convert==3) In Crores @endif)
                                                                </th>
                                                                <th>व्यय की गयी धन राशि रुपये में<br>
                                                                    (@if($convert==1)In Rs @elseif($convert==2) In Lakhs @elseif($convert==3) In Crores @endif)
                                                                </th>
                                                                <th>बचत
                                                                    <br>
                                                                    (@if($convert==1)In Rs @elseif($convert==2) In Lakhs @elseif($convert==3) In Crores @endif)
                                                                </th>
                                                                <th>% व्यय </th>
                                                                <th>अभ्युक्ति</th>
                                                                <th class="noprint">जमा करने की तिथि</th>
                                                                <th class="noprint">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $t_directorate_seventy = 0;
                                                            $t_amount_of_money_spent = 0;
                                                            $t_savings = 0;
                                                            $t_savings_percent = 0;
                                                            $chan=1;
                                                            if($convert==1){
                                                                $chan=1;
                                                            }elseif($convert==2){
                                                                $chan=100000;
                                                            }elseif($convert==3){
                                                                $chan=10000000;
                                                            }
                                                            ?>
                                                              @foreach ($vyayaadhi_bachat as $key => $item)
                                                                <tr>
                                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                                    <td>
                                                                        <?php $division_id = DB::table('hostel_div_district_mapping')
                                                                            ->where('district_id', $item->district_id)
                                                                            ->first(); ?>
                                                                        @if ($division_id)
                                                                            {{ divisionName($division_id->division_id) }}
                                                                        @else
                                                                            NA
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ !empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }}
                                                                    </td>
                                                                    {{-- <td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}
                                                                        </td> --}}
                                                                    <td>{{ month_name($item->month_name) }}</td>
                                                                    <td>{{ $item->year }}</td>
                                                                    <td class="text-center">
                                                                        <?php if ($item->item_name == 1) { ?>
                                                                        2013-मंत्रि परिशद 105-मंत्रियों द्वारा विवेकाधीन
                                                                        अनुदान 03-क्रीड़ा मंत्री द्वारा विवेकाधीन अनुदान
                                                                        42-अन्य व्यय
                                                                        <?php } else if ($item->item_name == 2) { ?>
                                                                        2059.लोक निर्माण कार्य 80.सामान्य 053.रखरखाव तथा
                                                                        मरम्मत 03.मेयोहाल इलाहाबाद के अनावासीय भवनों का
                                                                        अनुरक्षण 29-अनुरक्षण
                                                                        <?php } else if ($item->item_name == 3) { ?>
                                                                        2204-खेलकूद तथा युवा सेवायें 001-निदेषन तथा प्रषासन
                                                                        03-खेलकूद निदेषालय
                                                                        <?php } else if ($item->item_name == 4) { ?>
                                                                        104-खेलकूद
                                                                        <?php } else if ($item->item_name == 5) { ?>
                                                                        800-अन्य व्यय 03-मेजर ध्यानचन्द विश्वविद्यालय, मेरठ
                                                                        <?php } else { ?>
                                                                        -
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($item->item_name == 3) { ?>
                                                                        <?php if ($item->revenue_accounting == 1) { ?>
                                                                        01-वेतन
                                                                        <?php } else if ($item->revenue_accounting == 2) { ?>
                                                                        03-मंहगाई भत्ता
                                                                        <?php } else if ($item->revenue_accounting == 3) { ?>
                                                                        04-यात्रा व्यय
                                                                        <?php } else if ($item->revenue_accounting == 4) { ?>
                                                                        05-स्थानान्तरण यात्रा व्यय
                                                                        <?php } else if ($item->revenue_accounting == 5) { ?>
                                                                        06-अन्य भत्ते
                                                                        <?php } else if ($item->revenue_accounting == 6) { ?>
                                                                        07-मानदेय
                                                                        <?php } else if ($item->revenue_accounting == 7) { ?>
                                                                        08-कार्यालय व्यय
                                                                        <?php } else if ($item->revenue_accounting == 8) { ?>
                                                                        09-विद्युत देय
                                                                        <?php } else if ($item->revenue_accounting == 9) { ?>
                                                                        10-जलकर/जल प्रभार
                                                                        <?php } else if ($item->revenue_accounting == 10) { ?>
                                                                        11-लेखन सामग्री और फार्मो की छपाई
                                                                        <?php } else if ($item->revenue_accounting == 11) { ?>
                                                                        12-कार्यालय फर्नीचर एवं उपकरण
                                                                        <?php } else if ($item->revenue_accounting == 12) { ?>
                                                                        13-टेलीफोन पर व्यय
                                                                        <?php } else if ($item->revenue_accounting == 13) { ?>
                                                                        15-गाड़ियो का अनुरक्षण और पेट्रोल आदि की खरीद
                                                                        <?php } else if ($item->revenue_accounting == 14) { ?>
                                                                        16-व्यावसायिक तथा विषेश सेवाओं के लिए भुगतान
                                                                        <?php } else if ($item->revenue_accounting == 15) { ?>
                                                                        17-किराया, उपषुल्क और कर स्वामित्व
                                                                        <?php } else if ($item->revenue_accounting == 16) { ?>
                                                                        22-आतिथ्य व्यय/व्यय विशयक भत्ता आदि
                                                                        <?php } else if ($item->revenue_accounting == 17) { ?>
                                                                        26-मषीने और सज्जा/उपकरण और संयंत्र
                                                                        <?php } else if ($item->revenue_accounting == 18) { ?>
                                                                        42-अन्य व्यय
                                                                        <?php } else if ($item->revenue_accounting == 19) { ?>
                                                                        44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय
                                                                        <?php } else if ($item->revenue_accounting == 20) { ?>
                                                                        45-अवकाष यात्रा व्यय
                                                                        <?php } else if ($item->revenue_accounting == 21) { ?>
                                                                        46-कम्प्यूटर हार्डवेयर/साफ्टवेयर का क्रय
                                                                        <?php } else if ($item->revenue_accounting == 22) { ?>
                                                                        47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय
                                                                        <?php } else if ($item->revenue_accounting == 23) { ?>
                                                                        49-चिकित्सा व्यय
                                                                        <?php } else if ($item->revenue_accounting == 24) { ?>
                                                                        51-वर्दी व्यय
                                                                        <?php } else if ($item->revenue_accounting == 25) { ?>
                                                                        55-मकान किराया भत्ता
                                                                        <?php } else if ($item->revenue_accounting == 26) { ?>
                                                                        56-नगर प्रतिकर भत्ता
                                                                        <?php } else if ($item->revenue_accounting == 27) { ?>
                                                                        58-आउट सोर्सिंग सेवाओं हेतु भुगतान
                                                                        <?php } else if ($item->revenue_accounting == 28) { ?>
                                                                        59-एकमुश्त नियोक्ता अंशदान/ब्याज
                                                                        <?php } ?>
                                                                        -
                                                                        <?php
                                                                        } else if ($item->item_name == 4) {
                                                                        ?>

                                                                        <?php if ($item->revenue_accounting == 1) { ?>
                                                                        03-सरकारी कर्मचारियों तथा उनके परिवारों के कल्याण
                                                                        सम्बन्धी कार्यकलाप 20-सहायता अनुदान-सामान्य (गैर
                                                                        वेतन)
                                                                        <?php } else if ($item->revenue_accounting == 2) { ?>
                                                                        04-क्रीड़ा छात्रावास के आवासीय खिलाड़ियों पर व्यय
                                                                        (बालिकाओं हेतु) 12-कार्यालय फर्नीचर एवं उपकरण
                                                                        <?php } else if ($item->revenue_accounting == 3) { ?>
                                                                        42-अन्य व्यय
                                                                        <?php } else if ($item->revenue_accounting == 4) { ?>
                                                                        05-भूतपूर्व प्रसिद्ध खिलाड़ियों तथा पहलवानों को
                                                                        वित्तीय सहायता 20-सहायता अनुदान-सामान्य (गैर वेतन)
                                                                        <?php } else if ($item->revenue_accounting == 5) { ?>
                                                                        06-क्रीड़ा छात्रावास के आवासीय खिलाड़ियों पर व्यय
                                                                        (बालको हेतु) 12-कार्यालय फर्नीचर एवं उपकरण
                                                                        <?php } else if ($item->revenue_accounting == 6) { ?>
                                                                        42-अन्य व्यय
                                                                        <?php } else if ($item->revenue_accounting == 7) { ?>
                                                                        07-उत्तर प्रदेश खेल विकास एवं प्रोत्साहन योजना
                                                                        42-अन्य व्यय
                                                                        <?php
                                                                            if ($item->uttar_pradesh_sports_development == 1) { ?>
                                                                        &nbsp > &nbsp 08-मेयोहाल इलाहाबाद में स्थापित
                                                                        क्रीड़ा स्थल
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 2) { ?>
                                                                        &nbsp > &nbsp 01-वेतन
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 3) { ?>
                                                                        &nbsp > &nbsp 03-मंहगाई भत्ता
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 4) { ?>
                                                                        &nbsp > &nbsp 04-यात्रा व्यय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 5) { ?>
                                                                        &nbsp > &nbsp 05-स्थानान्तरण यात्रा व्यय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 6) { ?>
                                                                        &nbsp > &nbsp 06-अन्य भत्ते
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 7) { ?>
                                                                        &nbsp > &nbsp 08-कार्यालय व्यय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 8) { ?>
                                                                        &nbsp > &nbsp 09-विद्युत देय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 9) { ?>
                                                                        &nbsp > &nbsp 10-जलकर/जल प्रभार
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 10) { ?>
                                                                        &nbsp > &nbsp 11-लेखन सामग्री और फार्मो की छपाई
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 11) { ?>
                                                                        &nbsp > &nbsp 12-कार्यालय फर्नीचर एवं उपकरण
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 12) { ?>
                                                                        &nbsp > &nbsp 13-टेलीफोन पर व्यय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 13) { ?>
                                                                        &nbsp > &nbsp 43-सामग्री एवं सम्पूर्ति
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 14) { ?>
                                                                        &nbsp > &nbsp 44-प्रषिक्षण हेतु यात्रा एवं अन्य
                                                                        प्रासंगिक व्यय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 15) { ?>
                                                                        &nbsp > &nbsp 45-अवकाष यात्रा व्यय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 16) { ?>
                                                                        &nbsp > &nbsp 47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी
                                                                        स्टेषनरी का क्रय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 17) { ?>
                                                                        &nbsp > &nbsp 49-चिकित्सा व्यय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 18) { ?>
                                                                        &nbsp > &nbsp 51-वर्दी व्यय
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 19) { ?>
                                                                        &nbsp > &nbsp 55-मकान किराया भत्ता
                                                                        <?php } else if ($item->uttar_pradesh_sports_development == 20) { ?>
                                                                        &nbsp > &nbsp 56-नगर प्रतिकर भत्ता
                                                                        <?php } ?>

                                                                        <?php } else if ($item->revenue_accounting == 8) { ?>
                                                                        09-क्रीड़ागनों/स्टेडियमों/बहुउद्देषीय
                                                                        हालों/तरणतालांे/छात्रावासों एवं भवनों का अनुरक्षण
                                                                        29-अनुरक्षण
                                                                        <?php } else if ($item->revenue_accounting == 9) { ?>
                                                                        10-विषिश्ट खिलाड़ियों को प्रदेषीय पुरस्कार 20-सहायता
                                                                        अनुदान-सामान्य (गैर वेतन)
                                                                        <?php } else if ($item->revenue_accounting == 10) { ?>
                                                                        11-क्रीड़ा एवं खेलकूद प्रतियोगिताओं का आयोजन (राज्य
                                                                        से.) 42-अन्य व्यय
                                                                        <?php } else if ($item->revenue_accounting == 11) { ?>
                                                                        12-खेलकूद उपकरण सामग्री की सम्पूर्ति 43-सामग्री एवं
                                                                        सम्पूर्ति
                                                                        <?php } else if ($item->revenue_accounting == 12) { ?>
                                                                        16-प्रत्येक क्रीड़ांगन में एक फिजियोथैरेपी केन्द्र
                                                                        की स्थापना 42-अन्य व्यय
                                                                        <?php } else if ($item->revenue_accounting == 13) { ?>
                                                                        18-प्रषिक्षण (राज्य सेक्टर)- 42-अन्य व्यय
                                                                        <?php } else if ($item->revenue_accounting == 14) { ?>
                                                                        21-राश्ट्रीय प्रतियोगिताओं में भाग लेने वाली
                                                                        प्रदेषीय टीम के खिलाड़ियों हेतु किट की व्यवस्था
                                                                        20-सहायता अनुदान-सामान्य (गैर वेतन)
                                                                        <?php } else if ($item->revenue_accounting == 15) { ?>
                                                                        29-राश्ट्रीय एवं अन्तर्राश्ट्रीय स्तर की खेल
                                                                        प्रतियोगिताओं का आयोजन-20-सहायता अनुदान-सामान्य (गैर
                                                                        वेतन)
                                                                        <?php } else if ($item->revenue_accounting == 16) { ?>
                                                                        30-पंडित दीन दयाल उपाध्याय जी की जन्म षताब्दी के
                                                                        अवसर पर खेल प्रतियोगिताओं का आयोजन 20-सहायता
                                                                        अनुदान-सामान्य (गैर वेतन)
                                                                        <?php } else if ($item->revenue_accounting == 17) { ?>
                                                                        30-पंडित दीन दयाल उपाध्याय जी की जन्म षताब्दी के
                                                                        अवसर पर खेल प्रतियोगिताओं का आयोजन 20-सहायता
                                                                        अनुदान-सामान्य (गैर वेतन)
                                                                        <?php } else if ($item->revenue_accounting == 18) { ?>
                                                                        30-पंडित दीन दयाल उपाध्याय जी की जन्म षताब्दी के
                                                                        अवसर पर खेल प्रतियोगिताओं का आयोजन 20-सहायता
                                                                        अनुदान-सामान्य (गैर वेतन)
                                                                        <?php }
                                                                            } else if ($item->item_name == 5) { ?>
                                                                        <?php if ($item->revenue_accounting == 1) { ?>
                                                                        01-वेतन
                                                                        <?php } else if ($item->revenue_accounting == 2) { ?>
                                                                        03-मंहगाई भत्ता
                                                                        <?php } else if ($item->revenue_accounting == 3) { ?>
                                                                        04-यात्रा व्यय
                                                                        <?php } else if ($item->revenue_accounting == 4) { ?>
                                                                        05-स्थानान्तरण यात्रा व्यय
                                                                        <?php } else if ($item->revenue_accounting == 5) { ?>
                                                                        06-अन्य भत्ते
                                                                        <?php } else if ($item->revenue_accounting == 6) { ?>
                                                                        07-मानदेय
                                                                        <?php } else if ($item->revenue_accounting == 7) { ?>
                                                                        08-कार्यालय व्यय
                                                                        <?php } else if ($item->revenue_accounting == 8) { ?>
                                                                        09-विद्युत देय
                                                                        <?php } else if ($item->revenue_accounting == 9) { ?>
                                                                        10-जलकर/जल प्रभार
                                                                        <?php } else if ($item->revenue_accounting == 10) { ?>
                                                                        11-लेखन सामग्री और फार्मो की छपाई
                                                                        <?php } else if ($item->revenue_accounting == 11) { ?>
                                                                        12-कार्यालय फर्नीचर एवं उपकरण
                                                                        <?php } else if ($item->revenue_accounting == 12) { ?>
                                                                        13-टेलीफोन पर व्यय
                                                                        <?php } else if ($item->revenue_accounting == 13) { ?>
                                                                        15-गाड़ियो का अनुरक्षण और पेट्रोल आदि की खरीद
                                                                        <?php } else if ($item->revenue_accounting == 14) { ?>
                                                                        16-व्यावसायिक तथा विषेश सेवाओं के लिए भुगतान
                                                                        <?php } else if ($item->revenue_accounting == 15) { ?>
                                                                        17-किराया, उपषुल्क और कर स्वामित्व
                                                                        <?php } else if ($item->revenue_accounting == 16) { ?>
                                                                        22-आतिथ्य व्यय/व्यय विशयक भत्ता आदि
                                                                        <?php } else if ($item->revenue_accounting == 17) { ?>
                                                                        26-मषीने और सज्जा/उपकरण और संयंत्र
                                                                        <?php } else if ($item->revenue_accounting == 18) { ?>
                                                                        42-अन्य व्यय
                                                                        <?php } else if ($item->revenue_accounting == 19) { ?>
                                                                        44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय
                                                                        <?php } else if ($item->revenue_accounting == 20) { ?>
                                                                        45-अवकाष यात्रा व्यय
                                                                        <?php } else if ($item->revenue_accounting == 21) { ?>
                                                                        46-कम्प्यूटर हार्डवेयर/साफ्टवेयर का क्रय
                                                                        <?php } else if ($item->revenue_accounting == 22) { ?>
                                                                        47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय
                                                                        <?php } else if ($item->revenue_accounting == 23) { ?>
                                                                        49-चिकित्सा व्यय
                                                                        <?php } else if ($item->revenue_accounting == 24) { ?>
                                                                        51-वर्दी व्यय
                                                                        <?php } else if ($item->revenue_accounting == 25) { ?>
                                                                        55-मकान किराया भत्ता
                                                                        <?php } else if ($item->revenue_accounting == 26) { ?>
                                                                        56-नगर प्रतिकर भत्ता
                                                                        <?php } else if ($item->revenue_accounting == 27) { ?>
                                                                        58-आउट सोर्सिंग सेवाओं हेतु भुगतान

                                                                        <?php } ?>

                                                                        <?php
                                                                        } ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php $t_directorate_seventy += $item->directorate_seventy; ?>
                                                                        {{ isset($item->directorate_seventy) ? $item->directorate_seventy / $chan : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        <?php $t_amount_of_money_spent += $item->amount_of_money_spent; ?>
                                                                        {{ isset($item->amount_of_money_spent) ? $item->amount_of_money_spent / $chan : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        <?php $t_savings += $item->savings; ?>
                                                                        {{ isset($item->savings) ? $item->savings / $chan : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        <?php $t_savings_percent += $item->savings_percent; ?>
                                                                        {{ isset($item->savings_percent) ? $item->savings_percent : '-' }}
                                                                    </td>

                                                                    <td>{{ isset($item->allegation) ? $item->allegation : '-' }}
                                                                    </td>
                                                                    <td class="noprint">{{ date('d-m-Y', strtotime(isset($item->created_on))) ? date('d-m-Y', strtotime($item->created_on)) : '-' }}
                                                                    </td>
                                                                    <td class="text-center noprint">
                                                                        <a class="btn btn-sm btn-dark pointer bt"
                                                                            href="{{ route('vyayaadhi_bachat', $item->id) }}">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>

                                                                        <a class="btn btn-sm btn-danger pointer bt"
                                                                            href="{{ route('delete_inf', [$item->id, 'vyayaadhi_bachat']) }}"
                                                                            onclick="return confirm('Are you sure you want to delete ?')">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                               
                                                        </tbody>

                                                      
                                                            
                                                                <tr>
                                                                <td colspan="7" align="right"><b>कुल योग </b></td>
                                                                <td>{{ $t_directorate_seventy / $chan}}</td>
                                                                <td>{{ $t_amount_of_money_spent / $chan}}</td>
                                                                <td>{{ $t_savings / $chan}}</td>
                                                                <td>{{ $t_savings_percent}}</td>
                                                                <td  colspan="3" class="text-center"></td>
                                                            </tr>
                                                            
                                                            
                                                 

                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
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
    </div>

@endsection
@push('custom-scripts')
    <script>
        function PrintDoc() {
            $('#dataTable').DataTable().destroy();
            var toPrint = document.getElementById('prodiv');

            var popupWin = window.open('', '_blank',
                'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

            popupWin.document.open();

            popupWin.document.write(
                '<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px;} .table > thead > tr > th{background-color: #eee;}</style></head><body onload="window.print()">'
                )

            popupWin.document.write(toPrint.innerHTML);

            popupWin.document.write('</body></html>');

            popupWin.document.close();

            $('#dataTable').DataTable();

        }
    </script>
    <script type="text/javascript">
        $('input[name="identified_the_department"]').click(function() {
            var identified_the_department = $(this).val();
            if (identified_the_department == 1) {
                $('#district_name_selected').show();
                $('#tehsil_name_selected').hide();
                $("#district_name").prop('required', true);
                $("#tehsil_name").prop('required', false);
            } else if (identified_the_department == 2) {
                $('#tehsil_name_selected').show();
                $('#district_name_selected').hide();
                $("#district_name").prop('required', false);
                $("#tehsil_name").prop('required', true);
                //$("#um_land_remarks").prop('required', false);
            }
        });

        function getval(sel) {
            //alert(sel.value);
            console.log(sel.value)
            if (sel.value == 3) {
                $("#play-2204").css("display", "block");
                $("#play-104").css("display", "none");
                $("#play-105").css("display", "none");

                $("#play-2204").attr('required', 'required');
                $("#play-104").removeAttr('required');
                $("#play-07").removeAttr('required');
                $("#play-105_fi").removeAttr('required');

            } else if (sel.value == 4) {
                $("#play-2204").css("display", "none");
                $("#play-105").css("display", "none");
                $("#play-104").css("display", "block");

                $("#play-104").attr('required', 'required');
                $("#play-105_fi").removeAttr('required');
                $("#play-2204").removeAttr('required');
                $("#play-07").removeAttr('required');

            } else if (sel.value == 5) {
                $("#play-2204").css("display", "none");
                $("#play-104").css("display", "none");
                $("#play-07").css("display", "none");
                $("#play-105").css("display", "block");

                $("#play-105_fi").attr('required', 'required');
                $("#play-104").removeAttr('required');
                $("#play-07_fi").val('');
                $("#play-2204").removeAttr('required');
                $("#play-07").removeAttr('required');

            } else if (sel.value == 1 || sel.value == 2) {
                $("#play-2204").css("display", "none");
                $("#play-104").css("display", "none");
                $("#play-105").css("display", "none");
                $("#play-07").css("display", "none");

                $("#play-2204").removeAttr('required');
                $("#play-104").removeAttr('required');
                $("#play-105_fi").removeAttr('required');
                $("#play-07").removeAttr('required');
            }
        }

        function getplay104(sel) {
            if (sel.value == 7) {
                $("#play-07").css("display", "block");
                $("#play-07").attr('required', 'required');
            } else {
                $("#play-07").css("display", "none");
                $("#play-2204").removeAttr('required');
            }

        }

        function calc() {
            var allotted = $('#directorate_seventy').val();
            var spent = $('#amount_of_money_spent').val();

            if (allotted != '' && spent != '') {
                $('#savings_percent').val(((spent * 100) / allotted).toFixed(2));
                $('#savings').val(parseInt(allotted) - parseInt(spent));
            }

        }

        //    $('input[name="identified_the_department"]').click(function() {
        //        var identified_the_department = $(this).val();
        //        if (identified_the_department == 1) {
        //            $('#district_name_selected').show();
        //            $('#tehsil_name_selected').hide();

        //        } else if (identified_the_department == 2) {
        //            $('#tehsil_name_selected').show();
        //            $('#district_name_selected').hide();

        //        }
        //    });
    </script>
@endpush
