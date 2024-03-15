@extends('layouts.master')
@section('title') {{'Product Edit'}} @endsection
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
                <a href="{{URL::to('/')}}/products" class="btn btn-sm" tabindex="-1" style="background-color: #2E4F6B; padding: 5px; color: white;">All Products</a>
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
                        <form action="{{URL::to('/')}}/products/{{$updateData->id}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PATCH')
                            
                            <div class="row mb-3">
                                <label for="productName" class="col-sm-3 col-form-label">Product Name <span style="color: red; font-weight: bold;">*</span></label>
                                <div class="col-sm-9">
                                    <input id="productName" type="text" value="{{$updateData->productName}}" name="productName" class="form-control" placeholder="Product Name" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="brandName" class="col-md-3 col-form-label">Brand Name</label>
                                <div class="col-md-9">
                                    <input id="brandName" type="text" value="{{$updateData->brandName}}" name="brandName" class="form-control" placeholder="Brand Name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="productCode" class="col-md-3 col-form-label">Product Code</label>
                                <div class="col-md-9">
                                    <input id="productCode" type="number" value="{{$updateData->productCode}}" name="productCode" class="form-control" placeholder="Product Code">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="regularPrice" class="col-md-3 col-form-label">Regular Price</label>
                                <div class="col-md-9">
                                    <input id="regularPrice" type="number" value="{{$updateData->regularPrice}}" name="regularPrice" class="form-control" placeholder="Regular Price">
                                </div>
                            </div>

                            <!-- product image start -->
                            <div class="row mb-3">
                                <label for="productImage" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <label for="productImage" class="col-md-3 col-form-label">Previous Uploaded Image</label><br>
                                    <img src="{{asset('Application/public/images/products/productImage'.$updateData->productImage)}}" width="80" height="80">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="productImage" class="col-md-3 col-form-label">Product Image<span style="color: red; font-weight: bold;">*</span></label>
                                <div class="col-md-9">
                                    <input type="file" id="" value="" name="productImage" class="form-control">
                                </div>
                            </div>
                            <!-- product image end  -->

                            <!-- product images start -->
                            <div class="row mb-3">
                                <label for="productImage" class="col-md-3 col-form-label"></span></label>
                                <div class="col-md-9">
                                    <label for="productImage" class="col-md-3 col-form-label">Previous Uploaded Images</label><br>
                                    <?php $multipleImage=explode(',',$updateData->productImages);?>
                                    @foreach($multipleImage as $image)
                                        @if($image!='')
                                            <img src="{{asset('Application/public/images/products/productImages'.$image)}}" width="80" height="80">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="productImages" class="col-md-3 col-form-label">Product Images <span style="color: red; font-weight: bold;">*</span></label>
                                <div class="col-md-9">
                                    <input type="file" id="" value="" name="productImages[]"  multiple class="form-control">
                                </div>
                            </div>
                            <!-- product images start -->
                            
                            <!-- product category start  -->
                            @php $categories = \DB::table('categories')->where('assignParentCategory','0')->get(); @endphp
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Update Product Category</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="categoryId" name="categoryId">
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
                            <!-- product category end  -->

                            <div class="row mb-3">
                                <label for="discountType" class="col-sm-3 col-form-label">Discount Type</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="discountType" name="discountType">
                                        @if($updateData->discountType == 'no_discount')
                                            <option>Select</option>
                                            <option value="no_discount" selected>No Discount</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent</option>
                                        @elseif($updateData->discountType == 'fixed')
                                            <option>Select</option>
                                            <option value="no_discount">No Discount</option>
                                            <option value="fixed" selected>Fixed</option>
                                            <option value="percent">Percent</option>
                                        @elseif($updateData->discountType == 'percent')
                                            <option>Select</option>
                                            <option value="no_discount">No Discount</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent" selected>Percent</option>
                                        @else
                                            <option selected>Select</option>
                                            <option value="no_discount">No Discount</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="discountAmount" class="col-md-3 col-form-label">Discount Amount</label>
                                <div class="col-md-9">
                                    <input id="discountAmount" type="number" value="{{$updateData->discountAmount}}" name="discountAmount" class="form-control" placeholder="Discount Amount">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <label for="" class="col-md-12 col-form-label"> <b>Previous Selling Price:</b> {{$updateData->sellingPrice}}</label>
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
                                <label class="col-sm-3 col-form-label">Feature Products</label>
                                <div class="col-sm-9">
                                <select class="form-select" id="featureProduct" name="featureProduct">
                                        <option value="{{$updateData->featureProduct}}">{{$updateData->featureProduct}}</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Top Selling Products</label>
                                <div class="col-sm-9">
                                <select class="form-select" id="topSellingProduct" name="topSellingProduct">
                                        <option value="{{$updateData->topSellingProduct}}">{{$updateData->topSellingProduct}}</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="sort" class="col-md-3 col-form-label">Sort</label>
                                <div class="col-md-9">
                                    <input id="sort" type="number" value="{{$updateData->sort}}" name="sort" class="form-control" placeholder="Sorting define as number">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tag" class="col-md-3 col-form-label">Tag</label>
                                <div class="col-md-9">
                                    <input id="tag" type="text" value="{{$updateData->tag}}" name="tag" class="form-control" placeholder="Coma Separated Value">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="productBrief" class="col-md-3 col-form-label">Product Brief</label>
                                <div class="col-md-9" style="padding-right: 15px">
                                    <textarea name="productBrief" id="tinyMceFull-1" placeholder="Write Product Brief Here...">{!!$updateData->productBrief!!}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="productDescription" class="col-md-3 col-form-label">Product Description<span style="color: red; font-weight: bold;">*</span></label>
                                <div class="col-md-9" style="padding-right: 15px">
                                    <textarea name="productDescription" id="tinyMceFull-2" placeholder="Write Product Description Here...">{!!$updateData->productDescription!!}</textarea>
                                </div>
						    </div>

                            <div class="row mb-3">
                                <label for="brandDescription" class="col-md-3 col-form-label">Brand Description</label>
                                <div class="col-md-9" style="padding-right: 15px">
                                    <textarea name="brandDescription" id="tinyMceFull-3" placeholder="Write Brand Description Here...">{!!$updateData->brandDescription!!}</textarea>
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