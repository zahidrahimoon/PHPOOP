<?php
require_once 'Product.php';

$product = new Product();

if (isset($_GET['id'])) {
    $product->id = $_GET['id'];
    $productData = $product->read();

    if ($productData) {
        $product->name = $productData['name'];
        $product->description = $productData['description'];
        $product->price = $productData['price'];
        $product->quantity = $productData['quantity'];
    } else {
        echo "Product not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product->id = $_POST['id'];
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];
    $product->quantity = $_POST['quantity'];

    if ($product->update()) {
        echo "Product updated successfully!";
    } else {
        echo "Failed to update product.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">
<div class="flex items-center justify-center min-h-screen">
    <form method="POST" action="update.php?id=<?php echo $product->id; ?>" class="w-full max-w-lg bg-gray-800 p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-white">Update Product</h2>

        <input type="hidden" name="id" value="<?php echo $product->id; ?>">

        <label for="name" class="block text-gray-300 font-semibold mb-2">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product->name); ?>" required class="w-full px-4 py-2 mb-4 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-gray-400">

        <label for="description" class="block text-gray-300 font-semibold mb-2">Description:</label>
        <textarea name="description" required class="w-full px-4 py-2 mb-4 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-gray-400"><?php echo htmlspecialchars($product->description); ?></textarea>

        <label for="price" class="block text-gray-300 font-semibold mb-2">Price:</label>
        <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($product->price); ?>" required class="w-full px-4 py-2 mb-4 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-gray-400">

        <label for="quantity" class="block text-gray-300 font-semibold mb-2">Quantity:</label>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($product->quantity); ?>" required class="w-full px-4 py-2 mb-6 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-gray-400">

        <div class="flex justify-between">
            <input type="submit" value="Update Product" class="w-full bg-purple-500 text-white py-2 px-4 rounded-lg hover:bg-purple-600 transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-700 focus:ring-opacity-50">
            <a href="../index.php" class="w-full ml-4 bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-opacity-50 text-center">Back</a>
        </div>
    </form>
</div>

</body>
</html>
