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
        <link rel = "stylesheet" href ="../styles/main.css">
        <link rel = "stylesheet" href ="../styles/shipping.css">
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
            <aside> 
                <ul>
                    <li> <a href ="../products/guitars/index.php"> Guitars </a> </li>
                    <li> <a href ="../products/basses/index.php"> Basses </a> </li>
                    <li> <a href ="../products/drums/index.php"> Drums </a> </li>
                    <li> <a href ="../products/keyboards/index.php"> Keyboards </a> </li>  
                </ul>
            </aside>



        </main>

        
        <footer> 
            <div>
                &copy 2023 The Guitar Shop 
            </div>
            <div> 
            
            </div>
        </footer>
        
        <script src="../scripts/shipping.js"></script>
        <script src="../scripts/date.js"></script> 

    </body>
</html>
