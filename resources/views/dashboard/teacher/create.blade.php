@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">New Teacher</h3>
                    <a href="{{ route('teacher.index') }}" class="btn btn-sm btn-primary float-right">Teacher List</a>
                </div>
                {!! Form::open() !!}
                <div class="box-body">                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-section">
                                <h3 class="form-section-title">Personal Information</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" name="firstname" class="form-control" placeholder="Enter first name">
                                <span class="text-danger">{{ $errors->first('firstname') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" name="lastname" class="form-control" placeholder="Enter last name">
                                <span class="text-danger">{{ $errors->first('lastname') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Father Name</label>
                                <input type="text" name="father_name" placeholder="Enter father name" class="form-control">
                                <span class="text-danger">{{ $errors->first('father_name') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Mother Name</label>
                                <input type="text" name="mother_name" class="form-control" placeholder="Enter mother name">
                                <span class="text-danger">{{ $errors->first('mother_name') }}</span>
                            </div>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter phone">
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            </div>
                        </div>                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Emergency Contact</label>
                                <input type="text" name="emergency_contact" class="form-control" placeholder="Emergency contact">
                                <span class="text-danger">{{ $errors->first('emergency_contact') }}</span>
                            </div>
                        </div>                     
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Gender</label>
                                {!! Form::select('gender', getGenderType(), null, ['placeholder' => 'Select Gender', 'class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Marital Status</label>
                                {!! Form::select('marital_status', getMaritalStatus(), null, ['placeholder' => 'Select marital status', 'class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('marital_status') }}</span>
                            </div>
                        </div>                      
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Brithdate</label>
                                <input type="text" name="birthdate" class="form-control datepicker" placeholder="DD-MM-YYYY">
                                <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Blood Group</label>
                                {!! Form::select('blood_group', getBloodGroups(), null, ['placeholder' => 'Select Blood Group', 'class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('blood_group') }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Photo</label>
                                <input type="file" name="teacher_photo">
                                <span class="text-danger">{{ $errors->first('teacher_photo') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Present Address</label>
                                <textarea name="present_address"  class="form-control" rows="3" placeholder="Enter Present Address" id="present_address"></textarea>
                                <span class="text-danger">{{ $errors->first('present_address') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="has-sub-label">
                                    <div class="sub-label">Permanent Address</div>
                                    <div class="sub-label text-right">
                                        <label class="round-checkbox-container">
                                            <input type="checkbox" name="same_as_present" value="same_as_present" id="same_as_present" class="round-checkbox-input">
                                            <div class="round-checkbox-text">
                                                Same as present address
                                            </div>
                                        </label>
                                    </div>
                                </label>
                                <textarea name="permanent_address"  class="form-control" rows="3" placeholder="Enter Permanent Address" id="permanent_address"></textarea>
                                <span class="text-danger">{{ $errors->first('permanent_address') }}</span>
                            </div>
                        </div>                        
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-section">
                                <h3 class="form-section-title">Academic Information</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="has-sub-label">
                                    <div class="sub-label">
                                        Teacher ID 
                                    </div>
                                    <div class="sub-label text-right">
                                        <label class="round-checkbox-container">
                                            <input type="checkbox" name="teacher_id_checked" value="on_teacher_id" id="teacher_id_checked" class="round-checkbox-input">
                                            <div class="round-checkbox-text">
                                                Custom Teacher ID
                                            </div>
                                        </label>
                                    </div>
                                </label>
                                <input type="text" name="teacher_id" class="form-control"  id="teacherID" placeholder="Enter teacher id" readonly>                                
                                <span class="text-danger">{{ $errors->first('teacher_id') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Educational Qualification</label>
                                <input type="text" name="qualification" class="form-control" placeholder="Enter qualification">
                                <span class="text-danger">{{ $errors->first('qualification') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Department</label>
                                {!! Form::select('department', makeDropdownList($departments), null, ['placeholder' => 'Select department', 'class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('department') }}</span>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Designation</label>
                                <input type="text" name="designation" class="form-control" placeholder="Enter designation" autocomplete="off">
                                <span class="text-danger">{{ $errors->first('designation') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Job Type</label>
                                {!! Form::select('job_type', getJobType(), null, ['placeholder' => 'Select', 'class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('job_type') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Joining Date</label>
                                <input type="text" name="joining_date" class="form-control datepicker" placeholder="Enter joining date">
                                <span class="text-danger">{{ $errors->first('joining_date') }}</span>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Attached File (Resume/CV)</label>
                                <input type="file" name="attached_file">
                                <span class="text-danger">{{ $errors->first('attached_file') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button class="btn btn-sm btn-primary" onclick="submit_form(this, event)">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @push('header-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('footer-scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    (function ($) {
        "use-strict"

        jQuery(document).ready(function () {

            $('#existing-guardian').hide();

            //active datpicker
            if ($('.datepicker').length > 0) {
                $('.datepicker').datepicker({
                    todayHighlight: true,
                    format: 'dd-mm-yyyy'
                });
            }

            $(document).on('change', '#teacher_id_checked', function() {
                if (this.checked === true) {
                    $('#teacherID').closest('.form-control').attr('readonly', false);
                } else {
                    $('#teacherID').closest('.form-control').attr('readonly', true).val('');
                }
            });

            $(document).on('change', '#same_as_present', function() {                             
                if (this.checked === true) {
                    var present_address = $('#present_address').val();
                    $('#permanent_address').val(present_address);
                } else {
                     $('#permanent_address').val('');
                }
            });
            

        });


    }(jQuery));
</script>
@endpush
@endsection