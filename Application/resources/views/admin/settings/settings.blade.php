@extends('layouts.master')
@section('title') {{'Settings'}} @endsection
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
            <div class="col-lg-10 mx-auto">
				<div class="card">
					<div class="card-body p-4 my-3 mx-3">
                        <div class="form-group row">
                            <div class="col-12 col-md-12 col-lg-12">
                                @if(session('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Well done!</strong> {{session('message')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        @foreach($settings as $setting)
                        <form action="{{URL::to('/')}}/settings/{{1}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
                                <label for="websiteIcon" class="col-md-3 col-form-label">Website Icon</label>
                                <div class="col-md-9">
                                    @if($setting->websiteIcon != "websiteIcon")
                                        <img src="{{asset('Application/public/images/settings/websiteIconName'.$setting->websiteIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                    @endif    
                                    <input id="websiteIcon" type="file" value="" name="websiteIcon" class="form-control">
                                </div>
							</div>

                            <div class="row mb-3">
								<label for="websiteTitle" class="col-sm-3 col-form-label">Website Title</label>
								<div class="col-sm-9">
									<input id="websiteTitle" type="text" value="{{$setting->websiteTitle}}" name="websiteTitle" class="form-control" placeholder="Website title">
								</div>
							</div>

							<div class="row mb-3">
								<label for="marqueeText" class="col-sm-3 col-form-label">Header/Footer scroller text (Maximum 2000 Character)</label>
								<div class="col-sm-9">
                                    <textarea id="marqueeText" name="marqueeText" class="form-control" placeholder="Write top scroller text...">{{$setting->marqueeText}}</textarea>
								</div>
							</div>

                            <div class="row mb-3">
                                <label for="headerFooterLogo" class="col-md-3 col-form-label">Header/Footer Logo</label>
                                <div class="col-md-9">
                                    @if($setting->headerFooterLogo != "headerFooterLogo")
                                        <img src="{{asset('Application/public/images/settings/headerFooterLogoName'.$setting->headerFooterLogo)}}" alt="Icon"; width="200" height="50"><br><br>
                                    @endif    
                                    <input id="headerFooterLogo" type="file" value="" name="headerFooterLogo" class="form-control">
                                </div>
							</div>
                            
                            <div class="row mb-3">
								<label for="companyName" class="col-sm-3 col-form-label">Company Name</label>
								<div class="col-sm-9">
									<input id="companyName" type="text" value="{{$setting->companyName}}" name="companyName" class="form-control" placeholder="Company name">
								</div>
							</div>

                            <div class="row mb-3">
								<label for="companyAddress" class="col-sm-3 col-form-label">Company Address</label>
								<div class="col-sm-9">
									<input id="companyAddress" type="text" value="{{$setting->companyAddress}}" name="companyAddress" class="form-control" placeholder="Address">
								</div>
							</div>

                            <div class="row mb-3">
								<label for="telephone" class="col-sm-3 col-form-label">Telephone</label>
								<div class="col-sm-9">
									<div class="row">
                                        <div class="col-6"><input id="telephone" type="number" value="{{$setting->telephone}}" name="telephone" class="form-control" placeholder="Telephone"></div>
                                        <div class="col-6">
                                            @if($setting->telephoneIcon != "telephoneIcon")
                                                <img src="{{asset('Application/public/images/settings/telephoneIconName'.$setting->telephoneIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="telephoneIcon" type="file" value="" name="telephoneIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="fax" class="col-sm-3 col-form-label">Fax</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="fax" type="number" value="{{$setting->fax}}" name="fax" class="form-control" placeholder="Fax"></div>
                                        <div class="col-6">
                                            @if($setting->faxIcon != "faxIcon")
                                                <img src="{{asset('Application/public/images/settings/faxIconName'.$setting->faxIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="faxIcon" type="file" value="" name="faxIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="mobile" type="number" value="{{$setting->mobile}}" name="mobile" class="form-control" placeholder="Mobile number"></div>
                                        <div class="col-6">
                                            @if($setting->mobileIcon != "mobileIcon")
                                                <img src="{{asset('Application/public/images/settings/mobileIconName'.$setting->mobileIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="mobileIcon" type="file" value="" name="mobileIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="email" class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="email" type="text" value="{{$setting->email}}" name="email" class="form-control" placeholder="Email address"></div>
                                        <div class="col-6">
                                            @if($setting->emailIcon != "emailIcon")
                                                <img src="{{asset('Application/public/images/settings/emailIconName'.$setting->emailIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="emailIcon" type="file" value="" name="emailIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div> 

                            <div class="row mb-3">
								<label for="facebook" class="col-sm-3 col-form-label">Facebook</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="facebook" type="text" value="{{$setting->facebook}}" name="facebook" class="form-control" placeholder="Facebook link"></div>
                                        <div class="col-6">
                                            @if($setting->facebookIcon != "facebookIcon")
                                                <img src="{{asset('Application/public/images/settings/facebookIconName'.$setting->facebookIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="facebookIcon" type="file" value="" name="facebookIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="whatsapp" class="col-sm-3 col-form-label">Whatsapp</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="whatsapp" type="text" value="{{$setting->whatsapp}}" name="whatsapp" class="form-control" placeholder="Whatsapp number"></div>
                                        <div class="col-6">
                                            @if($setting->whatsappIcon != "whatsappIcon")
                                                <img src="{{asset('Application/public/images/settings/whatsappIconName'.$setting->whatsappIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="whatsappIcon" type="file" value="" name="whatsappIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="twitter" class="col-sm-3 col-form-label">Twitter</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="twitter" type="text" value="{{$setting->twitter}}" name="twitter" class="form-control" placeholder="Twitter link"></div>
                                        <div class="col-6">
                                            @if($setting->twitterIcon != "twitterIcon")
                                                <img src="{{asset('Application/public/images/settings/twitterIconName'.$setting->twitterIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="twitterIcon" type="file" value="" name="twitterIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="instagram" class="col-sm-3 col-form-label">Instagram</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="instagram" type="text" value="{{$setting->instagram}}" name="instagram" class="form-control" placeholder="Instagram link"></div>
                                        <div class="col-6">
                                            @if($setting->instagramIcon != "instagramIcon")
                                                <img src="{{asset('Application/public/images/settings/instagramIconName'.$setting->instagramIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="instagramIcon" type="file" value="" name="instagramIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="linkedin" class="col-sm-3 col-form-label">Linkedin</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="linkedin" type="text" value="{{$setting->linkedin}}" name="linkedin" class="form-control" placeholder="Linkedin link"></div>
                                        <div class="col-6">
                                            @if($setting->linkedinIcon != "linkedinIcon")
                                                <img src="{{asset('Application/public/images/settings/linkedinIconName'.$setting->linkedinIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif    
                                            <input id="linkedinIcon" type="file" value="" name="linkedinIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="googlePage" class="col-sm-3 col-form-label">Google Page</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="googlePage" type="text" value="{{$setting->googlePage}}" name="googlePage" class="form-control" placeholder="Google Page link"></div>
                                        <div class="col-6">
                                            @if($setting->googlePageIcon != "googlePageIcon")
                                                <img src="{{asset('Application/public/images/settings/googlePageIconName'.$setting->googlePageIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif
                                            <input id="googlePageIcon" type="file" value="" name="googlePageIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="pinterest" class="col-sm-3 col-form-label">Pinterest</label>
								<div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-6"><input id="pinterest" type="text" value="{{$setting->pinterest}}" name="pinterest" class="form-control" placeholder="Pinterest link"></div>
                                        <div class="col-6">
                                            @if($setting->pinterestIcon != "pinterestIcon")
                                                <img src="{{asset('Application/public/images/settings/pinterestIconName'.$setting->pinterestIcon)}}" alt="Icon"; width="80" height="80"><br><br>
                                            @endif
                                            <input id="pinterestIcon" type="file" value="" name="pinterestIcon" class="form-control">
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="googlemap" class="col-sm-3 col-form-label">Google Map</label>
								<div class="col-sm-9">
                                    <textarea id="googlemap" name="googlemap" class="form-control" placeholder="Google map">{{$setting->googlemap}}</textarea>
								</div>
							</div>

                            <div class="row mb-3">
								<label for="officeHours" class="col-sm-3 col-form-label">Office Hours</label>
								<div class="col-sm-9">
									<input id="officeHours" type="text" value="{{$setting->officeHours}}" name="officeHours" class="form-control" placeholder="Office Hours">
								</div>
							</div>

                            <div class="row mb-3">
								<label for="copyrightText" class="col-sm-3 col-form-label">Copyright Text</label>
								<div class="col-sm-9">
									<input id="copyrightText" type="text" value="{{$setting->copyrightText}}" name="copyrightText" class="form-control" placeholder="Copyright Text">
								</div>
							</div>

							<div class="row">
                                <label for="number" class="col-md-3 col-form-label"></label> 
                                <div class="col-md-9 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </div>
							</div>
						</form>
                        @endforeach
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection