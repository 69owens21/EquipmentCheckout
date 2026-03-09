<!DOCTYPE html>
<html>
<head>

    <a href="/register" style="background: blue; color: white; padding: 10px; border-radius: 5px;">Register Now</a>
    <title>Equipment Checkout</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f7f6; }
        h1 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }

        /* Status Colors */
        .status-available { color: green; font-weight: bold; }
        .status-checked-out { color: red; font-weight: bold; }
        .status-broken { color: darkorange; font-weight: bold; }

        /* Button Styling */
        .btn-checkout {
            cursor: pointer;
            background: #2c3e50;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85em;
            transition: background 0.3s;
        }
        .btn-checkout:hover { background: #34495e; }
    </style>
</head>
<body>

<h1>IT Equipment Inventory</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Type</th>
        <th>Serial Number</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($equipment as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->serial_number }}</td>
            <td>
                @if($item->status == 'Available')
                    <span class="status-available">{{ $item->status }}</span>

                    <form action="/checkout/{{ $item->id }}" method="POST" style="display:inline; margin-left: 10px;">
                        @csrf
                        <button type="submit" class="btn-checkout">
                            Check Out
                        </button>
                    </form>

                @elseif($item->status == 'Checked Out')
                    <span class="status-checked-out">{{ $item->status }}</span>
                @else
                    <span class="status-broken">{{ $item->status }}</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
