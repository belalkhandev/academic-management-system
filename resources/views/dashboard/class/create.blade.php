@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Create New Class</h3>
                    <a href="{{ route('class.index') }}" class="btn btn-sm btn-secondary float-right">Class List</a>
                </div>
                {!! Form::open(['route' => 'class.store', 'method' => 'POST']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Class name">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Numeric Name</label>
                        <input type="text" name="numeric_name" class="form-control" placeholder="Enter Class numeric name">
                        <span class="text-danger">{{ $errors->first('numeric_name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        {!! Form::select('status', getStatus(), null, ['placeholder' => 'Select Status', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-sm btn-primary" onclick="submit_form(this, event)">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection