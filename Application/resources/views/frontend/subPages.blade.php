@extends('frontendLayouts.master')
@section('title') {{'Page'}} @endsection
@section('content')
    @foreach ($pages as $page)
        <div id="home" class="slider-area" style="margin-top:50px; margin-bottom:50px; background-color: coral;">
            <div class="container-fluid" style="padding-left: 45px; padding-right: 45px;">
                @if($page->slug!='contact_us')
                    <div class="row my-5">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="bg-light bg-gradient" style="padding: 10px;">
                                <h3 class="text-center" style="text-transform: uppercase; color: gray;">{{$page->pageTitle}}</h3>
                            </div>
                            <div class="my-5">
                                {!!$page->pageBody!!}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6">
                            <span style="font-weight: bold;">Address:</span>
                            <br>
                            <span>{!!$settings->companyAddress!!}</span>
                            <br>
                            <br>
                            <span style="font-weight: bold;">Contact:</span>
                            {{$settings->mobile}}
                            <br>

                            <span style="font-weight: bold;">Office Hours:</span>
                            {{$settings->officeHours}}
                            <br>
                            <br>
                            <br>

                            <!-- google map start -->
                            <style>
                                @media only screen and (max-width: 768px) {
                                    .googlemap{
                                        margin-bottom: 30px;
                                    }
                                }
                            </style>
                            <div class="col-12">
                                <span style="font-weight: bold;">Find us on Google Maps:</span>
                                <div class="googlemap" style="height: 400px; border: 1px solid gray; margin-top: 5px;">
                                    <iframe src="{!!$settings->googlemap!!}" title="" style="width: 100%; height: 100%; "></iframe>
                                </div>
                            </div>
                            <!-- google map end -->   
                        </div>

                        <div class="col-12 col-lg-6 col-md-6">
                            <!-- customer feedback start  -->
                                <!-- success message -->
                                <div class="form-group row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        @if(session('success')) 
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Well done!</strong> {{session('success')}}
                                            </div>
                                        @endif
                                    </div> 
                                </div>
                                <!-- fail message -->
                                <div class="form-group row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        @if(session('fail'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Well done!</strong> {{session('fail')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <span style="font-weight: bold;">Send Feedback:</span>
                                <div class="form contact-form" style="margin-top: 5px;">
                                    <form action="{{URL::to('/')}}/frontend/feedbackemail" method="post" role="form" class="" style="border: 1px solid gray; padding: 20px;">
                                    @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                        </div><br>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                        </div><br>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                        </div><br>
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                        </div><br>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Send Message</button>
                                        </div>
                                    </form>
                                </div>
                            <!-- customer feedback end  -->
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@endsection