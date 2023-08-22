@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-6">
      <div class="x_panel">
            <div>
                @if (Session::has('message'))
                    <div class="alert alert-success" >{{ Session::get('message') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" >{{ Session::get('error') }}</div>
                @endif
            </div>
          <div>
              <div class="x_content">               
                
                {{ Form::open(['method' => 'put','route'=>['admin.user.update', $user]])}}                  
                    <div class="well" style="overflow: auto">
                      <center><h3>Update User</h3></center>
                      <div class="form-row mb-10">
                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                          <div class="form-row">
                              <div class="col-sm-12">
                                <label class="control-label">Name</label>
                                <input type="text"  name="name" value="{{ $user->name }}" class="form-control">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @enderror
                              </div>
                          </div>
                          <div class="form-row">
                              <div class="col-sm-12">
                                  <label class="control-label">Email</label>
                                  <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Enter Email">
                                  @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                      <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div> 
                          <div class="form-row">
                              <div class="col-sm-12">
                                  <label class="control-label">Mobile</label>
                                  <input type="number" name="mobile" value="{{ $user->mobile }}" class="form-control" placeholder="Enter Enter Mobile">
                                  @if($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                      <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div> 
                          <div class="form-row">
                              <div class="col-sm-12">
                                  <label class="control-label">State</label>
                                  <input type="number" name="state" value="{{ $user->state }}" class="form-control" placeholder="Enter Enter State">
                                  @if($errors->has('state'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                      <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div> 
                          <div class="form-row">
                              <div class="col-sm-12">
                                  <label class="control-label">City</label>
                                  <input type="number" name="city" value="{{ $user->city }}" class="form-control" placeholder="Enter Enter City">
                                  @if($errors->has('city'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                      <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div> 
                          <div class="form-row">
                              <div class="col-sm-12">
                                  <label class="control-label">Pin</label>
                                  <input type="number" name="pin" value="{{ $user->pin }}" class="form-control" placeholder="Enter Enter Pin">
                                  @if($errors->has('pin'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                      <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div> 
                          <div class="form-row">
                              <div class="col-sm-12">
                                  <label class="control-label">Address</label>
                                  <textarea name="address" class="form-control" placeholder="Enter Enter Address">{{ $user->address }}</textarea>
                                  @if($errors->has('address'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                      <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                  @enderror
                              </div>
                          </div> 
                        </div>
                      </div>
                    </div>                  
                    <div class="form-group">    	            	
                        {{ Form::submit('Update', array('class'=>'btn btn-success pull-right')) }}  
                    </div>
                {{ Form::close() }}
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection