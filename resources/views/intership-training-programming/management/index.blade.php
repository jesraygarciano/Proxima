@extends('layouts.app')

@section('content')

<div class="container" style="padding-top:20px;">
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
    });

    function prep_del_batch(id){
        $('#delete_batch_bttn').modal('show');
        $('#delete_batch_bttn').data('id',id);
    }
</script>

@endsection
