@extends('layouts/layout')
@section('content')
<div class="row">
                <div class="col-md-2">
                    <div class="fixed-sidebar">
                        <a href="{{url('dashboard')}}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
                        <div class="left-sidebar">
                            <div >
                                <ul>
                                    <li><a  class="active"><span class="icons icon-arrow-right"></span>Application Form</a></li>
                             </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="bhoechie-tab-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="bhoechie-tab-content">
                                    <div class="form-scroll">
                                        <form action="{{url('/save_laxman_award')}}" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate="">
                                            @csrf
                                        <div >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">Applicant Details</h5>
                                                </div>
        
                                                <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                        <label class="placeholder">Which Sport do/did you play?</label>
                                                        <select class="form-select" name="sport_type" required>
                                                            <option value="">Select</option>
                                                            @foreach ($sport_type as $type)
                                                            <option  value="{{$type->id}}" {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Domicile Certificate of UP </label>
                                                            <div class="input-group">
                                                                <input type="file" value="{{old('domicile_certificate') }}" name="domicile_certificate" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
                                                                <a  class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Highest Educational Qualification</label>
                                                            <input type="text" value="{{old('qualification') }}" class="form-control" name="qualification" pattern="[A-Za-z]+" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Certificate of Highest Educational Qualification </label>
                                                            <div class="input-group">
                                                                <input type="file" name="qualification_doc" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
                                                                <a  class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">Application form for Financial Assistance</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Monthly Income through personal sources (INR)</label>
                                                            <input type="text" value="{{old('monthly_income_personal') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="monthly_income_personal" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Income Certificate</label>
                                                            <div class="input-group">
                                                                <input type="file" name="income_certificate" required class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload the District Magistrate's certificate for Income Verification</label>
                                                            <div class="input-group">
                                                                <input type="file" name="dmc_income_verification" required  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Level of Sport</label>
                                                            <select name="level_of_report" required   class="form-select">
                                                                <!-- <option value="">State level</option> -->
                                                                <option value="National level" {{ old('level_of_report') === "International level" ? 'selected' : '' }}>National level</option>
                                                                <option value="International level" {{ old('level_of_report') === "International level" ? 'selected' : '' }}>International level</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Certificate </label>
                                                            <div class="input-group">
                                                                <input type="file"  name="relevant_certificate" required  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Other Achievements/Awards</label>
                                                            <input type="text" value="{{old('other_achievements') }}" name="other_achievements" required  class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents of Other Achievements/Awards</label>
                                                            <div class="input-group">
                                                                <input type="file"  name="document_other_achievements" required  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying Achievements</label>
                                                            <div class="input-group">
                                                                <input type="file" name="document_justifying_achievements" required  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Total Professional Experience</label>
                                                            <input type="text" value="{{old('total_professional_experience') }}" name="total_professional_experience" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details, if hold the experience of Sports Association</label>
                                                            <input type="text" value="{{old('experience_sports_association') }}" name="experience_sports_association"  class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying the Experience</label>
                                                            <div class="input-group">
                                                                <input type="file" name="document_justifying_experience" required class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Income from other Sources</label>
                                                            <input type="text" value="{{old('income_other_sources') }}" name="income_other_sources"  class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying the Income</label>
                                                            <div class="input-group">
                                                                <input type="file" name="income_document_other_sources"  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Assistance being taken benefits of</label>
                                                            <input type="text" value="{{old('details_of_assistance_benefits') }}" name="details_of_assistance_benefits" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying the Assistance</label>
                                                            <div class="input-group">
                                                                <input type="file" name="relevant_documents_justifing_assistance" required class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Physical Condition of the Applicant</label>
                                                            <input type="text" value="{{old('physical_condition') }}"  name="physical_condition" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Medical Certificate if the applicant is unfit or disabled</label>
                                                            <div class="input-group">
                                                                <input type="file"  name="medical_certificate"  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Guardian Signature</label>
                                                            <div class="input-group">
                                                                <input type="file" required name="guardian_signature" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">Bank Account Details</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Name of Bank</label>
                                                            <input name="bank_name" value="{{old('bank_name') }}" required type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Branch</label>
                                                            <input name="bank_branch" value="{{old('bank_branch') }}" required type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Bank Account No.</label>
                                                            <input type="text" value="{{old('bank_acc_no') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="bank_acc_no" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">IFSC</label>
                                                            <input type="text" value="{{old('bank_ifsc') }}" name="bank_ifsc" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Account Holder Name</label>
                                                            <input type="text" value="{{old('pan') }}" name="acc_holder_name" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">PAN</label>
                                                            <input type="text" value="{{old('pan') }}" pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" name="pan" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Mobile No. (registered with Bank Account)</label>
                                                            <input type="text" value="{{old('mobile_registered_in_bank') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="mobile_registered_in_bank" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group mb-3">
                                                            <label  class="placeholder">Any other relevant information applicant wants to specify?</label>
                                                            <input value="{{old('other_relevant_information_applicant') }}" name="other_relevant_information_applicant"  type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">Sports Achievements</h5>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                          <form name="add_name1" id="add_name1">
                                                            <table  id="dataTable" class="table" id="dynamic_field1">
                                                              <tbody><tr>
                                                                <td>
                                                                    <select name="sport_achievement[]" required class="form-select">
                                                                        <option value="">Select</option>    
                                                                        <option value="National">National</option>
                                                                        <option value="International">International</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" value="{{old('sport_achievement_docs[]') }}" name="sport_achievement_name[]" placeholder="Name of the Post" class="form-control name_email"></td>
                                                                <td><div class="input-group"><input  name="sport_achievement_docs[]" type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload"><a href="#" class="btn btn-secondary" id="A4">View</a></div></td>
                                                                <td><button type="button" name="add" id="add1" class="btn btn-primary">Add More</button></td>
                                                              </tr>
                                                            </tbody></table>
                                                            <!--<input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">-->
                                                          </form>
                                                        </div>
                                                    </div>
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3 d-grid">
                                                        <button type="submit"  class="btn btn-info">Save and Next</button>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                      </form>
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
                    $(document).ready(function(){
                
                var i = 1;
                    var length;
                
                $("#add1").click(function(){
                    
                    i++;
                    $('#dynamic_field1').append('<tr id="row'+i+'"><td><select class="form-select"  name="sport_achievement[]" class="form-control name_list"><option value="">Select</option><option  value="National">National</option><option  value="International">International</option><option  value="Other">Other</option></select></td><td><input type="text" name="sport_achievement_name[]" placeholder="Name of the Post" class="form-control name_email"/></td><td><div class="input-group"><input type="file" class="form-control" name="sport_achievement_docs[]"  id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload"><a href="#" class="btn btn-secondary" id="A4">View</a></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
                    });
                
                $(document).on('click', '.btn_remove', function(){  
                    var button_id = $(this).attr("id");     
                    $('#row'+button_id+'').remove();  
                    });
                    
                
                
                 
                });
                </script>
                @endpush