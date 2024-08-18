<?php
require_once '../config/db.php';

class Product {
    private $conn;
    private $table = 'products';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}

$product = new Product();
$stmt = $product->read();

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>Price</th>
<th>Quantity</th>
<th>Actions</th>
</tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    echo "<tr>
    <td>{$id}</td>
    <td>{$name}</td>
    <td>{$description}</td>
    <td>{$price}</td>
    <td>{$quantity}</td>
    <td>
        <a href='update.php?id={$id}'>Edit</a> | 
        <a href='delete.php?id={$id}'>Delete</a>
    </td>
    </tr>";
}
echo "</table>";
?>
