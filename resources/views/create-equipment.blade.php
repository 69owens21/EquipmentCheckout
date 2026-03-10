<!DOCTYPE html>
<html>
<head>
    <title>Add New Equipment</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; background-color: #f4f7f6; }
        .form-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 500px; margin: auto; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { background: #2c3e50; color: white; border: none; padding: 12px; width: 100%; border-radius: 4px; cursor: pointer; }
        .back-link { display: block; margin-top: 20px; text-align: center; color: #7f8c8d; text-decoration: none; }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Add New Equipment</h1>

    <form action="/equipment/store" method="POST">
        @csrf
        <label>Equipment Name</label>
        <input type="text" name="name" placeholder="e.g., Logitech Webcam" required>

        <label>Serial Number</label>
        <input type="text" name="serial_number" placeholder="e.g., LOGI-12345" required>

        <label>Category</label>
        <select name="type" required>
            <option value="Laptop">Laptop</option>
            <option value="Camera">Camera</option>
            <option value="Tablet">Tablet</option>
            <option value="Accessory">Accessory</option>
        </select>

        <button type="submit">Add to Inventory</button>
    </form>

    <a href="/" class="back-link">← Cancel and Go Back</a>
</div>

</body>
</html>
