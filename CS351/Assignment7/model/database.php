<?php
    // Create DB instnace
    $dsn =  'mysql:host=localhost;dbname=my_guitar_shop'; //TODO get dsn
    $username = 'CS351user';
    $password = '';
    
    // Try to connect to database
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (Exception $ex) {
        // Print execption on database_error page
        include('../view/database_error.php');
        exit();
    }
    
?>


