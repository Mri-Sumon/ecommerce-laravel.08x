<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <style>
            body {
                background-color: #ffffff;
                color: #333333;
                font-family: Arial, sans-serif;
                font-size: 16px;
            }

            @media print {
                body {
                    background-color: #ffffff;
                    color: #000000;
                    font-size: 12px;
                }
            }

            table{
                width: 100%;
            }

            table, tr, th, td{
                padding: 5px;
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>

    <body>
        <table>
            <thead>
                <tr>
                    <th>Sr.</th>
                    <th>Image</th>
                    <th>Product Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Sort</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{asset('Application/public/images/products/productImage'.$product->productImage)}}" alt="Product Image"; width="80" height="80"></td>
                        <td>
                            Product Name: {{$product->productName}}<br>
                            Brand: {{$product->brandName}}<br>
                            Product Code: {{$product->productCode}}<br>
                            Regular Price: {{$product->regularPrice}}<br>
                            Discount Type: {{$product->discountType}}<br>
                            Discount Amount: {{$product->discountAmount}}<br>
                            Selling Price: {{$product->sellingPrice}}<br>
                            Feature Product: {{$product->featureProduct}}<br>
                            Top Selling Product: {{$product->topSellingProduct}}<br>
                            Tag: {{$product->tag}}<br>
                            Product Brief: {!!$product->productBrief!!}<br>
                            Product Description: {!!$product->productDescription!!}<br>
                            Brand Description: {!!$product->brandDescription!!}<br>
                            Sale Price: {{$product->salePrice}}<br>
                        </td>
                        <td>
                            @if($product->productName != NULL)
                                @php $categories = DB::table('categories')->where('id', $product->categoryId)->value('categoryName'); @endphp
                                {{$categories}}
                            @endif
                        </td>
                        <td>
                            @if($product->status == 'inactive')
                                <span style="color: red;">{{$product->status}}</span>
                            @else
                                <span style="color: green;">{{$product->status}}</span>
                            @endif
                        </td>
                        <td>{{$product->sort}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>









