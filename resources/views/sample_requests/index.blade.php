@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between align-items-center">
            Sample Request List
            <button type="button" class="btn btn-md btn-primary" name="add_sample_request" id="add_sample_request">Add Sample Request</button>
            </h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="sample_request_table">
                    <thead>
                        <tr>
                            <th>SRF #</th>
                            <th>Date Requested</th>
                            <th>Date Required</th>
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
        $('#sample_request_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('sample_request.index') }}"
            },
            columns: [
                {
                    data: 'SrfNumber',
                    name: 'SrfNumber'
                },
                {
                    data: 'DateRequested',
                    name: 'DateRequested'
                },
                {
                    data: 'DateRequired',
                    name: 'DateRequired'
                },
                {
                    data: 'ProductType',
                    name: 'ProductType'
                },
                {
                    data: 'ApplicationId',
                    name: 'ApplicationId'
                },
                {
                    data: 'Status',
                    name: 'Status'
                },
                {
                    data: 'Progress',
                    name: 'Progress'
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