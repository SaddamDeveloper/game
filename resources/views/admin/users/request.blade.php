@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">
    	        <div class="x_title">
    	            <h2>Payment Request</h2>
    	            <div class="clearfix"></div>
              </div>
    	        <div>
    	            <div class="x_content">
                        <table id="users_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Amount</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>                       
                          </tbody>
                        </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
  </div>
  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" class="row" id="form-submit">
        <input type="hidden" name="wdrId" id="wdrId">
        <input type="hidden" name="status" id="status">
        <div class="modal-body">
          <table class="table">
            <tr>
              <th>Wallet Balance</th>
              <th>Request Amount</th>
              <th>Comment</th>
            </tr>
            <td id="wallet_balance"></td>
            <td id="request_amount"></td>
            <td><input type="text" class="form-control" name="comment" placeholder="Enter Comment"></td>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
  <script type="text/javascript">
      $(function () {

        var table = $('#users_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.payment.request.ajax') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name',searchable: true},
                {data: 'mobile', name: 'mobile' ,searchable: true},
                {data: 'amount', name: 'amount' ,searchable: true}, 
                {data: 'created_at', name: 'created_at' ,searchable: true}, 
                {data: 'action', name: 'action' ,orderable: false},
            ]
        });
        $(document).on('click', '#btn-approve',function(e){
          e.preventDefault();
          $('#exampleModal').modal('show');
          var title = $(this).data('title');
          var wdrId = $(this).data('wdr-id');
          var status = $(this).data('status-id');
          var request_amount = $(this).data('request-amount');
          var wallet_balance = $(this).data('wallet_balance');
          $('#wdrId').val(wdrId);
          $('#status').val(status);
          $('#exampleModalLabel').html(title);
          $('#wallet_balance').html(wallet_balance);
          $('#request_amount').html(request_amount);
        });
        $(document).on('submit', '#form-submit',function(e){
          e.preventDefault();
          var data = $(this).serializeArray();
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
                url: "{{route('admin.ajax.request.update')}}",
                method: "POST",
                data: data,
                success: function(response){
                    if(response.msg == 1){
                        alert("Approved Successfully!");
                        $("#btn-grp").html('<button id="btn-approve" class="btn btn-primary" disabled>Approved</button>')
                        $('#exampleModal').modal('hide');
                    }else if(response.msg == 2){
                        alert("Oops! Rejected");
                        $("#btn-grp").html('<button id="btn-approve" class="btn btn-danger" disabled>Rejected</button>')
                        $('#exampleModal').modal('hide');
                    }else{
                        alert("Something went wrong");
                    }
                }
            });
        });
    });
  </script>
 @endsection