<?php
$host = 'localhost';
$dbname = 'travel_translator';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create tables if they don't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS saved_phrases (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        original_text TEXT NOT NULL,
        translated_text TEXT NOT NULL,
        language_from VARCHAR(10) NOT NULL,
        language_to VARCHAR(10) NOT NULL,
        category VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");
    
    $pdo->exec("CREATE TABLE IF NOT EXISTS phrase_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        context VARCHAR(50) NOT NULL
    )");
    
    // Insert default categories if empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM phrase_categories");
    if ($stmt->fetchColumn() == 0) {
        $categories = [
            ['Airport', 'travel'],
            ['Restaurant', 'dining'],
            ['Hotel', 'accommodation'],
            ['Transportation', 'travel'],
            ['Shopping', 'commerce'],
            ['Emergency', 'safety'],
            ['Medical', 'health'],
            ['Directions', 'navigation']
        ];
        
        $insert = $pdo->prepare("INSERT INTO phrase_categories (name, context) VALUES (?, ?)");
        foreach ($categories as $category) {
            $insert->execute($category);
        }
    }
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>