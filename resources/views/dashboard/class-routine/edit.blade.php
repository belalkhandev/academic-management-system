@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Create Routine</h3>
                </div>
                {!! Form::open(['route' => ['class-routine.update', $routine->id], 'method' => 'PUT']) !!}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Session</label>
                                {!! Form::select('session', makeDropdownList($session_list), $routine->session_id, ['placeholder' => 'Select Session', 'class' => 'form-control', 'id' => 'session']) !!}
                                <span class="text-danger">{{ $errors->first('session') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Class</label>
                                {!! Form::select('class', makeDropdownList($classes), $routine->academic_class_id, ['placeholder' => 'Select Class', 'class' => 'form-control', 'id' => 'class']) !!}
                                <span class="text-danger">{{ $errors->first('class') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Group</label>
                                {!! Form::select('group', makeDropdownList($groups), $routine->group_id, ['placeholder' => 'Select Group', 'class' => 'form-control', 'id' => 'group']) !!}
                                <span class="text-danger">{{ $errors->first('group') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Section</label>
                                {!! Form::select('section', makeDropdownList($sections), $routine->section_id, ['placeholder' => 'Select Section', 'class' => 'form-control', 'id' => 'section']) !!}
                                <span class="text-danger">{{ $errors->first('section') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Day</label>
                                {!! Form::select('day', makeDropdownList($days), $routine->day_id, ['placeholder' => 'Select Day', 'class' => 'form-control',]) !!}
                                <span class="text-danger">{{ $errors->first('day') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Subject</label>
                                {!! Form::select('subject', makeDropdownList($subjects), $routine->subject_id, ['placeholder' => 'Select Subject', 'class' => 'form-control', 'id' => 'subject']) !!}
                                <span class="text-danger">{{ $errors->first('subject') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Teacher</label>
                                {!! Form::select('teacher', makeDropdownList($teachers), $routine->teacher_id, ['placeholder' => 'Select teacher', 'class' => 'form-control',]) !!}
                                <span class="text-danger">{{ $errors->first('teacher') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Start Time</label>
                                <input type="time" name="start_time" class="form-control" value="{{ $routine->start_time }}">
                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">End Time</label>
                                <input type="time" name="end_time" class="form-control" value="{{ $routine->end_time }}">
                                <span class="text-danger">{{ $errors->first('end_time') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                {!! Form::select('status', getStatus(), $routine->status, ['placeholder' => 'Select Status', 'class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-sm btn-primary" onclick="submit_form(this, event)">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @push('footer-scripts')
    <script>
        (function ($) {
            "use-strict"
        
            jQuery(document).ready(function () {
                //find subjects
                $(document).on('change', '#class', function () {
                    var class_id = $('#class').val();
                    var group_id =  $('#group').val();
                    $('#subject').html('<option value="">Select Subject</option>');
                    if (class_id) {
                        $.ajax("{{ route('ajax-find.subject') }}", {
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                class_id: class_id,
                                group_id: group_id
                            },
                            beforeSend: function (xhr) {
                                $('#subject').html('<option value="">Loading........</option>');
                            },
                            success: function (res, status, xhr) {
                                if (status == 'success') { 
                                    $('#subject').html('');                                   
                                    if (res.length > 0) {
                                        $('#subject').append('<option value="">Select Subject</option>');
                                        $.each(res, function(i, subject) {
                                            $('#subject').append('<option value="'+subject.id+'">'+subject.name+'</option>');
                                        });
                                    } else {
                                        $('#subject').append('<option value="">No subject found</option>');
                                    }
                                }
                            },
                            error: function (jqXhr, textStatus, errorMessage) {
                                console.log(textStatus);
                            }
                        });
                    }
                })
            });
        
        }(jQuery));
    </script>
    @endpush
@endsection
