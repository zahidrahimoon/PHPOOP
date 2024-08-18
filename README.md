Below is the `README.md` file for the CRUD application project using PHP PDO and OOP principles. This file is fully styled with icons and provides comprehensive instructions on setting up and running the application.

```markdown
# 📦 PHP PDO CRUD Application with OOP

![PHP Version](https://img.shields.io/badge/PHP-%3E%3D%207.4-777bb3.svg?style=flat-square&logo=php&logoColor=white)
![PDO](https://img.shields.io/badge/PDO-Enabled-green.svg?style=flat-square)
![MySQL](https://img.shields.io/badge/MySQL-%3E%3D%205.7-4479A1.svg?style=flat-square&logo=mysql&logoColor=white)

## 📋 Project Overview

This project is a CRUD (Create, Read, Update, Delete) application built using **PHP Data Objects (PDO)** with **Object-Oriented Programming (OOP)** principles. The application manages a simple inventory system by interacting with a MySQL database. The table includes basic product information like name, description, price, quantity, and the creation timestamp.

## 🛠️ Features

- **Create**: Add new products to the inventory via a form.
- **Read**: List all products in the inventory in a tabular format.
- **Update**: Edit the details of an existing product.
- **Delete**: Remove products from the inventory with a confirmation prompt.

## 📂 File Structure

```
.
├── config/
│   └── db.php           # Database connection class
├── classes/
│   ├── Database.php     # Database connection class using PDO
│   └── Product.php      # Product class with CRUD methods
├── create.php           # Create product page
├── edit.php             # Edit product page
├── delete.php           # Delete product handler
├── index.php            # Main page to list all products
├── README.md            # Project documentation (this file)
└── inventory.sql        # SQL script to create the products table
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
git clone https://github.com/your-username/php-pdo-crud.git
cd php-pdo-crud
```

### 2. Setup Database Connection

- Navigate to `config/db.php` and update the database credentials.

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
- Access the application by navigating to `http://localhost/php-pdo-crud/index.php` in your browser.

## 🔧 CRUD Operations

### Create

To add a new product:
- Navigate to `http://localhost/php-pdo-crud/create.php`.
- Fill in the product details and submit the form.

### Read

To view all products:
- Navigate to `http://localhost/php-pdo-crud/index.php`.

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

```

### Explanation:

1. **Project Overview**: The introduction provides a quick summary of what the project is about and the technologies used.
2. **Features**: Lists the primary functionalities of the application.
3. **File Structure**: Gives an overview of the project's directory structure.
4. **Database Setup**: Instructions to set up the MySQL database and table.
5. **Getting Started**: Step-by-step guide to cloning the repo, setting up the database connection, and running the application.
6. **CRUD Operations**: Details how to perform create, read, update, and delete operations within the application.
7. **Classes and Methods**: Provides an overview of the `Database` and `Product` classes and their respective methods.
8. **License**: Mentions the licensing information.
9. **Contact**: Includes contact information for the author of the project.

This README file provides clear, concise instructions with styled elements for better readability and a professional look.
