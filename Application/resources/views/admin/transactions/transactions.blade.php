@extends('layouts.master')
@section('title') {{'Transactions'}} @endsection
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
            <div class="col-md-1 col-lg-1 col-12"></div>
            <div class="col-md-10 col-lg-10 col-12">
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
                                        <th style="background-color: #2E4F6B; color: white;">USER ID</th>
                                        <th style="background-color: #2E4F6B; color: white;">ORDER ID</th>
                                        <th style="background-color: #2E4F6B; color: white;">PAYMENT MODE</th>
                                        <th style="background-color: #2E4F6B; color: white;">TRANSACTION NUMBER</th>
                                        <th style="background-color: #2E4F6B; color: white;">PHONE NUMBER</th>
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
                                                    <div style="background-color: #2E4F6B; padding: 3px; color: white; margin-bottom: 5px;">Change Status</div>
                                                    <div class="actionMenu"><a href="#" onclick="return shippedConformation()" style="color: black;">Succeed</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return deliveredConformation()" style="color: black;">Pending</a></div>
                                                    <div class="actionMenu"><a href="#" onclick="return cancelledConformation()" style="color: black;">Failed</a></div>
                                                    <script>
                                                        function shippedConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure, payment successfull?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                        function deliveredConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure, payment pending?");
                                                            if (r == true) {
                                                                txt = "You pressed OK!";
                                                            } else {
                                                                txt = "You pressed Cancel!";
                                                                event.preventDefault();
                                                            }
                                                        }
                                                        function cancelledConformation(){
                                                            var txt;
                                                            var r = confirm("Are you sure, payment failed?");
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
            <div class="col-md-1 col-lg-1 col-12"></div>
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