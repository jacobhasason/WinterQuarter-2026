<!DOCTYPE html>

<?php
require_once('./model/category_db.php');

?>

<html lang="en">
    <head>
        <title> The Guitar Store </title>
        <link rel = "stylesheet" href ="./styles/main.css">
        <link rel = "stylesheet" href ="./styles/products.css">
    </head>

<body>
    <!-- Header -->
     <?php include('./view/header.php'); ?>


    <!-- Horizontal Navigation -->
    <?php include('./view/horizontal_nav_bar.php'); ?>

    <main>

        <section>
            <h2> Products List </h2>
                
            <!-- Choose Category -->
            <form action ="index.php" method="get">
                <input type ="hidden" name="action" value="products">
                
                <select name="category_id" id="category_id">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['category_id'] ?>"
                        <?= ($category['category_id'] == $current_category['category_id']) ? 'selected' : '' ?>>
                        <?= $category['category_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                        
                <button type="submit">Choose</button>
            </form>
                    
            <!-- Current Category -->           
            <h3> <?= $current_category['category_name'] ?> </h3>
            
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
                            <form action="./index.php" method="post">
                                <input type="hidden" name="action" value="edit_product">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <input type="hidden" name="category_id" value="<?= $current_category['category_id'] ?>">
                                <button type="submit">Edit</button>
                            </form>
                        </td>
                        
                        <!-- Delete Button -->
                        <td>
                            <form action="./index.php" method="post">
                                <input type="hidden" name="action" value="delete_product">
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
                <a href="./index.php?action=add_product"> Add Product</a>
            </p>
            
        </section>

        <!-- Vertical Navigation -->
        <?php include('./view/aside.php'); ?>

    </main>

    <?php include('./view/footer.php'); ?>

    
    <script src="./scripts/date.js"></script> 
</body>


</html>
