<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->

<!-- SUPPORT  PAGE -->
<!-- NO CLASSES ALLOWED -->

<html>
    <head>
        <title> Support </title>
        <link rel = "stylesheet" href ="./styles/main.css">
        <link rel = "stylesheet" href ="./styles/support.css">
        <link rel = "stylesheet" href ="./styles/jquery-ui.min.css">
    </head>

    <body>

        <?php include('./view/header.php'); ?>

        <!-- Horizontal Navigation -->
        <?php include('./view/horizontal_nav_bar.php'); ?>



        <main>

            <section>
                
                <h2>Frequently Asked Questions</h2>
                
                <div id="accordion">
                    <h3>My guitar is broken. Can you fix it? </h3>
                    <div> 
                        <p> We sure hope so. Sometimes there is damage that is beyond repair or the work just wouldn't be cost effective, but that doesn't happen too often. Bring that ailing axe in to your nearest Guitar Store location and our repair experts will do a free evaluation and let you know. </p>
                    </div>

                    <h3> What kinds of repairs do you do? </h3>
                    <div> 
                        <p> We can do everything from restringing, tune up and maintenance to electrical repair, hardware repair, structural repair and more. </p>
                    </div>

                    <h3> Do you perform vendor warranty repairs on new instruments? </h3>
                    <div>
                        <p> Yes. Guitar Store Repairs offers vendor warranty service and Pro Coverage service for many brands in most of our locations. Please contact your nearest Guitar Store Repairs technician to find out more. </p>
                    </div>

                    <h3> Do temperature and humidity affect my instrument? </h3>
                    <div> 
                        <p> Unless it's made of graphite, environmental factors definitely make a difference. Depending on where you live, the severity of the effects varies. Extremes of temperature or humidity, as well as drastic shifts between extremes, will take more of a toll and require more frequent setups. </p>
                    </div>

                    <h3> How can I prolong the life of my instrument? </h3>
                    <div> 
                        <p> It's all about maintenance. From rehearsal to gig night, the world is a dangerous place and no guitar is safe. If you want your instrument alive and kicking for years to come, regular setups and professional repairs are a must. </p>
                    </div>
                </div>

            </section>

            <!-- Vertical Navigation -->
            <?php include('./view/aside.php'); ?>

        </main>

        <?php include('./view/footer.php'); ?>
        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js" integrity="sha512-MSOo1aY+3pXCOCdGAYoBZ6YGI0aragoQsg1mKKBHXCYPIWxamwOE7Drh+N5CPgGI5SA9IEKJiPjdfqWFWmZtRA==" crossorigin="anonymous"></script>
        
        <script src="./scripts/jquery-ui.min.js"></script> 
        <script src="./scripts/date.js"></script> 
        <script src="./scripts/support.js"></script> 
    </body>    
</html>
