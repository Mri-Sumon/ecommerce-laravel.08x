@extends('layouts.master')
@section('title') {{'Edit Section'}} @endsection
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
                <a href="{{URL::to('/')}}/sections" class="btn btn-sm" tabindex="-1" style="background-color: #2E4F6B; padding: 5px; color: white;">All Sections</a>
            </div>
        </div>
		<hr/>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="card-header px-4 py-3">
                                <h5 class="mb-0">Update Data</h5>
                            </div>
                            <div class="my-3 mx-3">
                                <div class="form-group row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        @if(session('fail'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{session('fail')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <form action="{{URL::to('/')}}/sections/{{$updateData->id}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    @method('PATCH')

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Section Name</label>
                                        <div class="col-sm-9">
                                            <input id="sectionsName" type="text" value="{{$updateData->sectionsName}}" name="sectionsName" class="form-control" placeholder="Write section name">
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
                                            <input id="sort" type="number" value="{{$updateData->sort}}" name="sort" class="form-control" placeholder="Sorting number">
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
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</div>
@endsection