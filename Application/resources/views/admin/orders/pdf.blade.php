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
                    <th>Category Name</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Sort</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{asset('Application/public/images/categories/categoryImage'.$category->categoryImage)}}" alt="Product Image"; width="80" height="80"></td>
                        <td>{{ $category->categoryName}}</td>
                        <td> 
                            @if($category->assignParentCategory == '0')
                                Parent
                            @elseif(($category->assignParentCategory != '0'))
                                @php $parent = DB::table('categories')->where('id', $category->assignParentCategory)->value('categoryName'); @endphp
                                {{$parent}}
                            @endif
                        </td>
                        <td>
                            @if($category->status == 'inactive')
                                <span style="color: red;">{{$category->status}}</span>
                            @else
                                <span style="color: green;">{{$category->status}}</span>
                            @endif
                        </td>
                        <td>{{$category->sort}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>









