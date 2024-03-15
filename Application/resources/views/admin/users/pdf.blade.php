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
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Sort</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phoneNumber}}</td>
                        <td>{{$user->userType}}</td>
                        <td>
                            @if($user->status == 'inactive')
                                <span style="color: red;">{{$user->status}}</span>
                            @else
                                <span style="color: green;">{{$user->status}}</span>
                            @endif
                        </td>
                        <td>{{$user->sort}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>









