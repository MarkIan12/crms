@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between align-items-center">
            Customer Requirement List
            <button type="button" class="btn btn-md btn-primary" name="add_customer_requirement" id="add_customer_requirement">Add Customer Requirement</button>
            </h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="customer_requirement_table" width="100%">
                    <thead>
                        <tr>
                            <th>CRR #</th>
                            <th>Date Created</th>
                            <th>Due Date</th>
                            <th>Client Name</th>
                            <th>Application</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> 

<script>
    $(document).ready(function(){
        $('#customer_requirement_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('customer_requirement.index') }}"
            },
            columns: [
                {
                    data: 'crr_no',
                    name: 'crr_no'
                },
                {
                    data: 'date_created',
                    name: 'date_created'
                },
                {
                    data: 'due_date',
                    name: 'due_date'
                },
                {
                    data: 'client.Name',
                    name: 'client.Name'
                },
                {
                    data: 'product_application.Name',
                    name: 'product_application.Name'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        return data == 10 ? 'Open' : 'Closed';
                    }
                },
                {
                    data: 'progress',
                    name: 'progress'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ],
            columnDefs: [
                {
                    targets: [0, 1, 2, 3,], // Target the Description column
                    render: function(data, type, row) {
                        return '<div style="white-space: break-spaces; width: 100%;">' + data + '</div>';
                    }
                }
            ]
        });
    });
</script>
@endsection