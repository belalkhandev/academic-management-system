@extends('layouts.master')

@section('content')

    @if($routines)
    <div class="criteria-box">
        <div class="criteria-box-body">
            {!! Form::open(['route' => 'class-routine.criteria', 'class' => 'criteria-box-form', 'method' => 'POST ']) !!}
                <div class="criteria-form-group">
                    {!! Form::select('session_id', makeDropdownList($session_list), $request['session_id'], ['placeholder' => 'Select Session', 'class' => 'criteria-form-control']) !!}
                </div>
                <div class="criteria-form-group">
                    {!! Form::select('class_id', makeDropdownList($classes), $request['class_id'], ['placeholder' => 'Select Class', 'class' => 'criteria-form-control']) !!}
                </div>
                <div class="criteria-form-group">
                    {!! Form::select('group_id', makeDropdownList($groups), $request['group_id'], ['placeholder' => 'Select Group', 'class' => 'criteria-form-control']) !!}
                </div>
                <div class="criteria-form-group">
                    {!! Form::select('section_id', makeDropdownList($sections), $request['section_id'], ['placeholder' => 'Select Section', 'class' => 'criteria-form-control']) !!}
                </div>
                <div class="criteria-form-submit-group">
                    <button class="btn btn-sm btn-custom-success"><i class="fas fa-search"></i> Search</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    @endif

    <div class="tab-box">
        <div class="tab-box-header">
            <h3 class="tab-box-header-title">Class Routine</h3>
            <div class="tab-box-header-action">
                <button id="criteria-box" class="btn btn-custom-success"><i class="fas fa-angle-up"></i> Criteria</button>
                <a href="{{ route('class-routine.create') }}" class="btn btn-custom-gray"> Add new</a>
            </div>
        </div>
        <div class="tab-box-body">
            @if($routines)
                <div class="tab-box-navigation">
                    <ul class="nav nav-tabs" id="classRoutineTab" role="tablist">
                        @foreach ($days as $key => $day)
                            <li class="nav-item">
                                <a class="nav-link {{ ($key==0 ? 'active' : '') }}" id="{{ $day->name }}-tab" data-toggle="tab" href="#day_{{ $day->name }}" role="tab" aria-controls="{{ $day->name }}" aria-selected="true">{{ $day->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-box-content">
                    <div class="tab-content">
                        @foreach ($days as $key => $day)
                            <div class="tab-pane fade {{ ($key==0 ? 'show active' : '') }}" id="day_{{ $day->name }}" role="tabpanel" aria-labelledby="{{ $day->name }}-tab">
                                <h3 class="tab-content-header">Class: <span class="text-success">{{ $classes->where('id', $request['class_id'])->first()->name }}</span> Session: <span class="text-danger">{{ $session_list->where('id', $request['session_id'])->first()->name }}</span></h3>
                                <div class="table-content-body">
                                    @if($day_routines = $routines->where('day_id', $day->id))

                                        @if($day_routines->isNotEmpty())
                                        <table class="table routine-table">
                                            <tbody>
                                                @foreach ($day_routines as $routine)
                                                    <tr>
                                                        <td>{{ $routine->subject->name }}</td>
                                                        <td>{{ $routine->teacher->name }}</td>
                                                        <td>{{ user_formatted_time($routine->start_time) }}</td>
                                                        <td>{{ user_formatted_time($routine->end_time) }}</td>
                                                        <td class="inline-element">
                                                            <a href="{{ route('class-routine.edit', $routine->id) }}" class="btn btn-secondary custom-btn-sm"><i class="fas fa-edit "></i></a> 
                                                            {!! Form::open(['route' => ['class-routine.destroy', $routine->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
                                                                <button type="submit" class="btn btn-danger custom-btn-sm" onclick="deleteSwal(this, event)" data-toggle="tooltip" title="Delete" data-placement="top">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @else
                                        No routine set yet.
                                        @endif
                                    
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
                @else
                {!! Form::open(['route' => 'class-routine.criteria', 'class' => 'criteria-box-form', 'method' => 'POST ']) !!}
                    <div class="criteria-form-group">
                        {!! Form::select('session_id', makeDropdownList($session_list), null, ['placeholder' => 'Select Session', 'class' => 'criteria-form-control']) !!}
                    </div>
                    <div class="criteria-form-group">
                        {!! Form::select('class_id', makeDropdownList($classes), null, ['placeholder' => 'Select Class', 'class' => 'criteria-form-control']) !!}
                    </div>
                    <div class="criteria-form-group">
                        {!! Form::select('group_id', makeDropdownList($groups), null, ['placeholder' => 'Select Group', 'class' => 'criteria-form-control']) !!}
                    </div>
                    <div class="criteria-form-group">
                        {!! Form::select('section_id', makeDropdownList($sections), null, ['placeholder' => 'Select Section', 'class' => 'criteria-form-control']) !!}
                    </div>
                    <div class="criteria-form-submit-group">
                        <button class="btn btn-sm btn-custom-success"><i class="fas fa-search"></i> Search</button>
                    </div>
                {!! Form::close() !!}
            @endif
        </div>
        <div class="tab-box-footer"></div>
    </div>

@endsection