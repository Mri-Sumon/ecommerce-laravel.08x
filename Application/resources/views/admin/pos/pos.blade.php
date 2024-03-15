@extends('layouts.master')
@section('title') {{'Point of sale (POS)'}} @endsection
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
                
            </div>
        </div>
		<hr/>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- successfull message start -->
                            <div class="form-group row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    @if(session('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Well done!</strong> {{session('message')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- successfull message end -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10 d-flex justify-content-end">

            </div>
            <div class="col-lg-1"></div>
        </div>
        <div class="d-flex justify-content-end">
        </div>
    </div>
</div>
@endsection