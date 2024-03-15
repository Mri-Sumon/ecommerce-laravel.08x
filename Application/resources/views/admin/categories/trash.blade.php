@extends('layouts.master')
@section('title') {{'Trast List'}} @endsection
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
                    <ul>
                        <li><a href="{{URL::to('/')}}" style="color:white;">Home &nbsp | &nbsp</a></li>
                        <li><a href="{{URL::to('/')}}/dashboard" style="color:white;">Dashboard</a></li>
                    </ul>
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
                <h6 class="mb-0 text-uppercase" style="padding-top: 7px !important;"><a href="{{URL::to('/')}}/trash">@yield('title')</a></h6>
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end addNewProducts">
                <a href="{{URL::to('/')}}/categories" class="btn btn-sm" tabindex="-1" role="button" aria-disabled="true" style="background-color: #2E4F6B; color: white;">All Categories</a> &nbsp;
            </div>
        </div>
		<hr/>
        <div class="row">
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- successfull message start  -->
                            <div class="form-group row">
                                <div class="col-12 col-md-12 col-lg-12">
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Well done!</strong> {{session('success')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- successfull message end  -->
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="background-color: #2E4F6B; color: white;">IMAGE</th>
                                        <th style="background-color: #2E4F6B; color: white;">ICON</th>
                                        <th style="background-color: #2E4F6B; color: white;">NAME</th>
                                        <th style="background-color: #2E4F6B; color: white;">SLUG</th>
                                        <th style="background-color: #2E4F6B; color: white;">TYPE</th>
                                        <th style="background-color: #2E4F6B; color: white;">STATUS</th>
                                        <th style="background-color: #2E4F6B; color: white;">SORT</th>
                                        <th style="background-color: #2E4F6B; color: white;">CREATED BY</th>
                                        <th style="background-color: #2E4F6B; color: white;">UPDATED BY</th>
                                        <th style="background-color: #2E4F6B; color: white;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deletedDatas as $data)
                                        <tr>
                                            <td><img src="{{asset('Application/public/images/categories/categoryImage'.$data->categoryImage)}}" alt="Product Image"; width="100" height="100"></td>
                                            <td>{!!$data->categoryIcon!!}</td>
                                            <td>{{$data->categoryName}}</td>
                                            <td>{{$data->slug}}</td>
                                            <td>
                                                @if($data->assignParentCategory == '0')
                                                   Parent
                                                @else
                                                    {{\DB::table('categories')->where('id',$data->assignParentCategory)->value('categoryName')}}
                                                @endif
                                            </td>
                                            <td>@if($data->status == 'active')
                                                    <span style="color: green;">{{$data->status}}</span>
                                                @else
                                                    <span style="color: red;">{{$data->status}}</span>
                                                @endif
                                            </td>
                                            <td>{{$data->sort}}</td>
                                            <td>{{$data->createdBy}}</td>
                                            <td>{{$data->updatedBy}}</td>
                                            <td>
                                                <a href="{{URL::to('/')}}/restore/{{$data->id}}" class="btn btn-warning btn-sm" style="width: 80px !important; margin-bottom: 3px !important;">Restore</a><br>
                                                <form action="{{URL::to('/')}}/delete/{{$data->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return delete_conformation()" style="width: 80px !important;">Empty</button>
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
    </div>
</div>
@endsection