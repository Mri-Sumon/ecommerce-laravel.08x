@extends('layouts.master')
@section('title') {{'Payment Methods'}} @endsection
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--topbar start-->
		<div class="row" style="background-color: #2E4F6B; padding-left: 5px; padding-top: 5px; padding-bottom: 5px;">
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
            <div class="row" style="padding: 0px;">
                <div class="col">
                    <ul style="padding: 1%">
                        <li><a href="{{URL::to('/')}}" style="color:white;">Home &nbsp | &nbsp</a></li>
                        <li><a href="{{URL::to('/')}}/dashboard" style="color:white;">Dashboard</a></li>
                    </ul>
                </div>
                <div class="col d-flex justify-content-end" style="padding: 0px;">
                    <form action="{{URL::to('/')}}/paymentMethodsSearch" method="get" class="d-flex">
                        @csrf
                        <input class="form-control me-2" name="keyword" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </div>
            </div>
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
                <h6 class="mb-0 text-uppercase" style="padding-top: 7px !important;"><a href="{{URL::to('/')}}/paymentsMethods">@yield('title')</a></h6>
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end addNewProducts">
                <a href="{{URL::to('/')}}/paymentsMethods/create" class="btn btn-sm" tabindex="-1" style="background-color: #2E4F6B; padding: 5px; color: white;">Add New Payment Methods</a> &nbsp;
                <a href="{{URL::to('/')}}/pmtrash" class="btn btn-sm btn-warning" tabindex="-1" role="button" aria-disabled="true" style="color: white;">Trash</a>
            </div>
        </div>
		<hr/>
        <div class="row">
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- message start -->
                            <div class="form-group row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Well done!</strong> {{session('success')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    @if(session('fail'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Well done!</strong> {{session('fail')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    @if(session('delete'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Well done!</strong> {{session('delete')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- message end -->
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="background-color: #2E4F6B; color: white;">SR</th>
                                        <th style="background-color: #2E4F6B; color: white;">LOGO</th>
                                        <th style="background-color: #2E4F6B; color: white;">TRANSACTION NUMBER</th>
                                        <th style="background-color: #2E4F6B; color: white;">OPERATOR NAME</th>
                                        <th style="background-color: #2E4F6B; color: white;">SLUG</th>
                                        <th style="background-color: #2E4F6B; color: white;">STATUS</th>
                                        <th style="background-color: #2E4F6B; color: white;">SORT</th>
                                        <th style="background-color: #2E4F6B; color: white;">CREATED BY</th>
                                        <th style="background-color: #2E4F6B; color: white;">UPDATED BY</th>
                                        <th style="background-color: #2E4F6B; color: white;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paymentmethods as $paymentMethod)
                                        <tr>
                                            <td>{{$paymentmethods->firstItem()+$loop->index}}</td>
                                            <td><img src="{{asset('Application/public/images/paymentMethods/logo'.$paymentMethod->logo)}}" alt="logo"; width="80" height="80"></td>
                                            <td>{!!$paymentMethod->transactionNumber!!}</td>
                                            <td>{!!$paymentMethod->operatorName!!}</td>
                                            <td>{!!$paymentMethod->slug!!}</td>
                                            <td>
                                                @if($paymentMethod->status == 'active')
                                                    <span style="color: green;">{!!$paymentMethod->status!!}</span>
                                                @else
                                                    <span style="color: red;">{!!$paymentMethod->status!!}</span>
                                                @endif
                                            </td>
                                            <td>{!!$paymentMethod->sort!!}</td>
                                            <td>{!!$paymentMethod->createdBy!!}</td>
                                            <td>{!!$paymentMethod->updatedBy!!}</td>
                                            <td>
                                                <a href="{{URL::to('/')}}/paymentsMethods/{{$paymentMethod->id}}/edit" class="btn btn-info btn-sm" style="width: 80px !important; margin-bottom: 3px !important;">Edit</a><br>
                                                <form action="{{URL::to('/')}}/paymentsMethods/{{$paymentMethod->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return delete_conformation()" style="width: 80px !important;">Delete</button>
                                                </form>
                                                <script>
                                                    function delete_conformation(){
                                                        var txt;
                                                        var r = confirm("Are you sure you want to delete?");
                                                        if (r == true) {
                                                            txt = "You pressed OK!";
                                                        } else {
                                                            txt = "You pressed Cancel!";
                                                            event.preventDefault();
                                                        }
                                                    }
                                                </script>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-1"></div> -->
        </div>
        <div class="row mt-3 mb-5">
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-12 d-flex justify-content-end">
                {{$paymentmethods->links()}}
            </div>
            <!-- <div class="col-lg-1"></div> -->
        </div>
    </div>
</div>
@endsection