@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Session List</h3>
                    <a href="{{ route('session.create') }}" class="btn btn-sm btn-primary float-right">Crate new</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           subject @if($sessions)
                                @foreach ($sessions as $key => $session)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $session->name }}</td>
                                        <td>{!! styleStatus($session->status) !!}</td>
                                        <td class="inline-element">
                                            <a href="{{ route('session.edit', $session->id) }}" data-toggle="tooltip" title="Delete" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                            {!! Form::open(['route' => ['session.destroy', $session->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
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