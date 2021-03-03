@extends('layouts.master')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Section List</h3>
            <a href="{{ route('section.create') }}" class="btn btn-sm btn-primary float-right">Create new</a>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Nick Name</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($sections)
                        @foreach ($sections as $key => $section)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->nick_name }}</td>
                                <td>{!! styleStatus($section->status) !!}</td>
                                <td class="inline-element">
                                    <a href="{{ route('section.edit', $section->id) }}" data-toggle="tooltip" title="Delete" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                    {!! Form::open(['route' => ['section.destroy', $section->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
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