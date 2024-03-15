@extends('layouts.master')
@section('title') {{'Edit Pages'}} @endsection
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
                <a href="{{URL::to('/')}}/pages" class="btn btn-sm" tabindex="-1" style="background-color: #2E4F6B; padding: 5px; color: white;">All Pages</a>
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
                        <form action="{{URL::to('/')}}/pages/{{$updateData->id}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
								<label for="pageName" class="col-sm-3 col-form-label">Page Name</label>
								<div class="col-sm-9">
									<input id="pageName" type="text" value="{{$updateData->pageName}}" name="pageName" class="form-control" placeholder="Page name write here">
								</div>
							</div>

							<div class="row mb-3">
								<label for="pageTitle" class="col-sm-3 col-form-label">Page Title</label>
								<div class="col-sm-9">
									<input id="pageTitle" type="text" value="{{$updateData->pageTitle}}" name="pageTitle" class="form-control" placeholder="Page title write here">
								</div>
							</div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Add Parent Page</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="parentPage" name="parentPage" required>
                                        <option value="{{$updateData->parentPage}}">Select</option>
                                        @forelse($parentPagesName as $parentPageName)
                                            <option value="{{$parentPageName->id}}" style="font-weight: bold;">{{$parentPageName->pageName}}</option>
                                            @php $subPageName = \DB::table('pages')->where('parentPage',$parentPageName->id)->get(); @endphp
                                            @if(count($subPageName) > 0)
                                                @forelse($subPageName as $item)
                                                    <option value="{{$item->id}}">&nbsp;&nbsp;&nbsp;->{{$item->pageName}}</option>
                                                    @empty
                                                @endforelse
                                            @endif
                                            @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
								<label for="pageLinks" class="col-sm-3 col-form-label">Page Link</label>
								<div class="col-sm-9">
									<input id="pageLinks" type="text" value="{{$updateData->pageLinks}}" name="pageLinks" class="form-control" placeholder="Page Link">
								</div>
							</div>

                            <div class="row mb-3">
                                <label for="pageBody" class="col-md-3 col-form-label">Page Body</label>
                                <div class="col-md-9" style="padding-right: 15px">
                                    @error('pageBody')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <textarea name="pageBody" id="tinyMceFull-2" placeholder="Write page body here...">{{$updateData->pageBody}}</textarea>
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
								<label for="sorts" class="col-sm-3 col-form-label">Sort</label>
								<div class="col-sm-9">
									<input id="sorts" type="number" value="{{$updateData->sorts}}" name="sorts" class="form-control" placeholder="Sort">
								</div>
							</div>

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