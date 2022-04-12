@extends('layouts.main')
@section('content')
<div class="container-fluid"><h3 class="text-dark mb-4">Profile</h3>
@include('layouts.flash-messages')
    <div class="row mb-3"><div class="col-lg-4">
    <div class="card mb-3">
        <div class="card-body text-center shadow">
            <img class="rounded-circle mt-4" src="{{$user->avatar()}}" width="160" height="160" />
            
            <div class="d-flex flex-column align-items-center mb-4">
                <h4 class="text-primary fw-bold mb-0 mt-2">{{ $user->first_name }} {{ $user->last_name }}</h4>
                <h6 class="p-0"><small>{{ auth()->user()->department ? $departments[auth()->user()->department] : '' }}</small></h6>
                <form method="post" id="form-avatar" enctype="multipart/form-data" action="{{ route('admin.profile.avatar.upload', $user->employee_id) }}"> 
                {{ csrf_field() }} 
                
                <div class="btn btn-sm btn-outline-primary position-relative overflow-hidden">
                    Change Avatar
                    <input type="file" name="avatar" id="upload-avatar" class="form-control form-control-sm position-absolute opacity-0 top-0 end-0"
                            accept="image/jpeg,image/png" required/>
                </div>

                </form>
            </div>
        </div>
    </div>
    <div class="card shadow mb-3">
    <div class="card-header py-3">
        <p class="text-primary m-0 fw-bold">Upload Requirements</p>
    </div>

    <div class="card-body">
        <form method="post" id="form-requirement" enctype="multipart/form-data" action="{{ route('admin.requirement.store', $user->employee_id) }}"> 
        {{ csrf_field() }} 
            <div class="d-flex align-items-baseline justify-content-between input-group">
                <label class="form-label py-3" for="requirements">Select requirement: </label>
                {{
                    Form::select('requirement_type',array(
                        'photo_id'      => 'Photo ID',
                        'school_id'     => 'School ID',
                        'workspace'     => 'Workspace / Work Desk',
                        'net_speed'     => 'Internet Speed',
                        'pc_specs'      => 'Computer / Laptop Specifications',
                        'consent'       => "Signed Parent's Consent",
                        'consent_id'    => "Signed Parent's Consent Valid ID",
                        'endorsement'   => 'Endorsement Letter from School',
                        'moa'           => 'MOA / MOU'
                        ),
                        null,['class' => 'form-select form-select-sm mx-3 rounded-1','id'=>'requirement_type','required'])
                }}
                <div class="btn btn-sm btn-outline-primary position-relative overflow-hidden rounded-1">
                <small><i class="fas fa-paperclip"></i></small>
                    Attach
                    <!-- accept image and pdf only-->
                    <input type="file" id="upload-requirement" name="requirement" class="form-control form-control-sm position-absolute opacity-0 top-0 end-0"
                            accept="image/jpeg,image/gif,image/png,application/pdf" required/>
                </div>
            </div>
        </form>
    </div>
</div>
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">View Requirements</p>
            </div>
            
            <form method="post" id="form_delete" action="{{ route('admin.requirement.destroy',$user->employee_id) }}">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="d-flex align-items-baseline justify-content-between input-group">
                            <label class="form-label py-3" for="requirements">Select requirement: </label>
                            {{
                                Form::select('view_type',array(
                                    'photo_id'      => 'Photo ID',
                                    'school_id'     => 'School ID',
                                    'workspace'     => 'Workspace / Work Desk',
                                    'net_speed'     => 'Internet Speed',
                                    'pc_specs'      => 'Computer / Laptop Specifications',
                                    'consent'       => "Signed Parent's Consent",
                                    'consent_id'    => "Signed Parent's Consent Valid ID",
                                    'endorsement'   => 'Endorsement Letter from School',
                                    'moa'           => 'MOA / MOU'
                                    ),

                                    $user->employee_status,['class' => 'form-select form-select-sm mx-3 rounded-1','id'=>'view_type','required'])
                                }}
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-primary btn-sm rounded-1" data-toggle="modal" data-target="#exampleModal">
                            <small><i class="far fa-eye"></i> </small>View
                            </button>
                    </div>
            </form>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <span aria-hidden="true"></span>
                        
                        <button type="button" class= "close" data-dismiss="modal" aria-label="Close">&times;</button>
                        
                    </div>
                    <div class="modal-body text-center">
                        <div id="photo_id">
                            <img class="mw-100" src="{{$user->viewRequirement($user->employee_id,'photo_id')}}" />
                        </div>
                        <div id="school_id">
                            <img class="mw-100" src="{{$user->viewRequirement($user->employee_id,'school_id')}}" />
                        </div>
                        <div id="workspace">
                            <img class="mw-100" src="{{$user->viewRequirement($user->employee_id,'workspace')}}" />
                        </div>
                        <div id="net_speed">
                            <img class="mw-100" src="{{$user->viewRequirement($user->employee_id,'net_speed')}}" />
                        </div>
                        <div id="pc_specs">
                            <img class="mw-100" src="{{$user->viewRequirement($user->employee_id,'pc_specs')}}" />
                        </div>
                        <div id="consent">
                            <iframe loading="lazy" style="width:100%;min-height:80vh;" frameborder="0" src="{{$user->viewRequirement($user->employee_id,'consent')}}"></iframe>
                        </div>
                        <div id="consent_id">
                            <iframe loading="lazy" style="width:100%;min-height:80vh;" frameborder="0" src="{{$user->viewRequirement($user->employee_id,'consent_id')}}"></iframe>
                        </div>
                        <div id="endorsement">
                            <iframe loading="lazy" style="width:100%;min-height:80vh;" frameborder="0" src="{{$user->viewRequirement($user->employee_id,'endorsement')}}"></iframe>
                        </div>
                        <div id="moa">
                            <iframe loading="lazy" style="width:100%;min-height:80vh;" frameborder="0" src="{{$user->viewRequirement($user->employee_id,'moa')}}"></iframe>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_delete" class="btn btn-outline-danger btn-sm rounded-1">
                            <small><i class="far fa-trash-alt"></i> </small>Delete
                        </button>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div> 

        <div class="card shadow mb-3">
            {{ Form::model($user,['route' => ['admin.profile.comment.save',$user->employee_id]]) }}
            {{ csrf_field() }}
            <div class="card-header py-3 d-flex align-items-baseline justify-content-between">
                <p class="text-primary m-0 fw-bold">Feedback</p>
                <button class="btn btn-outline-primary btn-sm"><small><i class="far fa-comment"></i></small> Post</button>
            </div>
            
            <div class="card-body pb-4">
                <div class="d-flex align-items-baseline justify-content-between">
                    {{ Form::textarea('comment',null,['class'=>'form-control form-control-sm','id'=>'comment','rows'=>'4']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div> 
    </div>
<div class="col-lg-8">
    <div class="row">
        <div class="col">
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">User Settings</p>
                </div>
                <div class="card-body">
                    {{ Form::model($user,['route' => ['admin.profile.update',$user->employee_id],'id'=>'frm_profile']) }}
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="employee_id"><strong>Employee ID</strong></label>
                                {{ Form::text('employee_id',null,['class'=>'form-control','id'=>'employee_id','readonly']) }}
                            </div>
                            <div class="col">
                                <label class="form-label" for="email"><strong>Account Email</strong></label>
                                {{ Form::email('email',null,['class'=>'form-control','id'=>'email','readonly']) }}
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="employee_status"><strong>Employee Status</strong></label>
                                {{
                                    Form::select('type_id',array(
                                    'Active' => 'Active',
                                    'Resigned' => 'Resigned',
                                    'Terminated' => 'Terminated',
                                    'Completed' => 'Completed'
                                    ),
                                    $user->employee_status,['class' => 'form-select','id'=>'type_id','required'])
                                }}
                            </div>
                            <div class="col">
                                <label class="form-label" for="employee_type"><strong>Employee Type</strong></label>
                                {{ Form::select('employee_type',$employee_types,$user->employee_type,['class'=>'form-select','id'=>'employee_id','required']) }}
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="first_name"><strong>First Name</strong></label>
                                {{ Form::text('first_name',null,['class'=>'form-control','id'=>'first_name','required']) }}
                            </div>
                            <div class="col">
                                <label class="form-label" for="last_name"><strong>Last Name</strong></label>
                                {{ Form::text('last_name',null,['class'=>'form-control','id'=>'last_name','required']) }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="email_personal"><strong>Personal Email</strong></label>
                                {{ Form::email('email_personal',null,['class'=>'form-control','id'=>'email_personal','required']) }}
                            </div>
                            <div class="col">
                                <label class="form-label" for="contact"><strong>Contact Number</strong></label>
                                {{ Form::text('contact',null,['class'=>'form-control','id'=>'contact','required']) }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="department"><strong>Department</strong></label>
                                {{ Form::select('department',$departments,$user->department,['class'=>'form-select','id'=>'department','required']) }}
                            </div>
                            <div class="col">
                            <label class="form-label" for="quota_hours"><strong>Quota Hours</strong></label>
                                {{ Form::number('quota_hours',null,['class'=>'form-control','id'=>'quota_hours','required']) }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="school"><strong>School Name</strong></label>
                                {{ Form::text('school',null,['class'=>'form-control','id'=>'school','required']) }}
                            </div>
                            <div class="col">
                                <label class="form-label" for="course"><strong>Course Name</strong></label>
                                {{ Form::text('course',null,['class'=>'form-control','id'=>'course','required']) }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="coordinator"><strong>OJT Coordinator Name</strong></label>
                                {{ Form::text('coordinator',null,['class'=>'form-control','id'=>'coordinator','required']) }}
                            </div>
                            <div class="col">
                                <label class="form-label" for="coordinator_email"><strong>OJT Coordinator Email Address</strong></label>
                                {{ Form::text('coordinator_email',null,['class'=>'form-control','id'=>'coordinator_email','required']) }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="orientation_day"><strong>Date of Orientation</strong></label>
                                {{ Form::date('orientation_day',null,['class'=>'form-control date','id'=>'orientation_day','required']) }}
                            </div>
                            <div class="col">
                                <label class="form-label" for="first_day"><strong>First Day</strong></label>
                                {{ Form::date('first_day',null,['class'=>'form-control date','id'=>'first_day','required']) }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="last_day"><strong>Last Day</strong></label>
                                {{ Form::date('last_day',null,['class'=>'form-control date','id'=>'last_day','required']) }}
                            </div>
                            <div class="col">
                                <label class="form-label" for="exit_day"><strong>Exit Day</strong></label>
                                {{ Form::date('exit_day',null,['class'=>'form-control date','id'=>'exit_day','required']) }}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    
$( document ).ready(function() {
    $('.modal-body > div').hide();
    $('#view_type').prop('selectedIndex',0);
    $('#exampleModalLabel').html($('#view_type :selected').text());
    $('#' + $('#view_type').val()).show();

    $('#view_type').on('change', function() {
        // Hide all documents
        $('.modal-body > div').hide();

        $('#exampleModalLabel').html($('#view_type :selected').text());

        // Show selected document
        $('#' + $('#view_type').val()).show();

    });

    $('#upload-avatar').on('change', function(){
        $('#form-avatar').submit();
    });

    
    $('#upload-requirement').on('change', function(){
        $('#form-requirement').submit();
    });

    $('#btn_delete').click(function(){
        $('#form_delete').submit();
    });

});


    

</script>

@endsection