@extends('layouts.master')
@section('title') {{'Order Detalis'}} @endsection
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
                <a href="{{URL::to('/')}}/orders/" class="btn btn-dark btn-sm" tabindex="-1" role="button" aria-disabled="true">All Orders</a>
            </div>
        </div>
		<hr/>
        <div class="row">
            <div class="col-md-1 col-log-1 col-12"></div>
            <div class="col-md-10 col-log-10 col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="invoice">
                            <div class="toolbar hidden-print">
                                <div class="text-end">
                                    <button type="button" class="btn btn-sm btn-dark"><i class="fa fa-print"></i> Print</button>
                                    <button type="button" class="btn btn-sm btn-dark"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                                </div>
                                <hr/>
                            </div>
                            <div class="invoice overflow-auto">
                                <div style="min-width: 600px">
                                    <div class="row ">
                                        <div class="col"><h5 class="name" style="text-transform: uppercase;">Esay Soft Ltd.</h5></div>
                                        <p>
                                            Address: <br>
                                            Email: <br>
                                            Contact No:
                                        </p>
                                    </div>
                                    <main>
                                        <div class="row contacts">
                                            <div class="col invoice-to">
                                                <h5 class="name">INVOICE TO:</h5>
                                                <p>
                                                    Company Name: <br>
                                                    Address: <br>
                                                    Email: <br>
                                                    Contact No:
                                                </p>
                                            </div>
                                            <div class="col invoice-details">
                                                <h2 class="invoice-id">INVOICE</h2>
                                                <p>
                                                    <b>Invoice No:</b> 123654<br>
                                                    <b>Date of Invoice:</b> 01/10/2018<br>
                                                    <b>Due Date:</b> 30/10/2018<br>
                                                </p>
                                            </div>
                                        </div>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; background-color: gray; padding-top: 0px; padding-bottom: 0px;">SR</th>
                                                    <th style="background-color: gray; padding-top: 0px; padding-bottom: 0px;">ITEM</th>
                                                    <th style="text-align: center; background-color: gray; padding-top: 0px; padding-bottom: 0px;">IMAGE</th>
                                                    <th style="background-color: gray; padding-top: 0px; padding-bottom: 0px;">DESCRIPTION</th>
                                                    <th style="text-align: center; background-color: gray; padding-top: 0px; padding-bottom: 0px;">QTY</th>
                                                    <th style="text-align: end; background-color: gray; padding-top: 0px; padding-bottom: 0px;">UNIT PRICE</th>
                                                    <th style="text-align: end; background-color: gray; padding-top: 0px; padding-bottom: 0px;">TOTAL AMOUNT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center; padding-top: 0px; padding-bottom: 0px;">01</td>
                                                    <td style="padding-top: 0px; padding-bottom: 0px;">Product Name</td>
                                                    <td style="text-align: center; padding-top: 0px; padding-bottom: 0px;">Image</td>
                                                    <td style="padding-top: 0px; padding-bottom: 0px;">Product Description</td>
                                                    <td style="text-align: center; padding-top: 0px; padding-bottom: 0px;">01</td>
                                                    <td style="text-align: end; padding-top: 0px; padding-bottom: 0px;">123654.00</td>
                                                    <td style="text-align: end; padding-top: 0px; padding-bottom: 0px;">123654.00</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center; padding-top: 0px; padding-bottom: 0px;">01</td>
                                                    <td style="padding-top: 0px; padding-bottom: 0px;">Product Name</td>
                                                    <td style="text-align: center; padding-top: 0px; padding-bottom: 0px;">Image</td>
                                                    <td style="padding-top: 0px; padding-bottom: 0px;">Product Description</td>
                                                    <td style="text-align: center; padding-top: 0px; padding-bottom: 0px;">01</td>
                                                    <td style="text-align: end; padding-top: 0px; padding-bottom: 0px;">123654.00</td>
                                                    <td style="text-align: end; padding-top: 0px; padding-bottom: 0px;">123654.00</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" style="text-align: center; padding-top: 0px; padding-bottom: 0px;"></th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px; font-weight: bold;">Subtotal:</th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px; font-weight: bold;">123654.00</th>
                                                </tr>
                                                <tr>
                                                <th colspan="5" style="text-align: center; padding-top: 0px; padding-bottom: 0px;"></th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px;">Tax:</th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px;">123654.00</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" style="text-align: center; padding-top: 0px; padding-bottom: 0px;"></th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px;">Discount:</th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px;">123654.00</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" style="text-align: center; padding-top: 0px; padding-bottom: 0px;"></th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px; font-weight: bold;">Total:</th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px; font-weight: bold;">123654.00</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" style="text-align: center; padding-top: 0px; padding-bottom: 0px;"></th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px;">Delivery Charge:</th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px;">123654.00</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" style="text-align: center; padding-top: 0px; padding-bottom: 0px;"></th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px; font-weight: bold;">Grand Total:</th>
                                                    <th style="text-align: end; padding-top: 0px; padding-bottom: 0px; font-size: 14px; font-weight: bold;">123654.00</th>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </main>
                                    <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-log-1 col-12"></div>
        </div>
    </div>
</div>
@endsection