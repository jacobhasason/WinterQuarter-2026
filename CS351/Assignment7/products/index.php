<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<?php
require("../model/database.php");

$category_id = filter_input(INPUT_POST, 'category_id');

if(empty($category_id)) {
   $category_id = filter_input(INPUT_GET, 'category_id');
}

if(empty($category_id)) {
   $category_id = 1;
}

$query_cat_name = 'SELECT *
FROM categories
WHERE category_id = :category_id';
$statement1 = $db -> prepare($query_cat_name);
$statement1 -> bindValue(':category_id', $category_id);
$statement1 -> execute();

$current_category = $statement1->fetch();

$statement1-> closeCursor();

$query_all_cats = 'SELECT *
FROM categories
ORDER BY category_id';
$statement2 = $db -> prepare($query_all_cats);
$statement2 -> execute();
$categories = $statement2->fetchAll();
$statement2-> closeCursor();

$query_prod_in_cat = 'SELECT *
FROM products
WHERE category_id = :category_id
ORDER BY product_id';
$statement3 = $db -> prepare($query_prod_in_cat);
$statement3 -> bindValue(':category_id', $category_id);
$statement3 -> execute();
$products = $statement3->fetchAll();
$statement3-> closeCursor();
?>

<html lang="en">
    <head>
        <title> The Guitar Store </title>
        <link rel = "stylesheet" href ="../styles/main.css">
        <link rel = "stylesheet" href ="../styles/products.css">
    </head>

<body>
    <header>
        <img src ="../images/misc/FenderStratocasterHeader.png" alt ="Fender Stratocaster">
        <h2> The Guitar Store </h2>
        <h3> For rock stars everywhere! </h3>
    </header>

    <!-- Horizontal Navigation -->
    <nav>
        <ul>
            <li> <a href ="../index.php"> Home </a> </li>
            <li> <a href ="../lessons/index.php"> Lessons </a> </li>
            <li> <a href ="../products/index.php"> Products </a> </li>
            <li> <a href ="../support/index.php"> Support </a>
            <li> <a href ="../shipping/index.php"> Shipping </a> 
            <li>
            <a href ="../contact/index.php"> Contact Us </a> 
                <ul> 
                    <li> <a href ="../contact/email.php"> Email </a> </li>
                    <li> <a href ="../contact/phone.php"> Phone </a> </li>
                    <li> <a href ="../contact/phone.php"> Chat </a> </li>
                </ul>
            </li>
        </ul>
    </nav>



    <main>

        <section>
            <h2> Products List </h2>
                
            <!-- Choose Category -->
            <form action ="index.php" method="post">
                <label for="category_id"> Category:</label>
                
                <select name="category_id" id="category_id">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['category_id'] ?>"
                        <?= ($category['category_id'] == $current_category['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                        
                <button type="submit">Choose</button>
            </form>
                    
            <!-- Current Category -->           
            <h3> <?= htmlspecialchars($current_category['category_name']) ?> </h3>
            
            <!-- Products Table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="right"> List Price </th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach ($products as $product) : ?>
                    <tr>
                        <!-- Listing -->
                        <td> <?= $product['product_id'] ?> </td>
                        <td> <?= htmlspecialchars($product['product_name']) ?> </td>
                        <td class ="right"><?= number_format($product['list_price'], 2) ?> </td>
                        
                        <!-- Edit Button -->
                        <td>
                            <form action="edit_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <input type="hidden" name="category_id" value="<?= $current_category['category_id'] ?>">
                                <button type="submit">Edit</button>
                            </form>
                        </td>
                        
                        <td>
                            <form action="delete_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <input type="hidden" name="category_id" value="<?= $current_category['category_id'] ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Product Link -->
            <p>
                <a href="add_product.php"> Add Product</a>
            </p>
            
        </section>

        <!-- Vertical Navigation -->
        <aside> 
            <ul>
                <li> <a href ="guitars/index.php"> Guitars </a> </li>
                <li> <a href ="basses/index.php"> Basses </a> </li>
                <li> <a href ="drums/index.php"> Drums </a> </li>
                <li> <a href ="keyboards/index.php"> Keyboards </a> </li>  
            </ul>
        </aside>
    </main>

<footer>
    <div> &copy 2023 The Guitar Shop </div> 
    <div> </div>
    
</footer> 
    
    <script src="./scripts/date.js"></script> 
</body>


</html>
