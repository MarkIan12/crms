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

{{-- May 28 2024 Jun Jihad Barroga Create Modal --}}
<div class="modal fade" id="formCustomerComplaint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Region</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_customer_complaint" enctype="multipart/form-data" action="{{ route('customer_complaint.store') }}">
                    <span id="form_result"></span>
                    @csrf
                    <?php
                    $today = date('Y-m-d');
                    ?>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="DateReceived">Date Received (MM/DD/YYYY):</label>
                        <input type="date" class="form-control" id="DateReceived" name="DateReceived" value="<?php echo $today; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Client:</label>
                        <select class="form-control js-example-basic-single" name="ClientId" id="ClientId" style="position: relative !important" title="Select ClientId" onchange="generateUniqueId()">
                            <option value="" disabled selected>Select Client</option>
                            @foreach ($clients as $client)
                            <option value="{{ $client->id }}" data-type="{{ $client->Type }}">{{ $client->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contact:</label>
                        <select class="form-control js-example-basic-single" name="ClientContactId" id="ClientContactId" style="position: relative !important" title="Select ClientContacId">
                            <option value="" disabled selected>Select Contact</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control js-example-basic-single" name="IssueCategory" id="IssueCategory" style="position: relative !important" title="Select IssueCategory">
                            <option value="" disabled selected>Select Issue Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Severity:</label>
                        <select class="form-control js-example-basic-single" name="Severity" id="Severity" style="position: relative !important" title="Select Severity">
                            <option value="" disabled selected>Select Issue Category</option>
                            <option value="10">Minor</option>
                            <option value="20">Major</option>
                            <option value="30">Critical</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Concerned Department:</label>
                        <select class="form-control js-example-basic-single" name="ConcernedDepratment" id="ConcernedDepratment" style="position: relative !important" title="Select ConcernedDepratment">
                            <option value="" disabled selected>Select Department</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Title">Title</label>
                        <input type="text" class="form-control" id="Title" name="Title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea class="form-control" id="Description" name="Description" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ETC">ETC (MM/DD/YYYY):</label>
                        <input type="date" class="form-control" id="ETC" name="ETC"  placeholder="Enter ETC">
                    </div>
                    <div class="form-group">
                        <label for="UniqueID">Unique ID:</label>
                        <input type="text" class="form-control" id="UniqueID" name="UniqueID" readonly>
                    </div>
                </div>
            </div>
                    <div class="modal-footer">
                        {{-- <input type="hidden" name="action" id="action" value="Save">
                        <input type="hidden" name="hidden_id" id="hidden_id"> --}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit"  class="btn btn-success" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- May 28 2024 Jun Jihad Barroga Create Modal --}}

{{-- Edit Modal --}}
<div class="modal fade" id="formCustomerComplaintEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer Feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_customer_complaint_edit" enctype="multipart/form-data" action="">
                    <span id="form_result"></span>
                    @csrf
                    @method('PUT')
                    <?php
                    $today = date('Y-m-d');
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="DateReceivedEdit">Date Received (MM/DD/YYYY):</label>
                        <input type="date" class="form-control" id="DateReceivedEdit" name="DateReceivedEdit" placeholder="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Client:</label>
                        <select class="form-control js-example-basic-single" name="ClientIdEdit" id="ClientIdEdit" style="position: relative !important" title="Select ClientIdEdit" disabled>
                            <option value="" disabled selected>Select Client</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->Name }}</option>
                            @endforeach
                        </select>
                    </div>   
                    <div class="form-group">
                        <label>Contact:</label>
                        <select class="form-control js-example-basic-single" name="ClientContactIdEdit" id="ClientContactIdEdit" style="position: relative !important" title="Select ClientContacIdEdit">
                            <option value="" disabled selected>Select Contact</option>
                        </select>
                    </div>    
                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control js-example-basic-single" name="IssueCategoryEdit" id="IssueCategoryEdit" style="position: relative !important" title="Select IssueCategoryEdit">
                            <option value="" disabled selected>Select Issue Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Severity:</label>
                        <select class="form-control js-example-basic-single" name="SeverityEdit" id="SeverityEdit" style="position: relative !important" title="Select SeverityEdit">
                            <option value="" disabled selected>Select Issue Category</option>
                            <option value="10">Minor</option>
                            <option value="20">Major</option>
                            <option value="30">Critical</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Concerned Department:</label>
                        <select class="form-control js-example-basic-single" name="ConcernedDepratmentEdit" id="ConcernedDepratmentEdit" style="position: relative !important" title="Select ConcernedDepratmentEdit">
                            <option value="" disabled selected>Select Department</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->Name }}</option>
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-group">
                        <label for="TitleEdit">Title</label>
                        <input type="text" class="form-control" id="TitleEdit" name="TitleEdit" placeholder="Enter Title">
                    </div>    
                    <div class="form-group">
                        <label for="DescriptionEdit">Description</label>
                        <textarea class="form-control" id="DescriptionEdit" name="DescriptionEdit" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ETCEdit">ETC (MM/DD/YYYY):</label>
                        <input type="date" class="form-control" id="ETCEdit" name="ETCEdit"  placeholder="Enter ETC">
                    </div>
                    </div> 
                </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Edit Modal --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> 

<script>
// May 29 2024 Jun Jihad Barroga Generate ServiceNumber 
    function generateUniqueId() {
        const clientSelect = document.getElementById('ClientId');
        const clientId = clientSelect.value;
        const clientType = clientSelect.options[clientSelect.selectedIndex].getAttribute('data-type');
        const dateReceived = document.getElementById('DateReceived').value;
        const year = new Date(dateReceived).getFullYear().toString().slice(-2);
        let clientCode = clientType == 1 ? 'LS' : 'IS';

        fetch(`get-last-increment/${year}/${clientCode}`)
            .then(response => response.json())
            .then(data => {
                const lastIncrement = data.lastIncrement;
                const increment = ('000' + (parseInt(lastIncrement) + 1)).slice(-4);
                const uniqueId = `CPL-${clientCode}-${year}-${increment}`;
                document.getElementById('UniqueID').value = uniqueId;
            });
    }

    document.getElementById('DateReceived').addEventListener('change', generateUniqueId);
    // May 29 2024 Jun Jihad Barroga Generate ServiceNumber 

    // May 28 2024 Jun Jihad Barroga Contact is Dependednt To CLient Function 
    $(document).ready(function() {
        $('#ClientId').on('change', function() {
            var clientId = $(this).val();
            if(clientId) {
                $.ajax({
                    url: '{{ url("contacts-by-client") }}/' + clientId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#ClientContactId').empty();
                        $('#ClientContactId').append('<option value="" disabled selected>Select Contact</option>');
                        $.each(data, function(key, value) {
                            $('#ClientContactId').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('#ClientContactId').empty();
            }
        });
    });

    // May 28 2024 Jun Jihad Barroga Contact is Dependednt To CLient Function 

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
                    data: 'client.Name',
                    name: 'client.Name'
                },
                {
                    data: 'contacts.ContactName',
                    name: 'contacts.ContactName'
                },
                {
                    data: 'Title',
                    name: 'Title'
                },
                {
                    data: 'Status',
                    name: 'Status',
                    render: function(data, status, row) {
                        // Display "Local" for type 1 and "International" for type 2
                        return data == 10 ? 'Open' : 'Closed';
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });
        $('#customer_complaint_table').on('click', '.edit', function() {
        var id = $(this).attr('id');
        console.log(id)
        editCustomerComplaint(id);
    });
    });

    // May 28 2024 Jun Jihad Barroga SHow Modal For Create 
    $('#add_customer_complaint').click(function(){
            $('#formCustomerComplaint').modal('show');
            $('.modal-title').text("Add Customer Complaint");
        });
    // May 28 2024 Jun Jihad Barroga SHow Modal For Create 

    function editCustomerComplaint(id) {
    $.ajax({
        url: "{{ url('customer_complaint') }}/" + id + "/edit",
        type: "GET",
        dataType: "json",
        success: function(data) {
            $('#formCustomerComplaintEdit').modal('show');
            $('.modal-title').text("Edit Customer Feedback");
            $('#DateReceivedEdit').val(data.DateReceived);
            $('#ClientIdEdit').val(data.ClientId).trigger('change'); 
            $('#IssueCategoryEdit').val(data.IssueCategoryId).trigger('change'); 
            $('#SeverityEdit').val(data.Severity).trigger('change'); 
            $('#ConcernedDepratmentEdit').val(data.ConcernedDepartmentId).trigger('change'); 
            $('#TitleEdit').val(data.Title);
            $('#DescriptionEdit').val(data.Description);
            $('#ETCEdit').val(data.Etc);
            var clientId = data.ClientId;
            $.ajax({
                url: "{{ url('contacts-by-client') }}/" + clientId,
                type: "GET",
                dataType: "json",
                success:function(contactData) {
                    $('#ClientContactIdEdit').empty();
                    $('#ClientContactIdEdit').append('<option value="" disabled selected>Select Contact</option>');
                    $.each(contactData, function(key, value) {
                        $('#ClientContactIdEdit').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                    $('#ClientContactIdEdit').val(data.ClientContactId);
                }
            });
            $('#form_customer_complaint_edit').attr('action', "{{ url('customer_complaint') }}/" + id);
        }
    });
}
</script>
@endsection