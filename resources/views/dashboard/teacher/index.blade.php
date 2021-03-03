@extends('layouts.master')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Teacher List</h3>
            <a href="{{ route('teacher.create') }}" class="btn btn-sm btn-primary float-right">New Teacher</a>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped" id="teacherDatatable">
                <thead>
                    <tr class="bg-custom-color-violate th-color-white">
                        <th>Teacher ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th></th>
                    </tr>
                </thead>
                @if($teachers->isNotEmpty())
                <tbody>
                    @for($i=1;$i<10;$i++)
                    @foreach ($teachers as $key => $teacher)
                        <tr>
                            <td>{{ $teacher->teacher_id }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->teacherAcademic->department->name }}</td>
                            <td>{{ $teacher->teacherAcademic->designation }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->gender }}</td>
                            <td class="inline-element">
                                <a href="{{ route('teacher.show', $teacher->id) }}" data-toggle="tooltip" title="View Details" data-placement="top" class="custom-btn-sm btn btn-success"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('teacher.edit', $teacher->id) }}" data-toggle="tooltip" title="Edit" data-placement="top" class="custom-btn-sm btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['route' => ['teacher.destroy', $teacher->id], 'method' => 'DELETE', 'class'=>'inline-el']) !!}
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
                    if('{{ $teachers->isNotEmpty() ? "true" : "false" }}' == 'true') {
                        if ($('#teacherDatatable').length > 0) {
                            $('#teacherDatatable').DataTable({
                                dom: 'Bfrtip',
                                language: {
                                    searchPlaceholder: "teacher id, name, phone",                                
                                },
                                lengthMenu: [
                                    [10, 25, 50, -1 ],
                                    ['10 rows', '25 rows', '50 rows', 'Show all' ]
                                ],
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
                                ],
                                

                            });

                            $('#teacherDatatable'+'_length').addClass('customDataTableSelect');
                        }
                    }

                });
        
        
            }(jQuery));
        </script>
    @endpush
@endsection