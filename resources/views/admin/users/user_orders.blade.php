@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>User Orders</h2>
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
                              <th>Payment ID</th>
                              <th>Status</th>
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


 @endsection

@section('script')
     
  <script type="text/javascript">
      $(function () {

        var table = $('#users_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.user_order_ajax') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name',searchable: true},
                {data: 'mobile', name: 'mobile' ,searchable: true},
                {data: 'amount', name: 'amount' ,searchable: true}, 
                {data: 'payment_id', name: 'payment_id' ,searchable: true},
                {data: 'status', name: 'status', render:function(data, type, row){
                    if (row.status == '1') {
                        return "<label class='label label-danger rounded'>FAIL</label>"
                    }else{
                        return "<label class='label label-success rounded'>SUCCESS</label>"
                    }                        
                }},   
            ]
        });
        
    });
  </script>

{{-- <script>
  function export_excel(){
  window.location.href = "{{route('admin.product_list_excel')}}";
}
</script> --}}
    
 @endsection