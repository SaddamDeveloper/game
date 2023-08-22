@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">
    	        <div class="x_title">
    	            <h2>User Information</h2>
    	            <div class="clearfix"></div>
              </div>
    	        <div>
    	            <div class="x_content">
                        <table id="users_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Account No</th>
                              <th>IFSC</th>
                              <th>State</th>
                              <th>City</th>
                              <th>Address</th>
                            </tr>
                          </thead>
                          <tbody> 
                            <tr>
                                <td>{{ $account->id }}</td>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->mobile }}</td>
                                <td>{{ $account->email }}</td>
                                <td>{{ $account->account_no }}</td>
                                <td>{{ $account->ifsc }}</td>
                                <td>{{ $account->state }}</td>
                                <td>{{ $account->city }}</td>
                                <td>{{ $account->address }}</td>
                            </tr>                      
                          </tbody>
                        </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
  </div>
@endsection
