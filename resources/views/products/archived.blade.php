@extends('layouts.header')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title d-flex justify-content-between align-items-center">Product List (Archived)</h4>
            <table class="table table-striped table-hover" id="product_table" width="100%">
                <thead>
                    <tr>
                        <th width="15%">DDW Number</th>
                        <th width="30%">Code</th>
                        <th width="30%">Created By</th>
                        <th width="15%">Date Created</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Region</h5>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    $(document).ready(function(){
        $('#product_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('product.archived') }}"
            },
            columns: [
                {
                    data: 'ddw_number',
                    name: 'ddw_number'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'user_full_name',
                    name: 'user_full_name'
                },
                // {
                //     data: 'product_origin',
                //     name: 'product_origin',
                //     width: '20%'
                // },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        return moment(data).format('YYYY-MM-DD'); // Format as desired
                    }

                },
                {
                    data: 'action',
                    name: 'action',
                    width: '10%',
                    orderable: false
                }
            ],
            columnDefs: [
                {
                    targets: 3, // Target the Title column
                    render: function(data, type, row) {
                        return '<div style="white-space: break-spaces; width: 100%;">' + data + '</div>';
                    }
                }
            ]
        });

        $(document).on('click', '.delete', function(){
            product_id = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('.modal-title').text("Delete Product");
        });    

        $('#yes_button').click(function(){
            $.ajax({
                url: "{{ url('delete_product') }}/" + product_id, 
                method: "GET",
                beforeSend:function(){
                    $('#yes_button').text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#product_table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });
    });
</script>
@endsection