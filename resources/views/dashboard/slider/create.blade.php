@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Create New Slider</h3>
                    <a href="{{ route('slider.index') }}" class="btn btn-sm btn-secondary float-right">Slider List</a>
                </div>
                {!! Form::open(['route' => 'slider.store', 'method' => 'POST']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Slider Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter slider title">
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="">Slider Description (optional)</label>
                        <textarea name="description" placeholder="Enter Slider Description" class="form-control" rows="5"></textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Slider Photo</label>
                                <input type="file" name="slide_file">
                                <span class="text-danger">{{ $errors->first('slide_file') }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Status</label>
                                {!! Form::select('status', getStatus(), 1, ['placeholder' => 'Select Status', 'class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('status') }}</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button class="btn btn-sm btn-primary" onclick="submit_form(this, event)">Add Slider</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection