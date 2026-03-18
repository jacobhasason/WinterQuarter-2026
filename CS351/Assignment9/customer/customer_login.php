<?php

?>
<html lang="en">
    <head>
        <title> The Guitar Store </title>
        <link rel = "stylesheet" href ="./styles/main.css">
        <link rel = "stylesheet" href ="./styles/customer_login.css">
    </head>

    <body>
        <!-- Header -->
        <?php include('./view/header.php'); ?>

        <!-- Horizontal Navigation -->
        <?php include('./view/horizontal_nav_bar.php'); ?>



        <main>
            <section>
                <form method="post">
                    <h2> Customer Login </h2>
                    <p> Email Address:  <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>"> </p>
                    
                    <input type="hidden" name="action" value="customer_page">
                    
                    <input type="submit" id="submit" name="submit" value="Submit">
                </form>
            </section>

            <!-- Vertical Navigation -->
            <?php include('./view/aside.php'); ?>

        </main>

        <?php include('./view/footer.php'); ?>

        <script src="/Assignment9/scripts/customer_login.js"></script> 
    </body>


