@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">update Session</h3>
                    <a href="{{ route('class.index') }}" class="btn btn-sm btn-secondary float-right">Class List</a>
                </div>
                {!! Form::open(['route' => ['subject.update', $subject->id], 'method' => 'POST']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Class</label>
                        {!! Form::select('class', makeDropdownList($classes), $subject->academic_class_id, ['placeholder' => 'Select Class', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('class') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Group</label>
                        {!! Form::select('group', makeDropdownList($groups), $subject->group_id, ['placeholder' => 'Select Group', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('group') }}</span>
                        </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter subject name" value="{{ $subject->name }}">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Subject Code</label>
                        <input type="text" name="code" class="form-control" placeholder="Enter subject code" value="{{ $subject->code }}">
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        {!! Form::select('status', getStatus(), $subject->status, ['placeholder' => 'Select Status', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Cover Photo</label>
                        <br>
                        <input type="file" name="cover_photo">
                        <span class="text-danger">{{ $errors->first('cover_photo') }}</span>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button class="btn btn-sm btn-primary" onclick="submit_form(this, event)">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection