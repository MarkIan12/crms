@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between align-items-center">
            Raw Material List
            <button type="button" class="btn btn-md btn-primary" name="add_raw_material" id="add_raw_material">Add Product Application</button>
            </h4>
            <table class="table table-striped table-hover" id="raw_material_table" width="100%">
                <thead>
                    <tr>
                        <th width="30%">Material</th>
                        <th width="30%">Description</th>
                        <th width="30%">Has Price?</th>
                        <th width="10%">Action</th>
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
        $('#raw_material_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('product_subcategories.index') }}"
            },
            columns: [
                {
                    data: 'Name',
                    name: 'Name'
                },
                {
                    data: 'Description',
                    name: 'Description'
                },
                {
                    data: '',
                    name: ''
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ],
            columnDefs: [
                {
                    targets: 1, // Target the column
                    render: function(data, type, row) {
                        return '<div style="white-space: break-spaces; width: 100%;">' + data + '</div>';
                    }
                }
            ]
        });
    });
</script>
@endsection 