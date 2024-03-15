@extends('frontendLayouts.master')
@section('title') {{'Home'}} @endsection
@section('content')

///////////////////////////////////////////////////////////////////ALL SECTIONS//////////////////////////////////////////////////////////
<br>
<br>
<br>Pictures Section<br>
------------------------
<br>
@foreach($medias as $media)
    @if($media->slug == 'pictures')
        <img src="{{asset('Application/public/images/sections/section'.$media->pictures)}}" alt="Product Image"; width="80" height="80"><br>
        <span>{{$media->title}}</span><br>
        <span>{{$media->description}}</span><br>
    @endif
@endforeach

<br> 
<br>
<br>Video Section<br>
------------------------
<br>
@foreach($medias as $media)
    @if($media->slug == 'videos')
        <iframe src="{!!$media->videos!!}" title="videos" height="80" width="80"></iframe><br>
        <span>{{$media->title}}</span><br>
        <span>{{$media->description}}</span><br>
    @endif
@endforeach
<br>
<br>
<br>


////////////////////////////////////////////////////////////////////ALL PRODUCTS/////////////////////////////////////////////////////
<br>
<br>
<br>Feature Products<br>
------------------------
<br>
@foreach($products as $product)
    @if($product->featureProduct == 'yes')
        <img src="{{asset('Application/public/images/products/productImage'.$product->productImage)}}" alt="Product Image"; width="80" height="80"><br>
        <span>{{$product->productName}}</span><br>
        <span>{{$product->brandName}}</span><br>
        <span>{{$product->productCode}}</span><br>
        <span>{{$product->regularPrice}}</span><br>
        <span>{{$product->sellingPrice}}</span><br>
    @endif
@endforeach

<br>
<br>
<br>Top Selling Products<br>
------------------------
<br>
@foreach($products as $product)
    @if($product->topSellingProduct == 'yes')
        <img src="{{asset('Application/public/images/products/productImage'.$product->productImage)}}" alt="Product Image"; width="80" height="80"><br>
        <span>{{$product->productName}}</span><br>
        <span>{{$product->brandName}}</span><br>
        <span>{{$product->productCode}}</span><br>
        <span>{{$product->regularPrice}}</span><br>
        <span>{{$product->sellingPrice}}</span><br>
    @endif
@endforeach

<br>
<br>
<br>Latest Products<br>
------------------------
<br>
@foreach($latestProducts as $latestProduct)
    <img src="{{asset('Application/public/images/products/productImage'.$latestProduct->productImage)}}" alt="Product Image"; width="80" height="80"><br>
    <span>{{$latestProduct->productName}}</span><br>
    <span>{{$latestProduct->brandName}}</span><br>
    <span>{{$latestProduct->productCode}}</span><br>
    <span>{{$latestProduct->regularPrice}}</span><br>
    <span>{{$latestProduct->sellingPrice}}</span><br>
@endforeach
<br>
<br>
<br>


@endsection
















