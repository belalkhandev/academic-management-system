@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Update Department</h3>
                    <a href="{{ route('department.index') }}" class="btn btn-sm btn-secondary float-right">Department List</a>
                </div>
                {!! Form::open(['route' => ['department.update', $department->id], 'method' => 'PUT']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $department->name }}" placeholder="Enter Department name">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Department Details (optional)</label>
                        <textarea name="description" rows="4" class="form-control" placeholder="Write deparmtne details .....">{{ $department->department_details }}</textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        {!! Form::select('status', getStatus(), $department->status, ['placeholder' => 'Select Status', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('status') }}</span>
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