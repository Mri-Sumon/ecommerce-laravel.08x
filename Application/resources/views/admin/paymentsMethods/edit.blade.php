@extends('layouts.master')
@section('title') {{'Edit Payment Methods'}} @endsection
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--topbar start-->
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
		<!--topbar end-->
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
				<a href="{{URL::to('/')}}/paymentsMethods" class="btn btn-sm" tabindex="-1" style="background-color: #2E4F6B; padding: 5px; color: white;">All Payments Methods</a>
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

                        <form action="{{URL::to('/')}}/paymentsMethods/{{$updateData->id}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PATCH')

							<div class="row mb-3">
								<label for="transactionNumber" class="col-sm-3 col-form-label">Transaction Number</label>
								<div class="col-sm-9">
                                    <div class="row">
										<div class="col-6">
											<input id="transactionNumber" type="number" value="{{$updateData->transactionNumber}}" name="transactionNumber" class="form-control" placeholder="Update transaction number">
										</div>
										<div class="col-6">
											<p>Previous Logo</p>
											<img src="{{asset('Application/public/images/paymentMethods/logo'.$updateData->logo)}}" alt="logo"; width="80" height="80" style="padding: 5px;">
											<input id="logo" type="file" value="" name="logo" class="form-control">
										</div>
									</div>
								</div>
							</div>
							
							<div class="row mb-3">
								<label for="operatorName" class="col-sm-3 col-form-label">Operator Name</label>
								<div class="col-sm-9">
									<input id="operatorName" type="text" value="{{$updateData->operatorName}}" name="operatorName" class="form-control" placeholder="Add operator name">
								</div>
							</div>
							
							<div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Status<span style="color: red; font-weight: bold;">*</span></label>
                                <div class="col-sm-9">
									<select class="form-select" id="status" name="status">
										@if($updateData->status=='active')
											<option value="">Select</option>
											<option value="active" selected>Active</option>
											<option value="inactive">Inactive</option>
										@elseif($updateData->status=='inactive')
											<option value="">Select</option>
											<option value="active">Active</option>
											<option value="inactive" selected>Inactive</option>
										@endif
                                    </select>
                                </div>
							</div>

							<div class="row mb-5">
                                <label for="sort" class="col-md-3 col-form-label">Sort</label>
                                <div class="col-md-9">
                                    <input id="sort" type="number" value="{{$updateData->sort}}" name="sort" class="form-control" placeholder="Update Sorting number">
                                </div>
							</div>

							<div class="row mb-5">
                                <label for="" class="col-md-3 col-form-label"></label>
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