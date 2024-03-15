@extends('frontendLayouts.master')
@section('title') {{'Cart'}} @endsection
@section('content')
<br>
<br>
<br>
<br>
    <style>
        table {
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

    <!-- Successfull message  -->
    <div class="form-group row">
        <div class="col-12 col-md-12 col-lg-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Well done!</strong> {{session('success')}}
                </div>
            @endif
        </div>
    </div>
    <!-- Successfull message  -->

    <h2>Cart</h2>
    <form action="{{ URL::to('/confirmOrder') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        <table>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
                <th>Remove</th>
            </tr>

            @foreach($items as $item)
                <tr>
                    <input type="text" name="productId[]" value="{{ $item->id }}" hidden>
                    <td>
                        <input type="text" name="productImage[]" value="{{ $item->image }}" hidden>
                        <img src="{{ asset('Application/public/images/products/productImage' . $item->image) }}" alt="Image" width="80" height="80">
                    </td>
                    <td>
                        <input type="text" name="productName[]" value="{{ $item->productName }}" hidden>
                        {{ $item->productName }}
                    </td>
                    <td>
                        <input type="number" name="qty[]" value="{{ $item->qty }}" class="quantity-input" data-price="{{ $item->price }}" min="1">
                    </td>
                    <td>
                        <input type="number" name="unitPrice[]" value="{{ $item->price }}" hidden>
                        {{ $item->price }}
                    </td>
                    <td class="total-price">
                        <input type="number" name="totalPrice[]" value="{{ $item->qty * $item->price }}" hidden>
                        {{ $item->qty * $item->price }}
                    </td>
                    <td>
                        <a href="{{ URL::to('/deleteItem/' . $item->id) }}" class="btn btn-danger btn-sm" style="width: 80px !important;">Remove</a>
                    </td>
                </tr>
            @endforeach

            <!-- Display subtotal -->
            <tr id="subtotal">
                <td></td>
                <td></td>
                <td></td>
                <td>Subtotal:</td>
                <!-- The initial value, which will be updated using JavaScript -->
                <td>
                    <span id="subtotal-value"></span>
                    <input type="text" name="subTotal" id="subtotal-input" placeholder="Subtotal" hidden>
                </td>
                <td></td>
            </tr>

        </table>

        <button type="submit" class="btn btn-sm btn-primary mt-3">Proceed to Checkout</button>
    </form>




    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Call the function to update total prices and subtotal initially
            updateTotalPrices();
            $('.quantity-input').on('input', function () {
                updateItemTotalPrice($(this));
                updateTotalPrices();
            });
            $('.remove-btn').on('click', function (e) {
                e.preventDefault();
                // Handle removal logic here
                updateTotalPrices();
            });

            // Function to update total prices and subtotal
            function updateTotalPrices() {
                var subtotal = 0;
                // Iterate through all the total prices and calculate subtotal
                $('.total-price').each(function () {
                    subtotal += parseFloat($(this).text());
                });
                // Update the subtotal display
                $('#subtotal-value').text(subtotal.toFixed(2));
                
                // Set the value of the input field
                $('#subtotal-input').val(subtotal.toFixed(2));
            }

            // Function to update the total price for a specific item
            function updateItemTotalPrice(quantityInput) {
                var quantity = quantityInput.val();
                var price = quantityInput.data('price');
                var totalCell = quantityInput.closest('tr').find('.total-price');
                // Calculate the new total price
                var totalPrice = quantity * price;
                // Update the corresponding total price cell
                totalCell.text(totalPrice.toFixed(2));
                // Update the subtotal
                updateTotalPrices();
            }
        });
    </script>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection


























