{{-- modals --}}
<div class="modal fade" id="addExamMark"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Mark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'exam-mark.store']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name </label>
                    <input type="text" name="name" placeholder="Ex: Point" class="form-control">
                    <span class="text-danger"></span>
                </div>
                <div class="note">
                    <p>If you have point system about mark in your institute you can define how many point makes for 1 mark. Otherwise you have to provide input just 1 (one) value for 1 mark.</p>
                </div>
                <div class="form-group">
                    <label for="">Mark </label>
                    <input type="text" name="mark" placeholder="Ex: 30" class="form-control">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Out of</label>
                    <input type="text" name="out_of" placeholder="Ex: 5.00" class="form-control">
                    <span class="text-danger"></span>
                </div>                  
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm" onclick="submit_form(this, event)">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{{-- update exam mark scale --}}
@if($exam_mark)
<div class="modal fade" id="updateExamMark"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Mark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['exam-mark.update', $exam_mark->id]]) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name </label>
                    <input type="text" name="name" placeholder="Ex: Point" class="form-control" value="{{ $exam_mark->name }}">
                    <span class="text-danger"></span>
                </div>
                <div class="note">
                    <p>If you have point system about mark in your institute you can define how many point makes for 1 mark. Otherwise you have to provide input just 1 (one) value for 1 mark.</p>
                </div>
                <div class="form-group">
                    <label for="">Mark </label>
                    <input type="text" name="mark" placeholder="Ex: 30" class="form-control" value="{{ $exam_mark->equal_one }}">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Out of</label>
                    <input type="text" name="out_of" placeholder="Ex: 5.00" class="form-control" value="{{ $exam_mark->out_of }}">
                    <span class="text-danger"></span>
                </div>                  
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm" onclick="submit_form(this, event)">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endif


{{-- exam term modal --}}
<div class="modal fade" id="addExamTerm"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Exam Term</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'exam-term.store']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" placeholder="Enter term name" class="form-control">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="">Total Marks</label>
                    <input type="number" name="marks" placeholder="Enter total marks" class="form-control">
                    <span class="text-danger"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-sm" onclick="submit_form(this, event)">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>