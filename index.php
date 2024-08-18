<?php
require_once 'config/db.php';

class Product {
    private $conn;
    private $table = 'products';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

$product = new Product();
$stmt = $product->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">

    <div class="container mx-auto p-4">
        <h2 class="text-3xl font-bold mb-6 text-center">Product List</h2>
        <div class="flex justify-end mb-4">
            <a href="crud/create.php" class="btn bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-800 transition">Add New Product</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800">
                <thead>
                    <tr>
                        <th class="py-2 px-4 text-left bg-gray-700">ID</th>
                        <th class="py-2 px-4 text-left bg-gray-700">Name</th>
                        <th class="py-2 px-4 text-left bg-gray-700">Description</th>
                        <th class="py-2 px-4 text-left bg-gray-700">Price</th>
                        <th class="py-2 px-4 text-left bg-gray-700">Quantity</th>
                        <th class="py-2 px-4 text-left bg-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $counter = 1;
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                        <tr class="border-b border-gray-700">
                            <td class="py-2 px-4"><?= $counter++; ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($row['name']); ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($row['description']); ?></td>
                            <td class="py-2 px-4">$<?= htmlspecialchars($row['price']); ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($row['quantity']); ?></td>
                            <td class="py-2 px-4">
                                <a href="crud/update.php?id=<?= $row['id']; ?>" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 transition">Edit</a> 
                                <a href="crud/delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700 transition">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
