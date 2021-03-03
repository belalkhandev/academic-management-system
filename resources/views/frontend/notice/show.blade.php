@extends('frontend.layouts.master')

@section('content')

<!-- page title -->
<div class="page-title-area">
    <div class="container   ">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title text-center">
                    <h3>{{ $page_title }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- maincontent area -->
<section class="main-content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main-content">
                    <div class="notice-content-area">
                        <div class="section-title">
                            <h2>{{ $single_notice->title }}</h2>
                            <p><i class="fas fa-calendar-alt"></i> {{ user_formatted_date($single_notice->publish_date) }}</p>
                        </div>
                        <div class="notice-content">
                            @if($single_notice->content)
                            {!! $single_notice->content !!}
                            @endif

                            {{-- on notice having file --}}
                            @if($single_notice->attached_file)
                                @if($single_notice->notice_file_type == 'pdf')
                                    <embed src="{{ asset($single_notice->attached_file) }}" type="application/pdf" class="notice_file_pdf">
                                @elseif($single_notice->notice_file_type == 'image')
                                    <img src="{{ asset($single_notice->attached_file) }}" alt="Notice" class="notice_file_image">
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @include('frontend.partials._sidebar')
            </div>
        </div>
    </div>
</section>

@endsection