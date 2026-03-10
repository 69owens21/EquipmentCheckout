<!DOCTYPE html>
<html>
<head>
    <title>CSS Playground</title>
    <style>
        /* 1. GLOBAL STYLES & BOX MODEL */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            padding: 40px;
            background-color: #f4f7f6; /* Soft gray background */
            color: #333;
        }

        h1 { color: #002D56; } /* TAMUT Navy Blue */
        h3 { border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 40px; }

        /* 2. FLEXBOX NAVIGATION CONTAINER */
        .mock-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        /* 3. BUTTONS & HOVER EFFECTS */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease; /* Smooth hover transition */
        }

        .btn-primary { background: #002D56; color: white; } /* Navy */
        .btn-primary:hover { background: #001a33; transform: translateY(-2px); }

        .btn-warning { background: #F3D03E; color: #333; } /* Gold */
        .btn-warning:hover { background: #e0be2c; transform: translateY(-2px); }

        .btn-danger { background: #500000; color: white; } /* Maroon */
        .btn-danger:hover { background: #330000; transform: translateY(-2px); }

        /* 4. MODERN TABLE STYLING */
        .modern-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden; /* Keeps the rounded corners neat */
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .modern-table th {
            background-color: #002D56;
            color: white;
            text-align: left;
            padding: 15px;
        }

        .modern-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .modern-table tr:hover {
            background-color: #f8fafd; /* Very light blue highlight on hover */
        }

        /* 5. STATUS BADGES (The Pill Look) */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: bold;
            display: inline-block;
        }

        .badge-good { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .badge-bad { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .badge-neutral { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
    </style>
</head>
<body>

<div class="mock-nav">
    <div>
        <strong>UI Design Playground</strong>
    </div>
    <div style="display: flex; gap: 10px;">
        <button class="btn btn-primary">Primary Action</button>
        <button class="btn btn-warning">Warning Action</button>
        <button class="btn btn-danger">Danger Action</button>
        <button class="btn btn-testing">Testing Action</button>

    </div>
</div>

<h1>Customization Sandbox</h1>
<p>Change the CSS HEX codes in the <code>&lt;style&gt;</code> block above to see how they look in real-time.</p>

<h3>Status Badges</h3>
<span class="badge badge-good">Available</span>
<span class="badge badge-bad">Broken / Missing</span>
<span class="badge badge-neutral">Checked Out</span>

<h3>Table Styling</h3>
<table class="modern-table">
    <thead>
    <tr>
        <th>Item Name</th>
        <th>Category</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Test MacBook Pro</td>
        <td>Laptop</td>
        <td><span class="badge badge-good">Available</span></td>
        <td><button class="btn btn-primary" style="padding: 5px 10px; font-size: 0.8em;">Check Out</button></td>
    </tr>
    <tr>
        <td>Test Display Screen</td>
        <td>Monitor</td>
        <td><span class="badge badge-bad">Broken</span></td>
        <td><button class="btn btn-warning" style="padding: 5px 10px; font-size: 0.8em;">Fix Item</button></td>
    </tr>
    </tbody>
</table>

</body>
</html>
