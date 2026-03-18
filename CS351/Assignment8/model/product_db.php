<?php
require('database.php');

// Return all products in a category
function get_products_by_category($category_id) {
    global $db;
    
    $query_prod_in_cat = 'SELECT *
        FROM products
        WHERE category_id = :category_id
        ORDER BY product_id';
    $statement = $db->prepare($query_prod_in_cat);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

// Return a product from the products table
function get_product($product_id) {
    global $db;
    
    $query_prod = 'SELECT * FROM products
        WHERE product_id = :product_id';
    $statement = $db->prepare($query_prod);
    $statement->bindValue(':product_id', $product_id);
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

// Remove product from products table
function delete_product($product_id) {
    global $db;
    
    $query_del = 'DELETE FROM products
            WHERE product_id = :product_id';
    $statement = $db->prepare($query_del);
    $statement->bindValue(':product_id', $product_id);
    $statement->closeCursor();
}

// Add product to products table
function add_product($category_id, $code, $name, $price) {
    global $db;
    
    $query_add = 'INSERT INTO products (category_id, product_id, product_name, list_price) VALUES
        : category_id, : code, : name, : price)';
    $statement = $db->prepare($query_add);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':product_id', $code);
    $statement->bindValue(':product_name', $name);
    $statement->bindValue(':list_price', $price);
    $statement->closeCursor();
}

?>

