@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between align-items-center">
            Project Name List
            <button type="button" class="btn btn-md btn-primary" name="add_project_name" id="add_project_name">Add Nature of Request</button>
            </h4>
            <table class="table table-striped table-hover" id="project_name_table" width="100%">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> 

<script>
    $(document).ready(function(){
        $('#project_name_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('project_name.index') }}"
            },
            columns: [
                {
                    data: 'Name',
                    name: 'Name'
                },
                {
                    data: 'Description',
                    name: 'Description',
                    style: {
                        'word-wrap': 'break-word'
                    }
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
    });
</script>
@endsection