<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->

<!-- Shipping HTML page -->
<!-- NO CLASSES OR IDS ALLOWED IN FOOTER -->


<html>
    <head>
        <title> Shipping </title>
        <link rel = "stylesheet" href ="./styles/main.css">
        <link rel = "stylesheet" href ="./styles/shipping.css">
    </head>

    <body>
        <?php include('./view/header.php'); ?>

        <!-- Horizontal Navigation -->
        <?php include('./view/horizontal_nav_bar.php'); ?>

        <main>

            <section>
                <h2>Shipping Costs</h2>
                <div>
                    <label for="product">Enter the cost of the product:</label>
                    <input type="text" id="product" name="product" title="Enter product cost here">

                    <input type="button" id="calculate" name="calculate" value="Calculate">
                </div>

                <div>    
                    <label for="totalCost">Total cost, including shipping:</label>
                    <input type="text" id="totalCost" name="totalCost" readonly>    
                </div>


            </section>

            <!-- Vertical Navigation -->
            <?php include('./view/aside.php'); ?>



        </main>

        
        <?php include('./view/footer.php'); ?>
        
        <script src="./scripts/shipping.js"></script>
        <script src="./scripts/date.js"></script> 

    </body>
</html>
