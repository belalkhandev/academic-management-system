@extends('layouts.master')

@section('content')

    <div class="tab-box">
        <div class="tab-box-header">
            <h3 class="tabl-box-header-title">Student Details</h3>
        </div>
        <div class="tab-box-body">
            <div class="tab-box-navigation">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Academic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="guardian-tab" data-toggle="tab" href="#guardian" role="tab" aria-controls="guardian" aria-selected="false">Guardian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="contact" aria-selected="false">Documents</a>
                    </li>
                </ul>
            </div>
            <div class="tab-box-content">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="tab-content-header">Personal Information</h3>
                        <div class="table-content-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="student-photo">
                                        @if($student->photo) 
                                            <img src="{{ asset($student->photo) }}" alt="student photo">
                                            @else 
                                            <img src="{{ asset('assets/images/student.png') }}" alt="student photo" class="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="student-information">
                                        <h3>{{ $student->name }}</h3>
                                        <table class="tab-table student-tab-table">
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ ucfirst($student->gender) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $student->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Birthdate</th>
                                                <td>{{user_formatted_date($student->birthdate) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Category</th>
                                                <td>{{ ucfirst($student->category) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Religion</th>
                                                <td>{{ ucfirst($student->religion) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Blood Group</th>
                                                <td>{{ ucfirst($student->blood_group) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Present Address</th>
                                                <td>{{ $student->present_address }}</td>
                                            </tr>
                                            <tr>
                                                <th>Permanent Address</th>
                                                <tdz>{{ $student->permanent_address }}</tdz>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <h3 class="tab-content-header">Parents Information</h3>
                                <div class="table-content-body">
                                    <table class="tab-table">
                                        <tr>
                                            <th>Father's Name</th>
                                            <td>{{ $student->father_name }}</td>
                                            <td rowspan="3" class="text-center">
                                                @if($student->father_photo) 
                                                    <img src="{{ asset($student->father_photo) }}" alt="Father photo">
                                                    @else 
                                                    <img src="{{ asset('assets/images/father.png') }}" alt="Father photo" class="father_image">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Father's Occupation</th>
                                            <td>{{ $student->father_occupation }}</td>
                                        </tr>
                                        <tr>
                                            <th>Father's Phone</th>
                                            <td>{{ $student->father_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mother's Name</th>
                                            <td>{{ $student->mother_name }}</td>
                                            <td rowspan="3" class="text-center">
                                                @if($student->mother_photo) 
                                                    <img src="{{ asset($student->mother_photo) }}" alt="Mother photo">
                                                    @else 
                                                    <img src="{{ asset('assets/images/mother.png') }}" alt="Mother photo" class="mother_image">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mother's Occupation</th>
                                            <td>{{ $student->mother_occupation }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mother's Phone</th>
                                            <td>{{ $student->mother_phone }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="tab-content-header">CA Information</h3>
                        <div class="table-content-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam ratione ipsum nemo quaerat rerum! Suscipit maiores fugit vel dignissimos deserunt a, explicabo autem facere, voluptatum, vitae porro rem cum nihil quia optio voluptate tempore ea voluptatibus fugiat. Dolor nobis vero nostrum iusto et quis laboriosam quibusdam, illo provident fugiat reprehenderit doloribus facilis similique quas rerum minus molestias! Minus repellat harum, ab consectetur voluptatum saepe consequatur esse animi! Officia, quos quasi facere excepturi tempore, molestiae quidem dolorem mollitia voluptatem impedit, nesciunt dolore magni! Error corrupti sed et pariatur corporis alias accusamus natus quia hic vitae, doloribus iusto perspiciatis tempora nulla itaque!</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <h3 class="tab-content-header">Academic Information</h3>
                        <div class="table-content-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam ratione ipsum nemo quaerat rerum! Suscipit maiores fugit vel dignissimos deserunt a, explicabo autem facere, voluptatum, vitae porro rem cum nihil quia optio voluptate tempore ea voluptatibus fugiat. Dolor nobis vero nostrum iusto et quis laboriosam quibusdam, illo provident fugiat reprehenderit doloribus facilis similique quas rerum minus molestias! Minus repellat harum, ab consectetur voluptatum saepe consequatur esse animi! Officia, quos quasi facere excepturi tempore, molestiae quidem dolorem mollitia voluptatem impedit, nesciunt dolore magni! Error corrupti sed et pariatur corporis alias accusamus natus quia hic vitae, doloribus iusto perspiciatis tempora nulla itaque!</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="guardian" role="tabpanel" aria-labelledby="guardian-tab">
                        <h3 class="tab-content-header">Guardian Information</h3>
                        <div class="table-content-body">
                            <table class="tab-table">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $student->guardian->name }}</td>
                                    <td rowspan="6" class="text-center">
                                        @if($student->guardian->photo)
                                            <img src="{{ asset($student->guardian->photo) }}" alt="Guardian Photo" class="guardian_photo">
                                        @else
                                            <img src="{{ asset('assets/images/guardian.png') }}" alt="Guardian Photo" class="guardian_photo">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Relation with Student</th>
                                    <td>{{ $student->relation }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $student->guardian->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $student->guardian->email }}</td>
                                </tr>
                                <tr>
                                    <th>Occupation</th>
                                    <td>{{ $student->guardian->occupation }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $student->guardian->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-box-footer"></div>
    </div>

@endsection