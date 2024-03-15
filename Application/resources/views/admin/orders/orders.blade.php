@extends('layouts.master')
@section('title') {{'All Order'}} @endsection
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
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="background-color: #2E4F6B; color: white;">SR</th>
                                        <th style="background-color: #2E4F6B; color: white;">CUSTOMER INFO</th>
                                        <th style="background-color: #2E4F6B; color: white;">ORDER DATE</th>
                                        <th style="background-color: #2E4F6B; color: white;">TOTAL QTY</th>
                                        <th style="background-color: #2E4F6B; color: white;">TOTAL AMOUNT</th>
                                        <th style="background-color: #2E4F6B; color: white;">PAYMENT TYPE</th>
                                        <th style="background-color: #2E4F6B; color: white;">STATUS</th>
                                        <th style="background-color: #2E4F6B; color: white;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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

                                                <form action="#" method="POST">
                                                    @csrf
                                                    <br>

                                                    <!-- Modal start here  -->
                                                    <div class="actionMenu">
                                                        <style>
                                                            .custom-modal {
                                                                max-width: 55%;
                                                            }
                                                        </style>
                                                        <a href="#" style="color: black;" data-bs-toggle="modal" data-bs-target="#exampleModal">Order Details</a>
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable custom-modal">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-light">
                                                                        <p class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Customer Order Details</p>
                                                                        <a href="#" style="font-size: 25px;">
                                                                            <i class="fa fa-print"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="modal-body" style="padding: 15px;">
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-lg-6 col-12">
                                                                                <span>Dispatch To:</span><br>
                                                                                <span>Name:</span><br>
                                                                                <span>Address:</span><br>
                                                                                <span>Phone No:</span><br>
                                                                            </div>
                                                                            <div class="col-md-6 col-lg-6 col-12 d-flex justify-content-end">
                                                                                <img src="" alt="Company Logo" width="150" height="100">
                                                                            </div>
                                                                        </div>
                                                                        <style>
                                                                            hr.new2 {
                                                                                border-top: 3px dashed black;
                                                                                margin: 0px;
                                                                            }
                                                                        </style>
                                                                        <hr class="new2">
                                                                        <br>
                                                                        <div class="row">
                                                                            <span>Order ID:</span><br>
                                                                            <span>Thank you for buying from ecommerce.com</span>
                                                                        </div>
                                                                        <div class="row" style="padding: 15px;">
                                                                            <div style="border: 1px solid gray;">
                                                                                <span>Order Date:</span><br>
                                                                                <span>Delivery Service:</span><br>
                                                                                <span>Order By:</span><br>
                                                                                <span>Payment Type:</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row" style="padding-left: 15px; padding-right: 15px;">
                                                                            <table class="table" style="border: 1px solid gray;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col" style="border: 1px solid gray; text-align: center;">Quantity</th>
                                                                                        <th scope="col" style="border: 1px solid gray; text-align: center;">Product Details</th>
                                                                                        <th scope="col" style="border: 1px solid gray; text-align: center;">Unit Price (BDT)</th>
                                                                                        <th scope="col" style="border: 1px solid gray; text-align: center;">Sub-Total (BDT)</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th style="border: 1px solid gray; text-align: center;">01</th>
                                                                                        <td style="border: 1px solid gray;">
                                                                                            <div class="row" style="padding: 15px;">
                                                                                                <div class="col-md-6" style="border: 1px solid gray;"><img src="img_girl.jpg" alt="Girl in a jacket" width="500" height="600"></div>
                                                                                                <div class="col-md-6" style="border: 1px solid gray;">Product Details</div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td style="border: 1px solid gray; text-align: right;">.00</td>
                                                                                        <td style="border: 1px solid gray; text-align: right;">.00</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        <td style="text-align: right;">
                                                                                            <span>Order Price:</span><br>
                                                                                            <span>Delivery Price:</span><br>
                                                                                            <span>Discount:</span><br>
                                                                                            <span>Amount With Delivery Charge:</span><br>
                                                                                            <span>Paid Amount:</span>
                                                                                        </td>
                                                                                        <td style="text-align: right;">
                                                                                            <span>.00</span><br>
                                                                                            <span>.00</span><br>
                                                                                            <span>.00</span><br>
                                                                                            <span>.00</span><br>
                                                                                            <span>.00</span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div>
                                                                            <span>Thank you for purchasing on Ecommerce.com, To provide seller feedback, please visit ecommerce.com</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer bg-light">
                                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal end here  -->
                                                    
                                                    <hr>
                                                    <div style="background-color: #2E4F6B; padding: 3px; color: white; margin-bottom: 5px;">Change Status</div>
                                                    <div class="actionMenu"><a href="#" onclick="return orderedConformation()" style="color: black;">Ordered</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return shippedConformation()" style="color: black;">Shipped</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return diliveredConformation()" style="color: black;">Delivered</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return cancelledConformation()" style="color: black;">Cancelled</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return returnedConformation()" style="color: black;">Returned</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return closedConformation()" style="color: black;">Closed</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return deleteOrderConformation()" style="color: black;">Delete Order</a></div>
                                                    
                                                    <script>
                                                        function orderedConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure to set the status as Ordered?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }

                                                        function shippedConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure to set the status as Shipped?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }

                                                        function diliveredConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure to set the status as Delivered?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                        
                                                        function cancelledConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure to set the status as Cancell?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }

                                                        function returnedConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure to set the status as Returned?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }

                                                        function closedConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure to set the status as Closed?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }

                                                        function deleteOrderConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure to set the status as Delete Order?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                    </script>
                                                </form>
                                                
                                                <hr>
                                                <div class="actionMenu mb-2">
                                                    <form action="#" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a type="submit" onclick="return deleteConformation()" style="width: 80px !important; color: red;">Delete</a>
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
                                                <br>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
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
    </div>
</div>
@endsection