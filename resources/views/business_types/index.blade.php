@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between align-items-center">
            Business Type List
            <button type="button" class="btn btn-md btn-primary" name="add_business_type" id="add_business_type">Add Business Type</button>
            </h4>
            <table class="table table-striped table-hover" id="business_type_table" width="100%">
                <thead>
                    <tr>
                        <th width="35%">Name</th>
                        <th width="40%">Description</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="formBusinessType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Region</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_business_type" enctype="multipart/form-data" action="{{ route('business_type.store') }}">
                    <span id="form_result"></span>
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="Name" name="Name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <input type="text" class="form-control" id="Description" name="Description" placeholder="Enter Description">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" value="Save">
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Business Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 20px">
                <h5 style="margin: 0">Are you sure you want to delete this data?</h5>
            </div>
            <div class="modal-footer" style="padding: 0.6875rem">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="yes_button" id="yes_button" class="btn btn-danger">Yes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> 

<script>
    $(document).ready(function(){
        $('#business_type_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('business_type.index') }}"
            },
            columns: [
                {
                    data: 'Name',
                    name: 'Name'
                },
                {
                    data: 'Description',
                    name: 'Description',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ],
            columnDefs: [
                {
                    targets: 1, // Target the Description column
                    render: function(data, type, row) {
                        return '<div style="white-space: break-spaces; width: 100%;">' + data + '</div>';
                    }
                }
            ]
        });

        $('#add_business_type').click(function(){
            $('#formBusinessType').modal('show');
            $('.modal-title').text("Add New Business Type");
        });

        $('#form_business_type').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == 'Save')
            {
                $.ajax({
                    url: "{{ route('business_type.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#form_business_type')[0].reset();
                            setTimeout(function(){
                                $('#formBusinessType').modal('hide');
                            }, 2000);
                            $('#company_table').DataTable().ajax.reload();
                            setTimeout(function(){
                                $('#form_result').empty(); 
                            }, 2000); 
                        }
                        $('#form_result').html(html);
                    }
                })
            }

            if($('#action').val() == 'Edit')
            {
                var formData = new FormData(this);
                formData.append('Id', $('#hidden_id').val());
                $.ajax({
                    url: "{{ route('update_business_type', ':Id') }}".replace(':Id', $('#hidden_id').val()),
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('#form_business_type')[0].reset();
                            setTimeout(function(){
                                $('#formBusinessType').modal('hide');
                            }, 2000);
                            $('#business_type_table').DataTable().ajax.reload();
                            setTimeout(function(){
                                $('#form_result').empty(); 
                            }, 2000); 
                        }
                        $('#form_result').html(html);
                    }
                });
            }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('Id');
            $('#form_result').html('');
            $.ajax({
                url: "{{ route('edit_business_type', ['Id' => '_id_']) }}".replace('_id_', id),
                dataType: "json",
                success: function(html){
                    $('#Name').val(html.data.Name);
                    $('#Description').val(html.data.Description);
                    $('#hidden_id').val(html.data.Id);
                    $('.modal-title').text("Edit Business Type");
                    $('#action_button').val("Update");
                    $('#action').val("Edit");
                    $('#formBusinessType').modal('show');
                }
            });
        });

        var business_type_id;
        $(document).on('click', '.delete', function(){
            business_type_id = $(this).attr('Id');
            $('#confirmModal').modal('show');
            $('.modal-title').text("Delete Business Type");
        }); 

        $('#yes_button').click(function(){
            $.ajax({
                url: "{{ url('delete_business_type') }}/" + business_type_id, 
                method: "GET",
                beforeSend:function(){
                    $('#yes_button').text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#business_type_table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });
    });
</script>
@endsection