@extends('layouts.master')
@section('title') {{'Single Show'}} @endsection
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
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="card-content mt-5">
                            <div class=row>
                                <style>
                                    @media only screen and (max-width: 426px) {
                                        .singleimage{
                                            margin-bottom: 30px;
                                        }
                                    }
                                </style>
                                <div class="col-12 col-md-6 col-lg-6 singleimage">
                                    <img src="{{asset('Application/public/images/categories/categoryImage'.$singleShow->categoryImage)}}" width="100%">
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <h3>{!!$singleShow->categoryIcon!!} &nbsp {!!$singleShow->categoryName!!}</h3>
                                    <b>Parent Category:</b>&nbsp 
                                        @if($singleShow->assignParentCategory == '0')
                                            This is parent category
                                        @else
                                            {{\DB::table('categories')->where('id',$singleShow->assignParentCategory)->value('categoryName')}}
                                        @endif
                                    <br>
                                    <b>Status:</b>&nbsp{{$singleShow->status}}<br>
                                    <b>Sort:</b>&nbsp{{$singleShow->sort}}<br><br><br><br>
                                    <div>
                                        <a href="{{URL::to('/')}}/categories/{{$singleShow->id}}/edit" class="btn btn-primary btn-sm" tabindex="-1" role="button" aria-disabled="true">Update Data</a>
                                    </div>
                                </div>
                            </div><br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</div>
@endsection