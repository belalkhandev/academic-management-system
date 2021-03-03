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
                    @if($all_notices)
                    <div class="notice-items all-notice">
                        @foreach ($all_notices as $key => $notice)
                            <div class="notice-item">
                                <h4><a href="{{ route('frontend.notice.show', $notice->id) }}">{{ $notice->title }}</a></h4>
                                <div class="publish_date"><i class="fas fa-calendar-alt"></i> {{ user_formatted_date($notice->publish_date) }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="notice-paginate">
                        {{ $all_notices->links() }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                @include('frontend.partials._sidebar')
            </div>
        </div>
    </div>
</section>

@endsection