@extends('layouts.master')

@section('content')
    <div class="tab-box">
        <div class="tab-box-header">
            <h3 class="tabl-box-header-title">Subjects List</h3>
            <div class="tab-box-header-action">
                <a href="{{ route('subject.create') }}" class="btn btn-custom-gray"> Add new</a>
            </div>
        </div>
        <div class="tab-box-body">
            <div class="tab-box-navigation">
                <ul class="nav nav-tabs" id="classRoutineTab" role="tablist">
                    @foreach ($classes as $key => $class)
                        <li class="nav-item">
                            <a class="nav-link {{ ($key==0 ? 'active' : '') }}" id="{{ $class->name }}-tab" data-toggle="tab" href="#class_{{ $class->name }}" role="tab" aria-controls="{{ $class->name }}" aria-selected="true">{{ $class->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-box-content">
                <div class="tab-content">
                    @foreach ($classes as $key => $class)
                        <div class="tab-pane fade {{ ($key==0 ? 'show active' : '') }}" id="class_{{ $class->name }}" role="tabpanel" aria-labelledby="{{ $class->name }}-tab">
                            <h3 class="tab-content-header">Class {{ $class->name }}'s Subjects</h3>
                            <div class="table-content-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Group</th>
                                            <th>Name</th>
                                            <th>Subject Code</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($class->subjects)
                                            @foreach ($class->subjects as $key => $subject)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $subject->group? $subject->group->name : "" }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>{{ $subject->code }}</td>
                                                <td>{!! styleStatus($subject->status) !!}</td>
                                                <td class="inline-element">
                                                    <a href="{{ route('subject.edit', $subject->id) }}" data-toggle="tooltip" title="Delete" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                                    {!! Form::open(['route' => ['subject.destroy', $subject->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
                                                    <button type="submit" class="btn btn-danger custom-btn-sm" onclick="deleteSwal(this, event)" data-toggle="tooltip" title="Delete" data-placement="top">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach                    
                </div>
            </div>                
        </div>
        <div class="tab-box-footer"></div>
    </div>

@endsection