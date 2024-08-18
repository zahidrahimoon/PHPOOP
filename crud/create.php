<?php
require_once '../config/db.php';

class Product {
    private $conn;
    private $table = 'products';

    public $name;
    public $description;
    public $price;
    public $quantity;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (name, description, price, quantity) VALUES (:name, :description, :price, :quantity)';
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        // Bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':quantity', $this->quantity);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product();
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];
    $product->quantity = $_POST['quantity'];

    if ($product->create()) {
        $message = "Product created successfully!";
    } else {
        $message = "Failed to create product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-gray-800 p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Add New Product</h2>

        <?php if (!empty($message)): ?>
            <script>
                alert("<?php echo $message; ?>");
            </script>
        <?php endif; ?>

        <form method="POST" action="create.php">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300">Name:</label>
                <input type="text" name="name" class="mt-1 p-2 w-full bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-300">Description:</label>
                <textarea name="description" class="mt-1 p-2 w-full bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" required></textarea>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-300">Price:</label>
                <input type="number" name="price" step="0.01" class="mt-1 p-2 w-full bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>
            <div class="mb-6">
                <label for="quantity" class="block text-sm font-medium text-gray-300">Quantity:</label>
                <input type="number" name="quantity" class="mt-1 p-2 w-full bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>
            <div class="flex justify-between">
                <a href="../index.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition">Back</a>
                <input type="submit" value="Add Product" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-800 transition cursor-pointer">
            </div>
        </form>
    </div>

</body>
</html>
