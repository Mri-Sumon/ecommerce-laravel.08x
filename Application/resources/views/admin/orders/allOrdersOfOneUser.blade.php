@extends('layouts.master')
@section('title') {{'All Orders of this ID'}} @endsection
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="breadcrumb-title pe-3"><a href="{{URL::to('/')}}" style="font-size: 16px !important;">Home</a></div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="{{URL::to('/')}}/dashboard">Dashboard</a></li>
					</ol>
				</nav>
			</div>
		</div>
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
                <a href="{{URL::to('/')}}/orders" class="btn btn-dark btn-sm" tabindex="-1" role="button" aria-disabled="true">All Orders</a>
            </div>
        </div>
		<hr/>
        <div class="row">
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-12">
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
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="background-color: #6495ED !important;">ID</th>
                                        <th style="background-color: #6495ED !important;">CID</th>
                                        <th style="background-color: #6495ED !important;">CNAME</th>
                                        <th style="background-color: #6495ED !important;">TOTAL QTY</th>
                                        <th style="background-color: #6495ED !important;">TOTAL AMOUNT</th>
                                        <th style="background-color: #6495ED !important;">ORDER DATE</th>
                                        <th style="background-color: #6495ED !important;">STATUS</th>
                                        <th style="background-color: #6495ED !important;">PAYMENT TYPE</th>
                                        <th style="background-color: #6495ED !important;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->customerId}}</td>
                                        <td>{{$order->customerName}}</td>
                                        <td>{{$order->productQty}}</td>
                                        <td>{{$order->grandTotal}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->customerStatus}}</td>
                                        <td>Payment method name</td>
                                        <td>
                                            <style>
                                                .accordion {
                                                    background-color: #eee;
                                                    color: #444;
                                                    cursor: pointer;
                                                    width: 100%;
                                                    border: none;
                                                    text-align: left;
                                                    outline: none;
                                                    font-size: 15px;
                                                    transition: 0.4s;
                                                }

                                                .active, .accordion:hover {
                                                    background-color: #ccc;
                                                }

                                                .accordion:after {
                                                    content: '\002B';
                                                    color: #777;
                                                    font-weight: bold;
                                                    float: right;
                                                    margin-left: 5px;
                                                }

                                                .active:after {
                                                    content: "\2212";
                                                }

                                                .panel {
                                                    padding: 0 18px;
                                                    background-color: white;
                                                    max-height: 0;
                                                    overflow: hidden;
                                                    transition: max-height 0.2s ease-out;
                                                }
                                            </style>
                                            <style>
                                                .actionMenu:hover {
                                                    background-color: lightgray;
                                                }
                                            </style>
                                            <button class="accordion"><i class="fa fa-bars"></i></button>
                                            <div class="panel">
                                                <div class="actionMenu mt-2"><a href="{{URL::to('/')}}/orders/{{$order->id}}" style="color: black;">Order details</a></div>
                                                <div class="actionMenu"><a href="{{URL::to('/')}}/allOrdersOfOneUser/{{$order->id}}" style="color: black;">All orders from this ID</a></div>
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <div class="actionMenu"><a href="#" onclick="return shippedConformation()" style="color: black;">Shipped conformation</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return deliveredConformation()" style="color: black;">Delivered conformation</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return cancelledConformation()" style="color: black;">Order cancelled</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return returnedConformation()" style="color: black;">Returned conformation</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return closedConformation()" style="color: black;">Closed</a></div>
                                                    <script>
                                                        function shippedConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure, Order Shipped?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                        function deliveredConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure, Order Delivered?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                        function cancelledConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure, Order Cancelled?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                        function returnedConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure, Order Returned?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                        function closedConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure, Order Closed?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                    </script>
                                                </form>
                                                <div class="actionMenu mb-2">
                                                    <form action="#" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a type="submit" onclick="return deleteConformation()" style="width: 80px !important;">Delete</a>
                                                        <script>
                                                            function deleteConformation(){
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
                                                    </form>
                                                </div>
                                            </div>
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
    </div>
</div>
@endsection