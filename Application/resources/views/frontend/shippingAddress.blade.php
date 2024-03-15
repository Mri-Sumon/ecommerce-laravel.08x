@extends('frontendLayouts.master')
@section('title') {{'Shipping Address'}} @endsection
@section('content')

<style>
    table{
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<form action="">
    <h5>Shipping Address:</h5><br>
    <div><input type="text" name="userName" placeholder="Your Name"></div><br>
    <div><input type="text" name="email" placeholder="Your Email address"></div><br>
    <div><input type="text" name="country" placeholder="Country"></div><br>
    <div><input type="text" name="state" placeholder="State"></div><br>
    <div><input type="text" name="city" placeholder="City"></div><br>
    <div><input type="number" name="zip" placeholder="Zip"></div><br>
    <div><textarea name="shippingAddress" cols="25" rows="3">Shipping address</textarea></div><br>
    <div><input type="number" name="contactNumber" placeholder="Contact Number"></div><br>
    <div><textarea name="orderNotes" cols="25" rows="3">Order Notes</textarea></div><br>
    <h5>Order Summary:</h5><br>
    <h5>Payment Methods:</h5><br>
    <div>
        <button type="submit" class="btn btn-sm btn-primary">Create</button>
    </div>
</form>
<br>
<br>
<br>
<br>


@endsection





















