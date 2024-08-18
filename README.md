# 📦 INVENTARY MANAGEMENT SYSTEM

![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%207.4-777bb3.svg?style=flat-square&logo=php&logoColor=white)
![PDO](https://img.shields.io/badge/PDO-Enabled-green.svg?style=flat-square)
![MySQL](https://img.shields.io/badge/MySQL-%3E%3D%205.7-4479A1.svg?style=flat-square&logo=mysql&logoColor=white)

## 📋 Overview

This project is a CRUD (Create, Read, Update, Delete) application built using **PHP Data Objects (PDO)** with **Object-Oriented Programming (OOP)** principles. The application manages a simple inventory system by interacting with a MySQL database, handling basic product information like name, description, price, and quantity.

## 🛠️ Features

- **Create**: Add new products to the inventory.
- **Read**: Display all products in a tabular format.
- **Update**: Edit product details.
- **Delete**: Remove products with a confirmation prompt.

## 📂 File Structure

```bash
.
├── config/
│   └── db.php           # Database connection file
├── crud/
│   ├── create.php       # Create product page
│   ├── delete.php       # Delete product page
│   ├── Product.php      # Product class with CRUD methods
│   ├── read.php         # Read products page
│   └── update.php       # Update product page
├── index.php            # Main page to list all products
└── README.md            # Project documentation (this file)
```

## 🗂️ Database Setup

### 1. Create Database

First, create a MySQL database named `inventory`:

```sql
CREATE DATABASE inventory;
```

### 2. Create `products` Table

Run the following SQL script to create the `products` table:

```sql
USE inventory;

CREATE TABLE `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10,2) NOT NULL,
    `quantity` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/zahidrahimoon/PHPOOP.git
cd PHPOOP
```

### 2. Setup Database Connection

Navigate to `config/db.php` and update the database credentials:

```php
<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'inventory';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
```

### 3. Run the Application

- Start your local server (e.g., using XAMPP, MAMP, or LAMP).
- Access the application by navigating to `http://localhost/PHPOOP/index.php` in your browser.

## 🔧 CRUD Operations

### Create

To add a new product:
- Navigate to `http://localhost/PHPOOP/crud/create.php`.
- Fill in the product details and submit the form.

### Read

To view all products:
- Navigate to `http://localhost/PHPOOP/index.php`.

### Update

To update a product:
- Click on the `Edit` button for the desired product on the main page.
- Make necessary changes and submit the form.

### Delete

To delete a product:
- Click on the `Delete` button for the desired product on the main page.
- Confirm the deletion to remove the product from the database.

## 🧩 Classes and Methods

### Database Class

- **Properties**:
  - `$host`: Database host.
  - `$db_name`: Database name.
  - `$username`: Database username.
  - `$password`: Database password.
  - `$conn`: Connection variable.

- **Methods**:
  - `connect()`: Establishes and returns the PDO connection.

### Product Class

- **Properties**:
  - `$id`: Product ID.
  - `$name`: Product name.
  - `$description`: Product description.
  - `$price`: Product price.
  - `$quantity`: Product quantity.

- **Methods**:
  - `create()`: Inserts a new product into the database.
  - `read()`: Fetches all products from the database.
  - `update()`: Updates the product information.
  - `delete()`: Deletes a product from the database.

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
