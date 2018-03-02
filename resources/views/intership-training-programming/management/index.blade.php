@extends('layouts.app')

@section('content')

<div class="container" style="padding-top:20px;">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#batches" role="tab" onclick="showScouts()" data-toggle="tab" aria-expanded="true">
                Batch
            </a>
        </li>
        <li role="presentation">
            <a href="#application" role="tab" onclick="showApplications()" data-toggle="tab" aria-expanded="false">
                Applications
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active in" id="batches">
            <div>
                <a href="{{route('get_create_batch')}}" class="ui blue button massive" >Create New Batch</a>
            </div>
            <br />
            <table class="table table-bordered" id="batch-table" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Batch Name</th>
                        <th>Start Date</th>
                        <th>Schedule</th>
                        <th>Registration Deadline</th>
                        <th>Options</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane in" id="application">
            <table class="table table-bordered" id="applications-table" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Batch</th>
                        <th>Application Date</th>
                        <th>Options</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="ui mini modal" id="delete_batch_bttn">
    <div class="header">Delete Batch</div>
    <div class="content">
      <p>Are you sure you want to delete this batch?</p>
    </div>
    <div class="actions">
      <div class="ui negative button">
        No
      </div>
      <div class="ui delete positive right labeled icon button">
        Yes
        <i class="checkmark icon"></i>
      </div>
    </div>
</div>

<div class="ui modal" id="view_applicant_modal">
  <div class="header">
    Profile Picture
  </div>
  <div class="image content">
    <div class="ui medium image">
      <img src="/images/avatar/large/chris.jpg" style="min-height: 200px;" class="avatar">
    </div>
    <div class="description">
      <div class="ui header name">We've auto-chosen a profile image for you.</div>
    <p>
        <b>Objective</b> : 
        <span class="objectives"></span>
    </p>
      <p>
        <b>Course</b> : 
        <span class="course"></span>
    </p>
      <p><b>Objective</b> : <span class="objectives">We've grabbed the following image from the <a href="https://www.gravatar.com" target="_blank">gravatar</a> image associated with your registered e-mail address.</span></p>
      <p><b>School</b> : <span class="school"></span></p>
      <p>
        <b>Batch</b> : 
        <span class="batch"></span>
    </p>
    </div>
  </div>
  <div class="actions">
    <div class="ui black deny button">
      Close
    </div>
    {{-- <div class="ui positive right labeled icon button">
      Yep, that's me
      <i class="checkmark icon"></i>
    </div> --}}
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var table = $('#batch-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('json_get_batches_datatable') !!}',
            columns: [
                { data: 'name', name: 'name'},
                { data: 'start_date', name: 'start_date', },
                { data: 'schedule', name: 'schedule', },
                { data: 'regitration_deadline', name: 'regitration_deadline', },
                {
                    "render": function ( data, type, row ) {
                        return '<a href="{{route('get_create_batch')}}/'+row['id']+'" class="btn btn-primary btn-xs">'
                        +'<i class="fa fa-edit"></i>'
                        +'</a> '
                        +'<a type="button" onclick="prep_del_batch('+row['id']+')" class="btn btn-danger btn-xs">'
                        +'<i class="fa fa-trash"></i>'
                        +'</a>';
                    },
                }
            ],
            order: [[ 1, 'desc' ]]
        });

        $('#delete_batch_bttn .delete').click(function(){
            $.ajax({
                url:"{{route('json_delete_batch')}}",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                type:"POST",
                data:{batch_id:$('#delete_batch_bttn').data('id')},
                success:function(data){
                    table.ajax.reload();
                },
                error:function(){}
            });
        });


        // 
        // 
        // 
        var applicants_table = $('#applications-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('json_get_applicants_datatable') !!}',
            columns: [
                { data: 'applicant_name', name: 'applicant_name'},
                { data: 'training_batch_name', name: 'training_batch_name' },
                { data: 'created_at', name: 'internship_applications.created_at' },
                {
                    "render": function ( data, type, row ) {
                        return '<button class="btn btn-primary view-button btn-xs">'
                        +'<i class="fa fa-eye"></i>'
                        +'</button>';
                    },
                }
            ],
            "createdRow": function ( row, data, index ) {
                $(row).find('.view-button').click(function(){
                    view_applicant(data);
                });
            },
            order: [[ 2, 'desc' ]]
        });
    });

    function view_applicant(data){
        $('#view_applicant_modal').find('.avatar').attr('src',data.photo);
        $('#view_applicant_modal').find('.name').html(data.applicant_name.replace(' ',"") ? data.applicant_name : "Unknown");
        $('#view_applicant_modal').find('.course').html(data.course);
        $('#view_applicant_modal').find('.objectives').html(data.objectives);
        $('#view_applicant_modal').find('.batch').html(data.training_batch_name);
        $('#view_applicant_modal').find('.school').html(data.school);
        $('#view_applicant_modal').modal('show');
    }

    function prep_del_batch(id){
        $('#delete_batch_bttn').modal('show');
        $('#delete_batch_bttn').data('id',id);
    }
</script>

@endsection
