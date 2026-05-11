@extends('layouts/layout')
@section('content')

<div class="pageheader" id="menu-margin">
    <h4 class="mb-0">
        I am applying for
    </h4>
</div>
<div class="card">
    <div class="card-body">
        {{-- @if(count($award_type)==0) 
            <h4>Already Apply For All</h4>                            
        @else--}}
        <form action="{{url('saveApplyFor')}}" method="post" class="needs-validation mt-4 " novalidate>
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <h5 class="subheading">I am applying for/मैं आवेदन कर रहा/रही हूं</h5>
                </div>
                @foreach ($award_type as $type)
                <?php $check = form_date_status($type->id); ?>
                <?php $checkk = form_apply_status($type->id); ?>
                <div class="col-md-12 mb-3">
                    <div class="form-check form-check-inline">
                        <input type="radio" name="applyfor" onClick="document.getElementById('reg-submit').disabled=false" @if($checkk==0 || $check==0 ) disabled @endif required value="{{$type->id}}" class="form-input" />
                        <label class="form-check-label" for="inlineCheckbox2">{{$type->text}}</label>
                        @if($checkk == 1 && $check == 0)<p class="text-danger">*Form Not Available</p>@endif
                        @if($checkk == 0)<p class="text-danger">*Form Already Filled</p>@endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="bhoechie-footer">
                <div class="row justify-content-center">
                    <div class="col-md-3 d-grid">
                        <button type="submit" id="reg-submit" disabled class="btn btn-info">Save & Proceed/दर्ज करें व आगे बढ़ें</button>
                    </div>
                </div>
            </div>
        </form>
        {{-- @endif --}}
    </div>
</div>
</div>
</div>
</div>
@endsection
