@extends('frontendLayouts.master')
@section('title') {{'Category Wise Products'}} @endsection
@section('content')


@foreach($categoryWiseProducts as $categoryWiseProduct)
    <a href="{{URL::to('/')}}/singleShow/{{$categoryWiseProduct->id}}" style="text-decoration: none;">
        <img src="{{asset('Application/public/images/products/productImage'.$categoryWiseProduct->productImage)}}" width="200" height="200"><br>
        <b>{{$categoryWiseProduct->productName}}</b><br>
        <b>Regular Price:</b>&nbsp{{$categoryWiseProduct->regularPrice}}<br>
        <b>Sale Price:</b>&nbsp{{$categoryWiseProduct->sellingPrice}}<br>
    </a>
    <br>
    <br>
    <br>
@endforeach



@endsection