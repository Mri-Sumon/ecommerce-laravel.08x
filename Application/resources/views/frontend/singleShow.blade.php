@extends('frontendLayouts.master')
@section('title') {{'Single Show'}} @endsection
@section('content')



/////////////////////////////////////////////////////////////Single Product Show////////////////////////////////////////////////////////
<br>
<br>
<br>
<img src="{{asset('Application/public/images/products/productImage'.$singleShow->productImage)}}" width="150" height="150"><br>
<b>{{$singleShow->productName}}<b><br>
<b>Brand:</b>{{$singleShow->brandName}}<br>
{!!$singleShow->brandDescription!!}
<b>Product Code:</b>&nbsp{{$singleShow->productCode}}<br>
<b>Regular Price:</b>&nbsp <del>&#2547;{{$singleShow->regularPrice}}</del><br>
<b>Product Category:</b>&nbsp<br>
<b>Discount Type:</b>&nbsp{{$singleShow->discountType}}<br>
<b>Discount Amount:</b>&nbsp{{$singleShow->discountAmount}}<br>
<b>Sale Price:</b>&nbsp{{$singleShow->sellingPrice}}<br>
<b>Product Status:</b>&nbsp{{$singleShow->status}}<br>
<b>Sortby:</b>&nbsp{{$singleShow->sort}}<br>
<b>Tag:</b>&nbsp{{$singleShow->tag}}<br>
<b>Product Brief:</b>&nbsp{!!$singleShow->productBrief!!}<br>
<b>Other pictures of the product:</b><br>
<div class="mt-2" style="margin-right: 10px;">
    <?php $multipleImage=explode(',',$singleShow->productImages);?>
    @foreach($multipleImage as $image)
        @if($image!='')
            <img src="{{asset('Application/public/images/products/productImages'.$image)}}" width="80" height="80" style="padding:3px;">
        @endif
    @endforeach
</div><br>
<b>Product Description<b><br>
{!!$singleShow->productDescription!!}<br>



/////////////////////////////////////////////////////////////Related Products////////////////////////////////////////////////////////
<br>
<br>
<br>
@php $products = \DB::table('products')->where('categoryId', $singleShow->categoryId)->get(); @endphp
@foreach($products as $product)
    @if($singleShow->id != $product->id)
        <a href="{{URL::to('/')}}/singleShow/{{$product->id}}">
            <img src="{{asset('Application/public/images/products/productImage'.$product->productImage)}}" width="150" height="150"><br>
            <b>{{$product->productName}}<b><br>
            <b>Brand:</b>{{$product->brandName}}<br>
        </a>
        <br>
        <br>
    @endif
@endforeach



/////////////////////////////////////////////////////////////Product Review using INPUT FIELD////////////////////////////////////////////////////////
<br>
<br>
<br>
<!-- submit review start  -->
@php
    if(Auth::check()) {
        $user_id = Auth::id();
@endphp
    <form action="{{URL::to('/') }}/reviews" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{$singleShow->id}}">
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <label for="comment">Comments:</label>
        <textarea name="comment" required></textarea><br>
        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" required min="1" max="5"><br>
        <button type="submit">Submit</button>
    </form>
@php
    }
@endphp
<!-- submit review end  -->
<br>
<br>
<br>
<!-- show review start -->
@php $reviews = \DB::table('reviews')->get(); @endphp
@foreach($reviews as $review)
    @if($singleShow->id == $review->product_id)
        @php $users = \DB::table('users')->where('id', $review->user_id)->get(); @endphp
        @foreach($users as $user)
            <span>{{$user->name}}</span><br>
        @endforeach
        <span>{{$review->comment}}</span><br>
        <span>{{$review->rating}} out of 5</span>
        
        <br>
        <br>
    @endif
@endforeach
<!-- show review end -->
<br>
<br>
<br>

<!-- avarage rating start -->
@php $reviews = \DB::table('reviews')->get(); @endphp
<?php 
    $sum = 0;
    $numberOfCommentators = 0;
?>
@foreach($reviews as $review)
    @if($singleShow->id == $review->product_id)
        <?php
            $firstValue = $review->rating;
            $sum = $sum + $firstValue;
            $numberOfCommentators++;
        ?>
    @endif
@endforeach
@if($sum != 0)
    <?php
            $averageRating = $sum / $numberOfCommentators;
            // create round figure 
            $originalNumber = $averageRating;
            $roundedNumber = round($originalNumber, 1);
    ?>
    <p>Average Rating: {{$roundedNumber}} <i class="fa-solid fa-star"></i></p>
@endif
<!-- avarage rating end -->

/////////////////////////////////////////////////////////////Add to Cart////////////////////////////////////////////////////////
<br>
<br>
<br>
<div class="form-group row">
    <div class="col-12 col-md-12 col-lg-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Well done!</strong> {{session('success')}}
            </div>
        @endif
    </div>
</div>

<form action="{{URL::to('/') }}/addToCart/{{$singleShow->id}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="number" value="1" min="1" name="qty">
    <button type="submit" >Add to Cart</button>
</form>

<br>
<br>
<br>
















@endsection
