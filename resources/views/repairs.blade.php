<!DOCTYPE html>
<html>
<head>
    <title>Repair Shop</title>
    <style>
        /* 1. LAYOUT & FONTS - Matching Inventory Page */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background-color: #3a5f8a; /* Steel Blue Background */
            color: #1f2933;
            line-height: 1.6;
        }

        h1 {
            color: #fffaf0; /* Floral White for contrast */
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.2);
        }

        /* 2. NAVIGATION BUTTON */
        nav { margin-bottom: 30px; }
        .btn-nav {
            text-decoration: none;
            padding: 12px 20px;
            background: #00205b; /* TAMUT Navy */
            color: white;
            border-radius: 6px;
            font-weight: bold;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-nav:hover {
            background: #1f2933;
            transform: translateX(-3px); /* Subtle nudge effect */
        }

        /* 3. TABLE STYLING */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fffaf0; /* Off-white table background */
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background-color: #ea580c; /* Maintenance Orange - keeps the "Repair" vibe */
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
        tr:hover { background-color: #fef3c7; } /* Soft amber highlight for repair items */

        /* 4. ACTION BUTTON */
        .btn-fixed {
            cursor: pointer;
            background: #16a34a; /* Success Green */
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-fixed:hover {
            background: #15803d;
            transform: scale(1.05); /* Pop-out effect */
        }
    </style>
</head>

<body>
<nav>
    <a href="/" class="btn-nav">← Back to Inventory</a>
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
            <td><strong>{{$item->name}}</strong></td>
            <td><code>{{$item->serial_number}}</code></td>
            <td>{{$item->repair_notes ?? 'No notes provided'}}</td>
            <td>{{$item->return_date ?? 'TBD'}}</td>
            <td>
                <form action="/checkin/{{$item->id}}" method="POST">
                    @csrf
                    <button type="submit" class="btn-fixed">
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
