<!DOCTYPE html>
<html>
<head>
    <title>Equipment Checkout</title>
    <style>
        /* 1. LAYOUT & FONTS */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background-color: #3a5f8a; /* Steel Blue Background */
            color: #1f2933; /* Dark Slate for text */
            line-height: 1.6;
        }

        h1 {
            color: #fffaf0; /* Floral White for high contrast against blue */
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.2);
        }

        /* 2. MODERN TABLE STYLING */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            background: #fffaf0; /* Off-white table background */
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background-color: #00205b; /* TAMUT Navy */
            color: #fffaf0;
            padding: 18px;
            text-align: left;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #1f2933;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover { background-color: #f1f5f9; }

        /* 3. STATUS BADGES */
        .status-available { color: #16a34a; font-weight: bold; }
        .status-checked-out { color: #dc2626; font-weight: bold; }
        .status-broken { color: #ea580c; font-weight: bold; }

        /* 4. BUTTON STYLING */
        .btn-checkout {
            cursor: pointer;
            background: #00205b; /* Navy Buttons */
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 0.85em;
            font-weight: 600;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .btn-checkout:hover {
            background: #3a5f8a;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Input styling for the repair notes */
        input[type="text"] {
            border: 1px solid #e5e7eb;
            padding: 6px;
            border-radius: 4px;
            outline-color: #3a5f8a;
        }
    </style>
</head>
<body>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">

    <div>
        <a href="/register" style="background: #2E5A88 ; color: white; padding: 10px; border-radius: 5px; text-decoration: none; margin-right: 10px;">Register Now</a>

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

    <div>
        @if(Auth::user() && Auth::user()->role === 'admin')
            <a href="/equipment/create" style="text-decoration:none; padding:10px; background: #27ae60; color:white; border-radius:5px; margin-right: 10px;">
                + Add Equipment
            </a>

            <a href="/repairs" style="text-decoration:none; padding:10px; background: orangered; color:white; border-radius:5px;">
                View Repair Queue
            </a>
        @endif
    </div>
</div>



<h1>IT Equipment Inventory</h1>

<div style="margin-bottom: 20px; background: #fffaf0; padding: 15px; border-radius: 8px; display: flex; gap: 10px; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <form action="/" method="GET" style="display: flex; gap: 10px; width: 100%;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, serial, or type..."
               style="flex-grow: 1; padding: 10px; border: 1px solid #e5e7eb; border-radius: 6px;">

        <button type="submit" class="btn-checkout" style="background: #3a5f8a;">Search</button>

        @if(request('search'))
            <a href="/" style="text-decoration: none; color: #721c24; padding: 10px;">Clear</a>
        @endif
    </form>
</div>
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
