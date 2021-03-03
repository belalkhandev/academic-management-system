@extends('layouts.master')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Group List</h3>
            <a href="{{ route('group.create') }}" class="btn btn-sm btn-primary float-right">Create new</a>
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
                    @if($groups)
                        @foreach ($groups as $key => $group)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $group->name }}</td>
                                <td>{!! styleStatus($group->status) !!}</td>
                                <td class="inline-element">
                                    <a href="{{ route('group.edit', $group->id) }}" data-toggle="tooltip" title="Delete" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                    {!! Form::open(['route' => ['group.destroy', $group->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
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