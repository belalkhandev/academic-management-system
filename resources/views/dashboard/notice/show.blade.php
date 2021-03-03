@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $notice->title }} <br>
                        <small>Publish Date: {{ user_formatted_date($notice->publish_date) }}</small>
                    </h3>
                    <a href="{{ route('notice.index') }}" class="btn btn-sm btn-primary float-right">Notice list</a>
                </div>
                <div class="box-body">
                    {{-- on notice having content --}}
                    @if($notice->content)
                    {!! $notice->content !!}
                    @endif

                    {{-- on notice having file --}}
                    @if($notice->attached_file)
                        @if($notice->notice_file_type == 'pdf')
                            <embed src="{{ asset($notice->attached_file) }}" type="application/pdf" class="notice_file_pdf">
                        @elseif($notice->notice_file_type == 'image')
                            <img src="{{ asset($notice->attached_file) }}" alt="Notice" class="notice_file_image">
                        @endif
                    @endif
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
@endsection