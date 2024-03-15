@extends('layouts.master')
@section('title') {{'All Products'}} @endsection
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
                    <form action="{{URL::to('/')}}/productSearch" method="get" class="d-flex">
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
                <h6 class="mb-0 text-uppercase" style="padding-top: 7px !important;">
                    <a href="{{URL::to('/')}}/products">@yield('title')</a> | 
                    <a href="{{URL::to('/')}}/products_pdf"><i class="fa fa-print"></i></a>
                </h6>
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end addNewProducts">
                <a href="{{URL::to('/')}}/products/create" class="btn btn-sm" tabindex="-1" role="button" aria-disabled="true" style="background-color: #2E4F6B; color: white;">Add New Products</a> &nbsp;
                <a href="{{URL::to('/')}}/ptrash" class="btn btn-sm btn-warning" tabindex="-1" role="button" aria-disabled="true" style="color: white;">Trash</a>
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
                                    @if(session('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Well done!</strong> {{session('message')}}
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
                            <div class="form-group row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    @if(session('fail'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{session('fail')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- message end -->
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="background-color: #2E4F6B; color: white;">SR</th>
                                        <th style="background-color: #2E4F6B; color: white;">IMAGE</th>
                                        <th style="background-color: #2E4F6B; color: white;">NAME</th>
                                        <th style="background-color: #2E4F6B; color: white;">CODE</th>
                                        <th style="background-color: #2E4F6B; color: white;">RPRICE</th>
                                        <th style="background-color: #2E4F6B; color: white;">SPRICE</th>
                                        <th style="background-color: #2E4F6B; color: white;">CATEGORY</th>
                                        <th style="background-color: #2E4F6B; color: white;">STATUS</th>
                                        <th style="background-color: #2E4F6B; color: white;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productsData as $item)
                                        <tr>
                                            <td>{{$productsData->firstItem()+$loop->index}}</td>
                                            <td><img src="{{asset('Application/public/images/products/productImage'.$item->productImage)}}" alt="Product Image"; width="100" height="100"></td>
                                            <td>{{$item->productName}}</td>
                                            <td>{{$item->productCode}}</td>
                                            <td>{{$item->regularPrice}} </td>
                                            <td>{{$item->sellingPrice}} </td>
                                            <td>
                                                @php $productCategory = \DB::table("categories")->where('id', $item->categoryId)->get(); @endphp
                                                @foreach($productCategory as $category)
                                                    {{$category->categoryName}}
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($item->status == "active")
                                                    <span style="color: green;">{{$item->status}}</span>
                                                @else
                                                    <span style="color: red;">{{$item->status}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{URL::to('/')}}/products/{{$item->id}}" class="btn btn-primary btn-sm" style="width: 80px !important; margin-bottom: 3px !important;">Show</a><br>
                                                <a href="{{URL::to('/')}}/products/{{$item->id}}/edit" class="btn btn-info btn-sm" style="width: 80px !important; margin-bottom: 3px !important;">Edit</a><br>
                                                <form action="{{URL::to('/')}}/products/{{$item->id}}" method="POST">
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
                {{$productsData->links()}}
            </div>
            <!-- <div class="col-lg-1"></div> -->
        </div>
    </div>
</div>
@endsection