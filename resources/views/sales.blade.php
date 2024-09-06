<!DOCTYPE html>
<html>
<head>
    <title>Sales Transactions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, button {
            padding: 10px;
            font-size: 16px;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sales Transactions</h1>

        <!-- Form to Add New Item -->
        <form id="sales-form">
            <div class="form-group">
                <label for="item">Nama Item:</label>
                <input type="text" id="item" name="item" required>
            </div>
            <div class="form-group">
                <label for="price">Harga:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" min="1" required>
            </div>
            <button type="submit">Add Item</button>
        </form>

        <!-- Table to Display Added Items -->
        <table id="sales-table">
            <thead>
                <tr>
                    <th>Nama Item</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be inserted here by JavaScript -->
            </tbody>
        </table>

        <!-- Total Amount Display -->
        <div id="total-amount">
            <h2>Jumlah Total: Rp<span id="total">0.00</span></h2>
        </div>
    </div>

    <script>
        document.getElementById('sales-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Get form values
            const itemName = document.getElementById('item').value;
            const price = parseFloat(document.getElementById('price').value);
            const quantity = parseInt(document.getElementById('quantity').value);
            const total = price * quantity;

            // Create a new row in the table
            const tableBody = document.getElementById('sales-table').getElementsByTagName('tbody')[0];
            const newRow = tableBody.insertRow();

            newRow.insertCell().textContent = itemName;
            newRow.insertCell().textContent = price.toFixed(2);
            newRow.insertCell().textContent = quantity;
            newRow.insertCell().textContent = total.toFixed(2);

            // Update total amount
            const totalAmountElement = document.getElementById('total');
            const currentTotal = parseFloat(totalAmountElement.textContent);
            totalAmountElement.textContent = (currentTotal + total).toFixed(2);

            // Clear form fields
            document.getElementById('sales-form').reset();
        });
    </script>
</body>
</html>
