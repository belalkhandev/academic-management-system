@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Department List</h3>
                    <a href="{{ route('department.create') }}" class="btn btn-sm btn-primary float-right">Crate new</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Department Details</th>
                                <th>Status</th>
                                <th style="min-width: 100px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($departments)
                                @foreach ($departments as $key => $department)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->department_details }}</td>
                                        <td>{!! styleStatus($department->status) !!}</td>
                                        <td class="inline-element">
                                            <a href="{{ route('department.edit', $department->id) }}" data-toggle="tooltip" title="Delete" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                            {!! Form::open(['route' => ['department.destroy', $department->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
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
        </div>
    </div>
@endsection