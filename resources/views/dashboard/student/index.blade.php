@extends('layouts.master')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Student List</h3>
            <a href="{{ route('admission.create') }}" class="btn btn-sm btn-primary float-right">New Admission</a>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover table-striped" id="studentDatatable">
                <thead>
                    <tr class="bg-custom-color-violate th-color-white">
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Class</th>
                        <th>Gender</th>
                        <th>Category</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>
                @if($students->isNotEmpty())
                <tbody>
                    @for($i=1;$i<200;$i++)
                    @foreach ($students as $key => $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->father_name }}</td>
                            <td>{{ $student->studentAcademic->first()->academicClass->name }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->category }}</td>
                            <td>{{ $student->phone }}</td>
                            <td class="inline-element">
                                <a href="{{ route('student.show', $student->id) }}" data-toggle="tooltip" title="View Details" data-placement="top" class="custom-btn-sm btn btn-success"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('student.edit', $student->id) }}" data-toggle="tooltip" title="Edit" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['route' => ['student.destroy', $student->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
                                    <button type="submit" class="btn btn-danger custom-btn-sm" onclick="deleteSwal(this, event)" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    @endfor
                </tbody>
                @endif
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
    @push('header-styles')
        <link rel="stylesheet" href="{{ asset('assets/plugins/dataTable/jquery.dataTables.min.css') }}">
    @endpush

    @push('footer-scripts')
        <script src="{{ asset('assets/plugins/dataTable/jquery.dataTables.min.js') }}"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
        <script>
            (function ($) {
                "use-strict"
        
                jQuery(document).ready(function () {

                    //active datpicker
                    if ($('#studentDatatable').length > 0) {
                        $('#studentDatatable').DataTable({
                            dom: 'Bfrtip',
                            language: {
                                searchPlaceholder: "student id, name, phone",                                
                            },
                            lengthMenu: [
                                [10, 25, 50, -1 ],
                                ['10 rows', '25 rows', '50 rows', 'Show all' ]
                            ],
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
                            ],
                            

                        });

                        $('#studentDatatable'+'_length').addClass('customDataTableSelect');
                    }

                });
        
        
            }(jQuery));
        </script>
    @endpush
@endsection