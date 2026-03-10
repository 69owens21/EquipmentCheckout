<!DOCTYPE html>
<html>
<head>
    <title>Equipment Checkout</title>
    <style>
        /* This section controls how the page looks (colors, fonts, spacing) */
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f4f7f6; }
        h1 { color: #2c3e50; }

        /* Table styling for a clean, professional look */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }

        /* Specific colors for different equipment statuses */
        .status-available { color: green; font-weight: bold; }
        .status-checked-out { color: red; font-weight: bold; }
        .status-broken { color: darkorange; font-weight: bold; }

        /* General styling for all buttons on the page */
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

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">

    <div>
        <a href="/register" style="background: blue; color: white; padding: 10px; border-radius: 5px; text-decoration: none; margin-right: 10px;">Register Now</a>

        @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: #e74c3c; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">
                    Log Out
                </button>
            </form>

            <span style="margin-left: 15px; font-size: 0.9em; color: #7f8c8d;">
                Logged in as: <strong>{{ Auth::user()->name }}</strong> ({{ ucfirst(Auth::user()->role) }})
            </span>
        @endif
    </div>

    @if(Auth::user() && Auth::user()->role === 'admin')
        <a href="/repairs" style="text-decoration:none; padding:10px; background: #d35400; color:white; border-radius:5px;">
            View Repair Queue
        </a>
    @endif
</div>

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

                    @if(Auth::user() && Auth::user()->role === 'student')
                    <form action="/checkout/{{ $item->id }}" method="POST" style="display:inline; margin-left: 10px;">
                        @csrf
                        <button type="submit" class="btn-checkout">Check Out</button>
                        @endif
                    </form>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 10px 0;">
                    @if(Auth::user() && Auth::user()->role === 'admin')
                    <form action="/repair/{{ $item->id }}" method="POST" style="display:block;">
                        @csrf
                        <input type="text" name="notes" placeholder="What's wrong?" required style="padding: 4px; font-size: 0.8em; width: 120px;">
                        <button type="submit" class="btn-checkout" style="background: #d35400;">Send to Repair</button>
                        @endif
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
