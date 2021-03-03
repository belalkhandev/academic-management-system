@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Notices</h3>
                    <a href="{{ route('notice.create') }}" class="btn btn-sm btn-primary float-right">Create new</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="400px">Title</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>File</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($notices)
                                @foreach ($notices as $key => $notice)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $notice->title }}</td>
                                        <td>
                                            @if($notice->content)
                                                click on view details to show content
                                            @endif
                                        </td>
                                        <td>{{ user_formatted_date($notice->publish_date) }}</td>
                                        <td>
                                            @if($notice->attached_file)
                                                <a href="{{ asset($notice->attached_file    ) }}" download  data-toggle="tooltip" title="Download Attached File" data-placement="top" class="custom-btn-sm btn btn-warning"><i class="fas fa-download"></i></a>
                                            @endif
                                        </td>
                                        <td class="inline-element">
                                            <a href="{{ route('notice.show', $notice->id) }}" target="_blank" data-toggle="tooltip" title="View Details" data-placement="top" class="custom-btn-sm btn btn-success"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('notice.edit', $notice->id) }}" data-toggle="tooltip" title="Edit Notice" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                            {!! Form::open(['route' => ['notice.destroy', $notice->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
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
                <div class="box-footer">
                    {{ $notices->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection