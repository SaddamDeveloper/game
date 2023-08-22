@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">
    	        <div class="x_title">
    	            <h2>Running Game</h2>
    	            <div class="clearfix"></div>
              </div>
    	        <div>
    	            <div class="x_content">
                        <table id="game_data" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Period</th>
                              <th>Number</th>
                              <th>Color</th>
                              <th>Ending Number</th>
                              <th>Timer</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>        
                            <tr>
                                <td id="period"></td>
                                <td id="number"></td>
                                <td id="color" style="text-align: center; position: relative;"></td>
                                <td id="ending"></td>
                                <td id="timer"></td>
                                <td><button class="btn btn-primary" id="action" data-toggle="modal" data-target="#myModal">Action</button></td>
                            </tr>               
                          </tbody>
                        </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Running Game</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    Number result
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" placeholder="Enter" name="number_result" id="number_result">
                    <span id="num_err"></span>
                </div>
                <div class="col-md-4">
                    <span>Total Amount : <b id="number_amt"></b></span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    Color result
                </div>
                <div class="col-md-4">
                   <select name="color_result" id="color_result" class="form-control">
                       <option value="">Please Select Color</option>
                       <option value="116">RED</option>
                       <option value="117">GREEN</option>
                       <option value="118">BLUE</option>
                       <option value="119">VIOLET</option>
                       <option value="120">YELLOW</option>
                       <option value="121">PINK</option>
                       <option value="122">BROWN</option>
                       <option value="123">GRAY</option>
                       <option value="124">AQUA</option>
                       <option value="125">ORANGE</option>
                   </select>
                   <span id="col_err"></span>
                </div>
                <div class="col-md-4">
                    <span>Total Amount  : <b id="color_amt"></b></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Ending result
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" placeholder="Enter" name="number_result" id="ending_result">
                    <span id="end_err"></span>
                </div>
                <div class="col-md-4">
                    <span>Total Amount  : <b id="ending_amt"></b></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" id="submitForm">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
  </div>
@endsection

@section('script')
     
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:"GET",
            url:"{{route('admin.get_game')}}",
            success:function(response){
               if(response){
                $('#period').html(response.data.id);
                $('#number').html(response.data.number);
                $('#color').html(response.data.color);
                $('#ending').html(response.data.ending);
                if (response.data.timer > 0) {
                    timerStart(response.data.timer);                    
                }else{
                    $('#action').hide();
                }
               }else{
                   alert('something went wrong!');
               }
            }
        });
    });
    function timerStart(timer){
        var time = timer;
        var intervalId = setInterval(function(){
            // console.log(time++);
            var time_data = time--;
            if (time_data <= 60) {
                $('#action').hide();
                if (time_data > 0) {
                    if (time_data.toString().length == '1') {
                        time_data = "0"+time_data;
                    }
                    $('#timer').html(toHHMMSS(time_data));
                } else {                        
                    clearInterval(intervalId);
                }
            }else{
                // console.log(time_data.toString().length);
                if (time_data.toString().length == '1') {
                    time_data = "0"+time_data;
                }
                $('#timer').html(toHHMMSS(time_data));
            }
        }, 1000);
    };
    function toHHMMSS (time_data) {
        var sec_num = parseInt(time_data, 10); // don't forget the second param
        var hours   = Math.floor(sec_num / 3600);
        var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
        var seconds = sec_num - (hours * 3600) - (minutes * 60);

        // if (hours   < 10) {hours   = "0"+hours;}
        if (minutes < 10) {minutes = "0"+minutes;}
        if (seconds < 10) {seconds = "0"+seconds;}
        return minutes+':'+seconds;
    }
    
    $(function(){
        $("#number_result").blur(function(){
            var num_val = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:'{{url("admin/game/get/win/amount/")}}/'+2+'/'+num_val,
                success:function(response){
                    console.log(response);
                    if(response){
                       $("#number_amt").html(response);
                    }else{
                        alert('something went wrong!');
                    }
                }
            });
        });

        $("#color_result").change(function(){
            var num_val = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:'{{url("admin/game/get/win/amount/")}}/'+1+'/'+num_val,
                success:function(response){
                    console.log(response);
                    if(response){
                       $("#color_amt").html(response);
                    }else{
                        alert('something went wrong!');
                    }
                }
            });
        });

        $("#ending_result").blur(function(){
            var num_val = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:'{{url("admin/game/get/win/amount/")}}/'+3+'/'+num_val,
                success:function(response){
                    console.log(response);
                    if(response){
                       $("#ending_amt").html(response);
                    }else{
                        alert('something went wrong!');
                    }
                }
            });
        });

        $("#submitForm").click(function(){
            var num_val = $("#number_result").val();
            var col_val = $("#color_result").val();
            var end_val = $("#ending_result").val();
            if (num_val) {
                if (col_val) {
                    if (end_val) {
                        $("#end_err").html("");
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type:"POST",
                            url:'{{route("admin.result_insert")}}',
                            data : {
                                number:num_val,
                                color:col_val,
                                ending:end_val
                            },
                            success:function(response){
                                if(response == 1){
                                    alert('Successfull');
                                    $('#myModal').toggle();
                                }else{
                                    alert('something went wrong!');
                                }
                            }
                        });



                    } else {
                        $("#end_err").html("<p style='color:red'>This Field Is Required</p>");
                    }                    
                    $("#col_err").html("");
                } else {
                 $("#col_err").html("<p style='color:red'>This Field Is Required</p>");
                }
                $("#num_err").html("");
            }else{
                $("#num_err").html("<p style='color:red'>This Field Is Required</p>");
            }
        });
    });

</script>
 @endsection