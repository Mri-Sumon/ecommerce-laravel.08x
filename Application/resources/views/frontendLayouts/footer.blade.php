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


///////////////////////////////////////////////////////////////////Copyrigtht Text/////////////////////////////////////////////////////
<br>
<br>
<br>
<footer class="">
	<p class="">{{$settingsAllData->copyrightText}}</p>
</footer>
<br>
<br>
<br>


