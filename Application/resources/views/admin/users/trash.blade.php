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
                <h6 class="mb-0 text-uppercase" style="padding-top: 7px !important;"><a href="{{URL::to('/')}}/utrash">@yield('title')</a></h6>
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end addNewProducts">
                <a href="{{URL::to('/')}}/users" class="btn btn-sm" tabindex="-1" role="button" aria-disabled="true" style="background-color: #2E4F6B; color: white;">All Users</a> &nbsp;
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
                                        <th style="background-color: #2E4F6B; color: white;">USER ID</th>
                                        <th style="background-color: #2E4F6B; color: white;">NAME</th>
                                        <th style="background-color: #2E4F6B; color: white;">EMAIL</th>
                                        <th style="background-color: #2E4F6B; color: white;">PHONE</th>
                                        <th style="background-color: #2E4F6B; color: white;">TYPE</th>
                                        <th style="background-color: #2E4F6B; color: white;">STATUS</th>
                                        <th style="background-color: #2E4F6B; color: white;">SORT</th>
                                        <th style="background-color: #2E4F6B; color: white;">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $firstIteration = true;
                                    @endphp
                                    @foreach($deletedDatas as $data)
                                        @if ($firstIteration && Auth::user()->userType == "admin")
                                            @php
                                                $firstIteration = false;
                                                continue;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td>000{{$data->id}}</td> 
                                            <td>{{$data->name}}</td> 
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->phoneNumber}}</td>
                                            <td>
                                                @if($data->userType=='developer')
                                                    <span>Developer</span>
                                                @elseif($data->userType=='admin')
                                                    <span>Admin</span>
                                                @elseif($data->userType=='user')
                                                    <span>User</span>
                                                @else
                                                    <span>None</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->status == 'active')
                                                    <span style="color: green;">{{$data->status}}</span>
                                                @else
                                                    <span style="color: red;">{{$data->status}}</span>
                                                @endif
                                            </td>
                                            <td>{{$data->sort}}</td>
                                            <td>
                                                @if (Auth::user()->userType == "developer" || Auth::user()->userType == "admin")
                                                    <a href="{{URL::to('/')}}/urestore/{{$data->id}}" class="btn btn-warning btn-sm" style="width: 80px !important; margin-bottom: 3px !important;">Restore</a><br>
                                                    @if (Auth::user()->userType ==  $data->userType)
                                                        @php
                                                            continue;
                                                        @endphp
                                                    @endif
                                                    <form action="{{URL::to('/')}}/udelete/{{$data->id}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return delete_conformation()" style="width: 80px;">Delete</button>
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
                                                @endif
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