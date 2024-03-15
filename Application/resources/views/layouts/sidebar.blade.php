<div class="sidebar-wrapper" data-simplebar="true" style="background-color: #2E4F6B;">
	<div class="sidebar-header" style="background-color: #2E4F6B;">
		<div>
			<a href="{{URL::to('/')}}" class="logo-text" style="color: white;">
				@if($settingsAllData->headerFooterLogo != "headerFooterLogo")
					<img src="{{asset('Application/public/images/settings/headerFooterLogoName'.$settingsAllData->headerFooterLogo)}}" height="45" width="180" alt="Logo">
				@endif	
			</a>
		</div>
		<div class="toggle-icon ms-auto" style="color: white;"><i class="fa fa-bars"></i></div>
	 </div>

	<!--navigation-->
	<ul class="metismenu" id="menu" style="background-color: #2E4F6B;">

	@if(Auth::check())
		@php 
			$permissionArray=explode(',',Auth::user()->permissions);
		@endphp
		@if(in_array("dashbaord", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a href="{{URL::to('/')}}/dashboard" @if(request()->segment(1)=='dashbaord') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-home-alt'></i></div>
					<div class="menu-title" style="color: white;">Dashboard</div>
				</a>
			</li>
		@endif
		@if(in_array("categories", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a class="has-arrow" href="javascript:;" style="color: white;" @if(request()->segment(1)=='categories') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-category'></i></div>
					<div class="menu-title" style="color: white;">Categories</div>
				</a>
				<ul style="background-color: #2E4F6B;">
					<li> <a href="{{URL::to('/')}}/categories" style="color: white;"><i class='bx bx-radio-circle'></i>All Categories</a></li>
					<li> <a href="{{URL::to('/')}}/categories/create" style="color: white;"><i class='bx bx-radio-circle'></i>Add New Categories</a>
					</li>
				</ul>
			</li>
		@endif
		@if(in_array("products", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a href="javascript:;" class="has-arrow" style="background-color: #2E4F6B; color: white;" @if(request()->segment(1)=='products') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-cart'></i></div>
					<div class="menu-title" style="color: white;">Products</div>
				</a>
				<ul style="background-color: #2E4F6B;">
					<li> <a href="{{URL::to('/')}}/products" style="color: white;"><i class='bx bx-radio-circle'></i>All Products</a></li>
					<li> <a href="{{URL::to('/')}}/products/create" style="color: white;"><i class='bx bx-radio-circle'></i>Add New Products</a></li>
				</ul>
			</li>
		@endif
		@if(in_array("orders", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a href="{{URL::to('/')}}/orders" @if(request()->segment(1)=='orders') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-down-arrow-circle'></i></div>
					<div class="menu-title" style="color: white;">Orders</div>
				</a>
			</li>
		@endif
		@if(in_array("transactions", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a href="{{URL::to('/')}}/transactions" @if(request()->segment(1)=='transactions') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-money'></i></div>
					<div class="menu-title" style="color: white;">Transactions</div>
				</a>
			</li>
		@endif
		@if(in_array("paymentsMethods", $permissionArray)===true)
			<li style="background-color: #2E4F6B; color: white;">
				<a class="has-arrow" href="javascript:;" style="background-color: #2E4F6B; color: white;" @if(request()->segment(1)=='paymentsMethods') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-money'></i></div> 
					<div class="menu-title" style="color: white;">Payment Methods</div>
				</a>
				<ul style="background-color: #2E4F6B;">
					<li> <a href="{{URL::to('/')}}/paymentsMethods" style="color: white;"><i class='bx bx-radio-circle'></i>All Payment Methods</a></li>
					<li> <a href="{{URL::to('/')}}/paymentsMethods/create" style="color: white;"><i class='bx bx-radio-circle'></i>Add Payment Methods</a></li>
				</ul>
			</li>
		@endif
		@if(in_array("pages", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a class="has-arrow" href="javascript:;" style="background-color: #2E4F6B; color: white;" @if(request()->segment(1)=='pages') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-file-blank'></i></div>
					<div class="menu-title" style="color: white;">Pages</div>
				</a>
				<ul style="background-color: #2E4F6B;">
					<li> <a href="{{URL::to('/')}}/pages" style="color: white;"><i class='bx bx-radio-circle'></i>All pages</a></li>
					<li> 
						@if(Auth::user()->id == 1) 
							<a href="{{URL::to('/')}}/pages/create" style="color: white;"><i class='bx bx-radio-circle'></i>Add New Pages</a>
						@endif	
					</li>
				</ul>
			</li>
		@endif
		@if(in_array("posts", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a class="has-arrow" href="javascript:;" style="background-color: #2E4F6B; color: white;" @if(request()->segment(1)=='posts') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-up-arrow-circle'></i></div>
					<div class="menu-title" style="color: white;">Posts</div>
				</a>
				<ul style="background-color: #2E4F6B;">
					<li> <a href="{{URL::to('/')}}/medias" style="color: white;"><i class='bx bx-radio-circle'></i>All Sections</a></li>
					<li> <a href="{{URL::to('/')}}/sections" style="color: white;"><i class='bx bx-radio-circle'></i>Section List</a></li>
					<li>
						@if(Auth::user()->id == 1) 
							<a href="{{URL::to('/')}}/sections/create" style="color: white;"><i class='bx bx-radio-circle'></i>Add New Section</a>
						@endif
					</li>
				</ul>
			</li>
		@endif
		@if(in_array("pos", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a href="{{URL::to('/')}}/pos" @if(request()->segment(1)=='pos') @endif>
					<div class="parent-icon" style="color: white;"><i class="bx bx-calculator"></i></div>
					<div class="menu-title" style="color: white;">Point of sale (POS)</div> 
				</a>
			</li>
		@endif
		@if(in_array("settings", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a href="{{URL::to('/')}}/settings/{{1}}/edit" @if(request()->segment(1)=='settings') @endif>
					<div class="parent-icon" style="color: white;"><i class="bx bxl-yelp"></i></div>
					<div class="menu-title" style="color: white;">Settings</div>
				</a>
			</li>
		@endif
		@if(in_array("users", $permissionArray)===true)
			<li style="background-color: #2E4F6B;">
				<a class="has-arrow" href="javascript:;" style="color: white;" @if(request()->segment(1)=='users') @endif>
					<div class="parent-icon" style="color: white;"><i class='bx bx-user-circle'></i></div>
					<div class="menu-title" style="color: white;">Users</div>
				</a>
				<ul style="background-color: #2E4F6B;">
					<li> <a href="{{URL::to('/')}}/users" style="color: white;"><i class='bx bx-radio-circle'></i>All users</a></li>
					<li> <a href="{{URL::to('/')}}/users/create" style="color: white;"><i class='bx bx-radio-circle'></i>Add New Users</a></li>
				</ul>
			</li>
		@endif

	@else
		<script>
			window.location = "{{URL::to('/')}}/login";
		</script>
	@endif
	</ul>
	<!--end navigation-->
</div>