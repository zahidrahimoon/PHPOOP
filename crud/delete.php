<?php
require_once '../config/db.php';

class Product {
    private $conn;
    private $table = 'products';

    public $id;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameter
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}

// Handle deletion
$message = '';
if (isset($_GET['id'])) {
    $product = new Product();
    $product->id = $_GET['id'];

    if ($product->delete()) {
        $message = "Product deleted successfully!";
    } else {
        $message = "Failed to delete product.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Google Fonts: Playfair Display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 font-playfair text-white">

<div class="flex items-center justify-center min-h-screen">
    <div class="max-w-lg w-full bg-gray-800 p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-red-500">Delete Product</h2>

        <?php if ($message): ?>
            <div class="p-4 mb-4 text-center rounded-lg <?php echo ($message == 'Product deleted successfully!') ? 'bg-green-500 text-white' : 'bg-red-500 text-white'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mt-6">
            <a href="../index.php" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50">
                Back to Home
            </a>
        </div>
    </div>
</div>

</body>
</html>
