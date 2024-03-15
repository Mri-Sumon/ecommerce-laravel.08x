@extends('layouts.master')
@section('title') {{'Categories Edit'}} @endsection
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
                <a href="{{URL::to('/')}}/categories" class="btn btn-sm" tabindex="-1" style="background-color: #2E4F6B; padding: 5px; color: white;">All Categories</a>
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
                        <form action="{{URL::to('/')}}/categories/{{$updateData->id}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PATCH')
                            
							<div class="row mb-3">
								<label for="categoryIcon" class="col-sm-3 col-form-label">Category Icon</span></label>
								<div class="col-sm-9">
                                    <input id="categoryIcon" type="text" value="{{$updateData->categoryIcon}}" name="categoryIcon" class="form-control" placeholder="Category Icon">
								</div>
							</div>

							<div class="row mb-3"> 
								<label for="categoryName" class="col-sm-3 col-form-label">Category Name <span style="color: red; font-weight: bold;">*</span></label>
								<div class="col-sm-9">
                                    <input id="categoryName" type="text" value="{{$updateData->categoryName}}" name="categoryName" class="form-control" placeholder="Category Name" required>
								</div>
							</div>

							<div class="row mb-3">
                                <label for="categoryImage" class="col-md-3 col-form-label">Category Image<span style="color: red; font-weight: bold;">*</span></label>
                                <div class="col-md-9">
                                    <input id="categoryImage" type="file" value="{{$updateData->categoryImage}}" name="categoryImage" class="form-control">
                                </div>
							</div>

                            @php $categories = \DB::table('categories')->where('assignParentCategory','0')->get(); @endphp
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Add Parent Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="assignParentCategory" name="assignParentCategory">
                                        <option value="0">Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" style="font-weight: bold;">{{$category->categoryName}}</option>
                                                @php $subCategories = \DB::table('categories')->where('assignParentCategory',$category->id)->get(); @endphp
                                                @if(count($subCategories)>0)
                                                    @foreach($subCategories as $subCategory)
                                                        <option value="{{$subCategory->id}}"> &nbsp &nbsp &nbsp{{$subCategory->categoryName}}</option>
                                                    @endforeach
                                                @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
								<label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-md-9" style="padding-right: 15px">
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
                                            <option selected>Select</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        @endif
                                    </select>
                                </div>
							</div>

							<div class="row mb-3">
                                <label for="sort" class="col-md-3 col-form-label">Sort</label>
                                <div class="col-md-9">
                                    <input id="sort" type="number" value="{{$updateData->sort}}" name="sort" class="form-control" placeholder="Sorting define as number">
                                </div>
							</div>

							<div class="row">
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