<!DOCTYPE html>
<html>
<head>
    <title> Equipment Checkout </title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table {width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td {border: 1px solid #ddd; padding: 10px; text-align: left;}
        th {background-color: #2c3e50; color: white;}
        .status-available {color: green; font-weight: bold;}
        .status-checked-out {color: red; font-weight: bold;}
        .status-broken {color: darkorange; font-weight: bold;}
    </style>
</head>
<body>
<h1> IT Equipment Inventory</h1>
<table>
    <thead>
    <tr>
        <th> ID </th>
        <th> Name </th>
        <th> Type </th>
        <th> Serial Number </th>
        <th> Status </th>
    </tr>
    </thead>
    <tbody>
    @foreach($equipment as $item)
        <tr>
            <td>{{$item -> id}}</td>
            <td>{{$item -> name}}</td>
            <td>{{$item -> type}}</td>
            <td>{{$item -> serial_number}}</td>
            <td>
                @if($item -> status == 'Available')
                    <span class="status-available">{{$item->status}}</span>
                @elseif($item -> status == 'Checked Out')
                    <span class="status-checked-out">{{$item->status}}</span>
                    @else
                        <span class="status-broken">{{$item->status}}</span>

                    @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>

</html>
