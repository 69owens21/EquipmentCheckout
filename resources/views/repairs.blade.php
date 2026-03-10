<!DOCTYPE html>
<html>
<head>
    <title>Repair Shop</title>
    <style>
        body {font-family: Arial, sans-serif; padding: 20px; background-color: #fff5f0;}
        h1{color: #d35400;}
        nav{margin-bottom: 20px;}
        table{width: 100%; border-collapse: collapse; background:white;}
        td, th{border: 1px solid #ddd; padding: 12px; text-align: left;}
        th{background-color: #d35400; color:white;}
        .btn-nav{text-decoration: none; padding: 10px; background: #2c3e50; color:white; border-radius: 5px;}
    </style>
</head>

<body>
<nav>
    <a href="/" class="btn-nav">Back to Inventory</a>
</nav>

<h1>Maintenance & Repair Queue</h1>
<table>
    <thead>
    <tr>
        <th>Equipment</th>
        <th>Serial</th>
        <th>Issue/Notes</th>
        <th>Expected Return</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    @foreach($broken as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->serial_number}}</td>
            <td>{{$item->repair_notes ?? 'No notes'}}</td>
            <td>{{$item->return_date ?? 'TBD'}}</td>
            <td>
                <form action="checkin/{{$item->id}}" method="POST">
                    @csrf
                    <button type="submit" style="cursor:pointer; background: #27ac60; color:white;
                    border:none; padding: 8px; border-radius: 4px;">
                        Fixed - Return to Service
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>





</body>


</html>
