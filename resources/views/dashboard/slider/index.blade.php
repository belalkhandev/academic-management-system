@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Sliders</h3>
                    <a href="{{ route('slider.create') }}" class="btn btn-sm btn-primary float-right">Create new</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Slide Photo</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($sliders)
                                @foreach ($sliders as $key => $slider)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img src="{{ asset($slider->slide_photo) }}" alt="" class="slide-img"></td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td class="inline-element">
                                            <a href="{{ route('slider.edit', $slider->id) }}" data-toggle="tooltip" title="Edit slider" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                            {!! Form::open(['route' => ['slider.destroy', $slider->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
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
                    {{-- {{ $notices->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection