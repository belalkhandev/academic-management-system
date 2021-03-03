@extends('layouts.master')

@section('content')
    {{-- exam type --}}
    <div class="row">
        <div class="col-md-6">
            <div class="tab-box">
                <div class="tab-box-header">
                    <h3 class="tab-box-header-title">Mark Settings</h3>
                    <div class="tab-box-header-action">
                        @if($exam_mark)
                        <button class="btn btn-custom-gray" data-toggle="modal" data-target="#updateExamMark">Update Mark</button>
                        @else
                        <button class="btn btn-custom-gray" data-toggle="modal" data-target="#addExamMark">Add Mark</button>
                        @endif
                    </div>
                </div>
                <div class="tab-box-body text-center">
                    @if($exam_mark)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>One equal?</th>
                                    <th>Out of?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $exam_mark->name }}</td>
                                    <td>{{ $exam_mark->equal_one }}</td>
                                    <td>{{ number_format($exam_mark->out_of, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tab-box">
                <div class="tab-box-header">
                    <h3 class="tab-box-header-title">Exam Terms</h3>
                    <div class="tab-box-header-action">
                        <button class="btn btn-custom-gray" data-toggle="modal" data-target="#addExamTerm">Add New</button>
                    </div>
                </div>
                <div class="tab-box-body">
                    @if($terms)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Total makrs</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($terms as $key => $term)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $term->name }}</td>
                                    <td>{{ $term->total_marks }}</td>
                                    <td class="inline-element">
                                        <button class="btn custom-btn-sm btn-primary edit_term" data-term_id="{{ $term->id }}"><i class="fas fa-edit"></i></button>
                                        {!! Form::open(['route' => ['exam-term.delete', $term->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
                                            <button type="submit" class="btn btn-danger custom-btn-sm" onclick="deleteSwal(this, event)" data-toggle="tooltip" title="Delete" data-placement="top">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tab-box">
                <div class="tab-box-header">
                    <h3 class="tab-box-header-title">Grade  </h3>
                    <div class="tab-box-header-action">
                        <a href="{{ route('class-routine.create') }}" class="btn btn-custom-gray"> Add new</a>
                    </div>
                </div>
                <div class="tab-box-body">
                    
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.exam.modal')
    
    
@endsection

@push('footer-scripts')
<script>
    (function ($) {
        "use-strict"

        jQuery(document).ready(function () {
            $(document).on('click', '.edit_term', function () {
                $('#editExamTerm').modal('show');
            })
        });

    }(jQuery))
</script>
@endpush