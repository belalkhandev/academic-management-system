@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Create New Section</h3>
                    <a href="{{ route('section.index') }}" class="btn btn-sm btn-secondary float-right">List</a>
                </div>
                {!! Form::open(['route' => 'section.store', 'method' => 'POST']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Section name">
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Nick Name</label>
                        <input type="text" name="nick_name" class="form-control" placeholder="Enter section nick name">
                        <span class="text-danger">{{ $errors->first('nick_name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        {!! Form::select('status', getStatus(), null, ['placeholder' => 'Select Status', 'class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button class="btn btn-sm btn-primary" onclick="submit_form(this, event)">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection