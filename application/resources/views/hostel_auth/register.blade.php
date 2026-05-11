@extends('layouts\admin_layout_hostelAuth')
@section('hostelcontent')

<div class="col-md-6 bg-light1">
    <div class="pt-3 pb-5 login-form">
        <div class="text-center text-md-center mt-md-0">
            <h3 class="mb-0">Applicant Registration/आवेदक का पंजीकरण</h3>
            <div class="text-center mt-2">
				<span class="fw-normal">Already Registered?  <a href="{{route('hostel.login')}}" class="fw-bold">Sign In</a></span>
			<br>
			<span class="fw-normal">पहले से पंजीकृत हैं? <a href="{{route('hostel.login')}}" class="fw-bold">साइन इन करें </a></span>
			</div>
        </div>
        <form action="{{route('hostel.registerStore')}}" class="mt-4 needs-validation" novalidate  method="post"  >
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">1. Applicant’s Name/आवेदक का नाम</label>
                        <input type="text" class="form-control" id="fname" name="name" value="{{old('name')}}"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'  pattern="^[A-Za-z -]+$" maxlength="255" required>
                        @error('name')
                           <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">2. Date of Birth/जन्मतिथि</label>
                        <input type="date" class="form-control" pattern="/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/" data-language="en"  placeholder="DD/MM/YYYY" id="datepick" name="dob" value="{{old('dob')}}"  min="<?=  date('Y', strtotime('-15 years')); ?>-04-01" max="<?=  date('Y', strtotime('-8 years')); ?>-03-31" required>
                        @error('dob')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">3. Aadhaar Number/आधार नंबर</label>
                        <input type="text" class="form-control " oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="12" minlength="12" pattern="[0-9]{12}" id="aadhar_no" name='aadhar' value="{{old('aadhar')}}" required>
                        @error('aadhar')
                        <div class="text-danger">{{ $message }}</div>
                       @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="name">4. Is the applicant a native of Uttar Pradesh?/क्या आवेदक उत्तर प्रदेश के मूल निवासी हैं?</label>
                        <div class="form-control">
                            <div class="form-check form-check-inline m-0">  
                                <input onclick="getNativeOfup(this.value)" class="form-check-input native_check" type="radio" name="native_of_up" @if (old('native_of_up') == 1) checked @endif required id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Yes/हाँ</label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <input onclick="getNativeOfup(this.value)" class="form-check-input native_check" type="radio" name="native_of_up" id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">No/नहीं</label>
                            </div>
                        </div>
                        @error('native_of_up')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="name">5. Gender/लिंग</label>
                        <div class="form-control">
                            <div class="form-check form-check-inline m-0">
                                <input  class="form-check-input native_check" type="radio" name="gender" @if (old('gender') == 1) checked @endif  required id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Male/पुरुष	</label>
                            </div>
                            <div class="form-check form-check-inline m-0">
                                <input  class="form-check-input native_check" type="radio" name="gender" @if (old('gender') == 2) checked @endif  required id="inlineRadio2" value="2">
                                <label class="form-check-label" for="inlineRadio2">Female/महिला</label>
                            </div>
                        </div>
                        @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">6. Mobile Number/मोबाइल नंबर</label>
                        <input type="text" class="form-control " name="mobile" maxlength="10" pattern="[6-9][0-9]{9}$"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('mobile')}}" required>
                        @error('mobile')
                        <div class="text-danger">{{ $message }}</div>
                     @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">7. Email ID/ईमेल आईडी</label>
                        <input type="email" class="form-control "  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" value="{{old('email')}}" required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-5 col-5">
                        <div class="captcha">
                            <label class="btn-block">8. Captcha/कैप्चा</label>
                            <span class="unselectable" id="cp_refresh">{{$captchaCode}}</span>
                           <input name="captchacode" type="hidden" class="form-control unselectable h4" value="{{$captchaCode}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-1 col-1 refresh">
                        <div class="cp_refresh"><a href="{{route('hostel.register')}}" title="Refresh Captcha"><span class="fas fa-redo"></span></a></div>
                    </div>
                    <div class="col-md-6 col-6">
                        <label>9. Enter Captcha/कैप्चा भरें</label>
                        <input name="captcha" type="text" class="form-control " value="{{old('captcha')}}" required>
                        @error('captcha')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <button type="submit" class="btn btn-info w-100">Register/पंजीकरण करें<span class="fa fa-arrow-right"></span></button>
                    </div>
                    <div class="col-md-6 col-6">
                        <a href="{{route('hostel.register')}}"  class="btn btn-danger w-100">Reset/रीसेट करें</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection



<script>
    $(document).ready(function(){
    $('#Admission').modal('hide');
});
    </script>


