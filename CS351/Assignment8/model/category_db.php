<?php
require_once('database.php');

// Grabs all cateogires
function get_categories() {
    global $db;
    
    $query_all_cats = 'SELECT *
        FROM categories
        ORDER BY category_id';
    $statement = $db->prepare($query_all_cats);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    return $categories;
}

// Returns the current category
function get_category_name($category_id) {
    global $db;
    
    $query_cat_name = 'SELECT *
        FROM categories
        WHERE category_id = :category_id';
    $statement = $db->prepare($query_cat_name);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();

    $current_category = $statement->fetch();

    $statement->closeCursor();
    return $current_category;
}

?>
