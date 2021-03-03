@extends('layouts.master')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Class List</h3>
            <a href="{{ route('class.create') }}" class="btn btn-sm btn-primary float-right">Crate new</a>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Numeric Name</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($classes)
                        @foreach ($classes as $key => $class)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $class->name }}</td>
                                <td>{{ $class->numeric_name }}</td>
                                <td>{!! styleStatus($class->status) !!}</td>
                                <td class="inline-element">
                                    <a href="{{ route('class.edit', $class->id) }}" data-toggle="tooltip" title="Delete" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                    {!! Form::open(['route' => ['class.destroy', $class->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
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
        <div class="box-footer"></div>
    </div>
@endsection