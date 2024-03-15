@extends('layouts.master')
@section('title') {{'Dashboard'}} @endsection
@section('content')
	<div class="page-wrapper">
		<div class="page-content">
			<div class="row mb-3">
				<center>
					<h2>Welcome to {{$settingsAllData->companyName}}</h2>
					<h5>Administrative Panel</h5>
				</center>
			</div>
			<div class="row row-cols-1 row-cols-md-3 row-cols-xl-3">
				@if(\Auth::guard('web')->user()->userType=='admin' || \Auth::guard('web')->user()->userType=='developer')
					<div class="col">
						<div class="card border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h4 class="my-1" style="color: #2E4F6B;">New Order</h4>
									</div>
									<div class="widgets-icons-2 rounded-circle text-white ms-auto" style="width: 80px; height: 80px; background-color: #2E4F6B;">
										<span style="font-size: 14px;">
											`<?php /*{{\DB::table('orders')->where('status', 'ordered')->count('id')}}*/ ?>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h4 class="my-1" style="color: #2E4F6B;">All Products</h4>
									</div>
									<div class="widgets-icons-2 rounded-circle text-white ms-auto" style="width: 80px; height: 80px; background-color: #2E4F6B;">
										<span style="font-size: 14px;">{{\App\Models\Product::count('id');}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card border-start border-0 border-4">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h4 class="my-1" style="color: #2E4F6B;">Total Users</h4>
									</div>
									<div class="widgets-icons-2 rounded-circle text-white ms-auto" style="width: 80px; height: 80px; background-color: #2E4F6B;">
										@php
											$totalUsers	= \App\Models\User::count('id');
											$totalUsers = $totalUsers-1;
										@endphp
										<span style="font-size: 14px;">{{$totalUsers}}</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection