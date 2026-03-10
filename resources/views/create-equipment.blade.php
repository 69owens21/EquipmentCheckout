<!DOCTYPE html>
<html>
<head>
    <title>Add New Equipment</title>
    <style>
        /* 1. LAYOUT & FONTS - Matching Inventory & Repair Pages */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 60px 20px;
            background-color: #3a5f8a; /* Steel Blue Background */
            color: #1f2933;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* 2. THE FORM CONTAINER */
        .form-container {
            background: #fffaf0; /* Floral White container */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            color: #00205b; /* TAMUT Navy */
            margin-top: 0;
            font-size: 1.8rem;
            text-align: center;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        /* 3. INPUTS & LABELS */
        label {
            font-weight: 600;
            color: #1f2933;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            box-sizing: border-box;
            background-color: white;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #3a5f8a;
            box-shadow: 0 0 0 3px rgba(58, 95, 138, 0.1);
        }

        /* 4. THE PRIMARY BUTTON */
        button {
            background: #00205b; /* TAMUT Navy */
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        button:hover {
            background: #2E5A88;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        /* 5. NAVIGATION LINK */
        .back-link {
            display: block;
            margin-top: 25px;
            text-align: center;
            color: #fffaf0; /* White text to show up on blue background */
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .back-link:hover {
            opacity: 0.8;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Add New Equipment</h1>

    <form action="/equipment/store" method="POST">
        @csrf

        <label for="name">Equipment Name</label>
        <input type="text" name="name" id="name" placeholder="e.g., MacBook Air M2" required>

        <label for="serial_number">Serial Number</label>
        <input type="text" name="serial_number" id="serial_number" placeholder="e.g., MAC-88472" required>

        <label for="type">Category</label>
        <select name="type" id="type" required>
            <option value="" disabled selected>Select a category...</option>
            <option value="Laptop">Laptop</option>
            <option value="Display">Display</option>
            <option value="Camera">Camera</option>
            <option value="Tablet">Tablet</option>
            <option value="Accessory">Accessory</option>
        </select>

        <button type="submit">Add to Inventory</button>
    </form>
</div>

<a href="/" class="back-link">← Cancel and Go Back</a>

</body>
</html>
