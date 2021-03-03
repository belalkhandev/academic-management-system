@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Update Notice</h3>
                    <a href="{{ route('notice.index') }}" class="btn btn-sm btn-secondary float-right">Notice List</a>
                </div>
                {!! Form::open(['route' => ['notice.update', $notice->id], 'method' => 'PUT']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Notice Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter notice title" value="{{ $notice->title }}">
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="">Notice Content</label>
                        <textarea name="notice_content" id="summernote" placeholder="Enter Notice Content Here" class="form-control">{!! $notice->content !!}</textarea>
                        <span class="text-danger">{{ $errors->first('notice_content') }}</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Attached File</label>
                                <input type="file" name="notice_file">
                                <span class="text-danger">{{ $errors->first('notice_file') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Publish Date</label>
                                <input type="text" name="publish_date" placeholder="DD-MM-YYYY" class="datepicker form-control" value="{{ datepicker_formatted_date($notice->publish_date) }}">
                                <span class="text-danger">{{ $errors->first('publish_date') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Status</label>
                                {!! Form::select('status', getStatus(), $notice->status, ['placeholder' => 'Select Status', 'class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button class="btn btn-sm btn-primary" onclick="submit_form(this, event)">Update Notice</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@push('header-styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/dist/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('footer-scripts')
<script src="{{ asset('assets/plugins/summernote/dist/summernote.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    (function ($) {
        "use-strict"

        jQuery(document).ready(function () {
            //active sumernote
            $('#summernote').summernote({
                height: 200,
                tabsize: 2,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol']],
                    ['insert', []]
                ],
                placeholder: 'Write Notice..........',
                popover: {
                    image: [],
                    link: [],
                    air: []
                }
            });

            //active datpicker
            if ($('.datepicker').length > 0) {
                $('.datepicker').datepicker({
                    todayHighlight: true,
                    format: 'dd-mm-yyyy'
                });
            }
        });


    }(jQuery));
</script>
@endpush
@endsection