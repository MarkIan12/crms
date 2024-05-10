@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between align-items-center">
            Customer Complaint List
            <button type="button" class="btn btn-md btn-primary" name="add_customer_complaint" id="add_customer_complaint">Add Customer Complaint</button>
            </h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="customer_complaint_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Contact</th>
                            <th>Title</th>
                            <th>Status</th>
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
        $('#customer_complaint_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('customer_complaint.index') }}"
            },
            columns: [
                {
                    data: 'ServiceNumber',
                    name: 'ServiceNumber'
                },
                {
                    data: 'DateReceived',
                    name: 'DateReceived'
                },
                {
                    data: 'ClientId',
                    name: 'ClientId'
                },
                {
                    data: 'ClientContactId',
                    name: 'ClientContactId'
                },
                {
                    data: 'Title',
                    name: 'Title'
                },
                {
                    data: 'Status',
                    name: 'Status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });
    });
</script>
@endsection