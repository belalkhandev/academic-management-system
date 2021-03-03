@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Admission list</h3>
                    <a href="{{ route('admission.create') }}" class="btn btn-sm btn-custom-gray float-right">New Admission</a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Group</th>
                                <th>Section</th>
                                <th>Admission Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        @if($admissions)
                        <tbody>
                            @foreach ($admissions as $key => $admission)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $admission->student->student_id }}</td>
                                    <td>{{ $admission->student->name }}</td>
                                    <td>{{ $admission->academicClass->name }}</td>
                                    <td>{{ ($admission->group ? $admission->group->name : '') }}</td>
                                    <td>{{ ($admission->section ? $admission->section->name : '') }}</td>
                                    <td>{{ user_formatted_date($admission->admission_date) }}</td>
                                    <td class="inline-element">
                                        <a href="{{ route('notice.show', $admission->student->id) }}" target="_blank" data-toggle="tooltip" title="View Details" data-placement="top" class="custom-btn-sm btn btn-success"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
                <div class="box-footer">
                    {{ $admissions->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection