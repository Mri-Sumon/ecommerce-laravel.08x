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
                    <th>Page Name</th>
                    <th>Parent</th>

                    @if(Auth::user()->id == 1) 
                        <th>Status</th>
                        <th>Sort</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $page->pageName}}</td>
                        <td> 
                            @if($page->parentPage == '0')
                                Parent
                            @elseif(($page->parentPage != '0'))
                                @php $parent = DB::table('pages')->where('id', $page->parentPage)->value('pageName'); @endphp
                                {{$parent}}
                            @endif
                        </td>

                        @if(Auth::user()->id == 1) 
                            <td>
                                @if($page->status == 'inactive')
                                    <span style="color: red;">{{$page->status}}</span>
                                @else
                                    <span style="color: green;">{{$page->status}}</span>
                                @endif
                            </td>
                            <td>{{$page->sorts}} </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>









