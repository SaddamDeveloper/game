@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>User Wallet List</h2>
    	            <div class="clearfix"></div>
              </div>
    	        <div>
    	            <div class="x_content">
                        <table id="users_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Amount</th>
                              <th>Total Amount</th>
                              <th>Comment</th>
                            </tr>
                          </thead>
                          <tbody>  
                              @if (isset($wallet_history) && !empty($wallet_history))
                              @php
                                  $count = 1;
                              @endphp
                              @foreach ($wallet_history as $item)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ number_format($item->amount, 2) }}</td>
                                    <td>{{ number_format($item->total, 2) }}</td>
                                    <td>{{$item->comment }}</td>
                                </tr>                    
                              @endforeach
                              @endif 
                          </tbody>
                        </table>
                        {{ $wallet_history->links() }}
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>


 @endsection