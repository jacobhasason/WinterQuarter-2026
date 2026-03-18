<!DOCTYPE html>
<!--

-->
<!-- PRODUCTS / GUITARS -->
<!-- No Classes Allowed -->

<html>
    <head>
        <title>Guitars</title>
        
        <link rel ="stylesheet" href ="./styles/main.css">
        <link rel ="stylesheet" href ="./styles/guitars.css">
        <link rel="stylesheet" href="./styles/jquery.bxslider.css">
    </head>

    <body>
        <!-- Header -->
        <?php include('./view/header.php'); ?>


        <!-- Horizontal Navigation -->
        <?php include('./view/horizontal_nav_bar.php'); ?>


        <main>
            
            <section>
                <!-- Images -->
                <h2> Our Guitars </h2>
                <p> Check out our fine selection of premium guitars </p>
                <div id = "images"> 
                    <div><img src="./images/guitars/Caballero11.png" title="Caballero 11" alt="Caballero 11"></div>
                    <div><img src="./images/guitars/FenderStratocaster.png" title="Fender Stratocaster" alt="Fender Stratocaster"></div>
                    <div><img src="./images/guitars/GibsonLesPaul.png" title="Gibson Les Paul" alt="Gibson Les Paul"></div>
                    <div><img src="./images/guitars/GibsonSB.png" title="Gibson SB" alt="Gibson SB"></div>
                    <div><img src="./images/guitars/WashburnD10S.png" title="Washburn D10S" alt="Washburn D10S"></div>
                    <div><img src="./images/guitars/YamahaFG700S.png" title="Yamaha FG700S" alt="Yamaha FG700S"></div>
                </div> 
      
                <p id = "page"> </p>
            </section>
            
            <!-- Vertical Navigation -->
            <?php include('./view/aside.php'); ?>
        </main>
        
            <?php include('./view/footer.php'); ?>

        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="./scripts/jquery.bxslider.js"></script>
        <script src="./scripts/date.js"></script>
        <script src="./scripts/guitars.js"></script>
    </body>
     
</html>