///////////////////////////////////////////////////////////////COMPANY LOGO/////////////////////////////////////////////////////////////
<br>
<br>
<br>
@if($settingsAllData->headerFooterLogo != "headerFooterLogo")
    <a href="{{URL::to('/')}}">
	    <img src="{{asset('Application/public/images/settings/headerFooterLogoName'.$settingsAllData->headerFooterLogo)}}" height="45" width="180" alt="Logo">
    </a>
@endif
<br>
<br>
<br>

 

//////////////////////////////////////////////////////////////lOGIN AND REGISTRATION////////////////////////////////////////////////////
<br>
<br>
<br>
<!-- Login & Register start  -->
@if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10" style="margin-bottom: 30px;">
        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="text-decoration: none;">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="text-decoration: none;">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="text-decoration: none;">Register</a>
            @endif
        @endauth
    </div>
@endif
<!-- Login & Register end  -->

<!-- Signout start  -->
@auth
<div style="margin-bottom: 30px;">
	<a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none;">Sign Out</a> 
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	@csrf
	</form>
</div>
@endauth
<!-- Signout End  -->

<!-- Home start -->
<div style="margin-bottom: 30px;">
    <a href="{{URL::to('/')}}" style="text-decoration: none;">Home</a>
</div>
<br>
<!-- Home end -->

<!-- Cart Menu start  -->
@php
    $user = auth()->user();
    if($user && $user->phoneNumber != NULL){
        $count = \DB::table('carts')->where('phone', $user->phoneNumber)->count();
    }
@endphp


@auth  
    <a href="@if($count != NULL) {{URL::to('/')}}/cart @else {{URL::to('/')}} @endif" style="text-decoration: none;">
        <i class="fa-solid fa-cart-shopping"></i>Cart[{{ $count }}]
    </a>
@endauth
<!-- Cart Menu End  -->
<br>
<br>
<br>



/////////////////////////////////////////////////////////////////////ALL PAGES//////////////////////////////////////////////////////////////
<br>
<br>
<br>
@php $parentPages = \DB::table('pages')->where('parentPage', 0)->where('status', 'active')->orderBy('sorts','asc')->get(); @endphp
@foreach($parentPages as $parentPage)
    <div>
        <a href="{{$parentPage->pageLinks != NULL ? $parentPage->pageLinks : URL::to('/')}}/frontend/subPages/{{$parentPage->slug}}" role="button" style="text-decoration: none;">{{$parentPage->pageName}}</a>
        @php $subPages = \DB::table('pages')->where('parentPage',$parentPage->id)->where('status','active')->orderBy('sorts','asc')->get(); @endphp
        @if(count($subPages) > 0)
            @foreach($subPages as $subPage)
                <br>
                -><a href="{{$subPage->pageLinks != NULL ? $subPage->pageLinks : URL::to('/')}}/frontend/subPages/{{$subPage->slug}}" role="button" style="text-decoration: none;">{{$subPage->pageName}}</a>
            @endforeach
        @endif
    </div>
@endforeach
<br>
<br>
<br>


////////////////////////////////////////////////////////////ALL CATEGORIES & SUBCATEGORIES//////////////////////////////////////////
<br>
<br>
<br>
@php $parentCategories = \DB::table('categories')->where('assignParentCategory', 0)->where('status', 'active')->orderBy('sort','asc')->get(); @endphp
@foreach($parentCategories as $parentCategory)
    <div>
        <a href="{{URL::to('/')}}/categoryWiseProduct/{{$parentCategory->id}}">
            <img src="{{asset('Application/public/images/categories/categoryImage'.$parentCategory->categoryImage)}}" alt="Product Image"; width="40" height="40">
        </a>
        <a href="{{URL::to('/')}}/categoryWiseProduct/{{$parentCategory->id}}" style="text-decoration: none;">{!!$parentCategory->id!!}</a>
        <a href="{{URL::to('/')}}/categoryWiseProduct/{{$parentCategory->id}}" style="text-decoration: none;">{!!$parentCategory->categoryIcon!!}</a>
        <a href="{{URL::to('/')}}/categoryWiseProduct/{{$parentCategory->id}}" style="text-decoration: none;">{!!$parentCategory->categoryName!!}</a>
        @php $subCategories = \DB::table('categories')->where('assignParentCategory',$parentCategory->id)->where('status','active')->orderBy('sort','asc')->get(); @endphp
        @if(count($subCategories) > 0)
            @foreach($subCategories as $subCategory)
                <br>
                <a href="{{URL::to('/')}}/categoryWiseProduct/{{$subCategory->id}}" style="text-decoration: none;">
                    ---------------><img src="{{asset('Application/public/images/categories/categoryImage'.$subCategory->categoryImage)}}" alt="Product Image"; width="40" height="40">
                </a>
                <a href="{{URL::to('/')}}/categoryWiseProduct/{{$subCategory->id}}" style="text-decoration: none;">{!!$subCategory->id!!}</a>
                <a href="{{URL::to('/')}}/categoryWiseProduct/{{$subCategory->id}}" style="text-decoration: none;">{!!$subCategory->categoryIcon!!}</a>
                <a href="{{URL::to('/')}}/categoryWiseProduct/{{$subCategory->id}}" style="text-decoration: none;">{!!$subCategory->categoryName!!}</a>
            @endforeach
        @endif
    </div>
@endforeach
<br>
<br>
<br>




















