@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between align-items-center">
            Client List (Current)
            <button type="button" class="btn btn-md btn-primary" name="add_client" id="add_client">Add Client</button>
            </h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="client_table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Industry</th>
                            <th>Buyer Code</th>
                            <th>Name</th>
                            <th>Account Manager</th>
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
        $('#client_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('client.index') }}"
            },
            columns: [
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'client_industry',
                    name: 'client_industry'
                },
                {
                    data: 'buyer_code',
                    name: 'buyer_code'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'primary_account_manager',
                    name: 'primary_account_manager'
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
