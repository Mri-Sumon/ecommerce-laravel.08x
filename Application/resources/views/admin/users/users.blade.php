@extends('layouts.master')
@section('title') {{'All Users'}} @endsection
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
                    <form action="{{URL::to('/')}}/userSearch" method="get" class="d-flex">
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
                    <a href="{{URL::to('/')}}/users">@yield('title')</a> | 
                    <a href="{{URL::to('/')}}/users_pdf"><i class="fa fa-print"></i></a>
                </h6>
            </div>
            <div class="col-12 col-md-6 col-lg-6 d-flex justify-content-end addNewProducts">
                <a href="{{URL::to('/')}}/users/create" class="btn btn-sm" tabindex="-1" role="button" aria-disabled="true" style="background-color: #2E4F6B; color: white;">Add New Users</a>&nbsp;
                <a href="{{URL::to('/')}}/utrash" class="btn btn-sm btn-warning" tabindex="-1" role="button" aria-disabled="true" style="color: white;">Trash</a>
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
                                    @foreach($users as $user)
                                        @if ($firstIteration && Auth::user()->userType == "admin")
                                            @php
                                                $firstIteration = false;
                                                continue;
                                            @endphp
                                        @endif
                                        <tr>
                                            @if(Auth::user()->id == 1)
                                                <td>{{$users->firstItem()+$loop->index}}</td>
                                            @else
                                                <td>{{$users->firstItem()+$loop->index-1}}</td>
                                            @endif
                                            <td>000{{$user->id}}</td> 
                                            <td>
                                                @if($user->id !=1)
                                                    <a href="{{URL::to('/')}}/users/{{$user->id}}/edit">{{$user->name}}</a>
                                                @else
                                                    <p class="text-dark font-weight-bold">{{$user->name}}</p>
                                                @endif
                                            </td> 
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phoneNumber}}</td>
                                            <td>
                                                @if($user->userType=='developer')
                                                    <span>Developer</span>
                                                @elseif($user->userType=='admin')
                                                    <span>Admin</span>
                                                @elseif($user->userType=='user')
                                                    <span>User</span>
                                                @else
                                                    <span>None</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->status == 'active')
                                                    <span style="color: green;">{{$user->status}}</span>
                                                @else
                                                    <span style="color: red;">{{$user->status}}</span>
                                                @endif
                                            </td>
                                            <td>{{$user->sort}}</td>
                                            <td>
                                                @if (Auth::user()->userType == "developer" || Auth::user()->userType == "admin")
                                                    <a href="{{URL::to('/')}}/users/{{$user->id}}/edit" class="btn btn-info btn-sm" style="width: 80px; margin-bottom: 5px;">Edit</a><br>
                                                    @if (Auth::user()->userType ==  $user->userType)
                                                        @php
                                                            continue;
                                                        @endphp
                                                    @endif
                                                    <form action="{{URL::to('/')}}/users/{{$user->id}}" method="POST">
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
        <div class="row mb-5">
            <!-- <div class="col-lg-1"></div> -->
            <div class="col-lg-12 d-flex justify-content-end">
                {{$users->links()}}
            </div>
            <!-- <div class="col-lg-1"></div> -->
        </div>
    </div>
</div>
@endsection