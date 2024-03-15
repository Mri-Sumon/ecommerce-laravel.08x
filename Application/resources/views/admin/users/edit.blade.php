@extends('layouts.master')
@section('title') {{'Update'}} @endsection
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
		<div class="row" style="background-color: #2E4F6B; padding: 5px;">
            <style>
                ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }

                li {
                    display: inline;
                }
            </style>
            <ul>
                <li><a href="{{URL::to('/')}}" style="color:white;">Home &nbsp | &nbsp</a></li>
                <li><a href="{{URL::to('/')}}/dashboard" style="color:white;">Dashboard</a></li>
            </ul>
		</div><br>
		<!--end breadcrumb-->
        <style>
            @media only screen and (max-width: 768px){
                .allProduct{ 
                    width: 50%;
                }
                .addNewProducts{
                    width: 50%;
                }
            }
        </style>
        <div class="row">
            <div class="col-6 col-md-6 col-lg-6 allProduct">
                <h6 class="mb-0 text-uppercase" style="padding-top: 7px !important;">@yield('title')</h6>
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end addNewProducts">
				<a href="{{URL::to('/')}}/users" class="btn btn-sm" tabindex="-1" style="background-color: #2E4F6B; padding: 5px; color: white;">All Users</a>
            </div>
        </div>
		<hr/>
        <!-- input field start -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-header px-4 py-3">
						<h5 class="mb-0">Update Data</h5>
					</div>
					<div class="card-body p-4">
                        <div class="form-group row">
                            <div class="col-12 col-md-12 col-lg-12">
                                @if(session('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Well done!</strong> {{session('message')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <form action="{{URL::to('/')}}/users/{{$updateData->id}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PATCH')

							<div class="row mb-3">
								<label for="name" class="col-sm-3 col-form-label">Name</label>
								<div class="col-sm-9">
									<input id="name" type="text" value="{{$updateData->name}}" name="name" class="form-control" placeholder="Name">
								</div>
							</div>

							<div class="row mb-3">
								<label for="email" class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-9">
									<input id="email" type="text" value="{{$updateData->email}}" name="email" class="form-control" placeholder="Email address">
								</div>
							</div>

							<div class="row mb-3">
								<label for="phoneNumber" class="col-sm-3 col-form-label">Phone</label>
								<div class="col-sm-9">
									<input id="phoneNumber" type="number" value="{{$updateData->phoneNumber}}" name="phoneNumber" class="form-control" placeholder="Phone number">
								</div>
							</div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">User Type</label>
                                <div class="col-sm-9">
									<select class="form-select" id="userType" name="userType" required>
										@if($updateData->userType=='developer')
											@if(Auth::user()->id == 1)
												<option>Select</option>
												<option value="developer" selected>Developer</option>
												<option value="admin">Admin</option>
												<option value="user">User</option>
											@endif
										@elseif($updateData->userType=='admin')
											<option>Select</option>
											<option value="developer">Developer</option>
											<option value="admin" selected>Admin</option>
											<option value="user">User</option>
										@elseif($updateData->userType=='user')
											<option>Select</option>
											<option value="developer">Developer</option>
											<option value="user" selected>User</option>
											<option value="admin">Admin</option>
										@else
											<option>Select</option>
											<option value="developer">Developer</option>
											<option value="user">User</option>
											<option value="admin">Admin</option>
										@endif
                                    </select>
                                </div>
							</div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
									<select class="form-select" id="status" name="status" required>
										@if($updateData->status=='active')
											<option>Select</option>
											<option value="active" selected>Active</option>
                                        	<option value="inactive">Inactive</option>
										@elseif($updateData->status=='inactive')
										<option>Select</option>
											<option value="active">Active</option>
                                        	<option value="inactive" selected>Inactive</option>
										@else
											<option value="">Select</option>
											<option value="active">Active</option>
											<option value="inactive">Inactive</option>
										@endif
                                    </select>
                                </div>
							</div>

							<div class="row mb-3">
								<label for="sort" class="col-sm-3 col-form-label">Sort</label>
								<div class="col-sm-9">
									<input id="sort" type="number" value="{{$updateData->sort}}" name="sort" class="form-control" placeholder="Sort">
								</div>
							</div>

                            <div class="row mb-3">
								<label for="password" class="col-sm-3 col-form-label">Password</label>
								<div class="col-sm-9">
									<input id="password" type="password" value="" name="password" class="form-control" placeholder="password">
								</div>
							</div>

							<!-- user permission start -->
							@if(Auth::user()->id == 1)
								@php
                            		$permissionArray=explode(',',$updateData->permissions);
                        		@endphp
								<div class="row mb-3">
                            	    <label for="exampleInputPassword" class="col-sm-3 col-form-label">Give Permissions</label>                                
                            	    <div class="col-sm-9">
										<div class="row">
											<div class="col-md-3">
												<label for="dashboard">
												<input type="checkbox"   @if(in_array("dashbaord", $permissionArray)===true) checked @endif   name="permissions[]" id="dashboard" value="dashbaord">Dashboard</label>
											</div>

											<div class="col-md-3">
												<label for="categories">
												<input type="checkbox"   @if(in_array("categories", $permissionArray)===true) checked @endif    name="permissions[]" id="categories" value="categories">Category</label>
											</div>

											<div class="col-md-3">
												<label for="products">
												<input type="checkbox"   @if(in_array("products", $permissionArray)===true) checked @endif    name="permissions[]" id="products" value="products">Product</label>
											</div>

											<div class="col-md-3">
                            	            	<label for="orders">
												<input type="checkbox"   @if(in_array("orders", $permissionArray)===true) checked @endif    name="permissions[]" id="orders" value="orders">Order</label>
                            	        	</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label for="transactions">
												<input type="checkbox"   @if(in_array("transactions", $permissionArray)===true) checked @endif    name="permissions[]" id="transactions" value="transactions">Transaction</label>
											</div>

											<div class="col-md-3">
												<label for="paymentsMethods">
												<input type="checkbox"   @if(in_array("transactions", $permissionArray)===true) checked @endif    name="permissions[]" id="paymentsMethods" value="paymentsMethods">Payment Methods</label>
											</div>

											<div class="col-md-3">
												<label for="pages">
												<input type="checkbox"    @if(in_array("pages", $permissionArray)===true) checked @endif    name="permissions[]" id="pages" value="pages">Pages</label>
											</div>

											<div class="col-md-3">
												<label for="posts">
												<input type="checkbox"    @if(in_array("posts", $permissionArray)===true) checked @endif    name="permissions[]" id="posts" value="posts">Posts</label>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label for="pos">
												<input type="checkbox"    @if(in_array("pos", $permissionArray)===true) checked @endif    name="permissions[]" id="pos" value="pos">POS</label>
											</div>

											<div class="col-md-3">
												<label for="settings">
												<input type="checkbox"    @if(in_array("settings", $permissionArray)===true) checked @endif   name="permissions[]" id="settings" value="settings">Settings</label>
											</div>

											<div class="col-md-3">
												<label for="users">
												<input type="checkbox"    @if(in_array("users", $permissionArray)===true) checked @endif   name="permissions[]" id="users" value="users">Users</label>
											</div>

										</div>
                            	    </div>
                            	</div>
							@endif
							<!-- user permission end-->

							<div class="row my-5">
                                <label for="number" class="col-md-3 col-form-label"></label> 
                                <div class="col-md-9 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </div>
							</div>
						</form>
					</div> 
				</div>
			</div>
		</div>
        <!-- input field end  -->
    </div>
</div>
@endsection