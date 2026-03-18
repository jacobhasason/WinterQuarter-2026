<?php
require('database.php');


function get_customer_info($customer_id) {
     global $db;
     
     $query_cust_info = 'SELECT *
                         FROM customers
                         WHERE customer_id = :customer_id';
     
    $statement = $db->prepare($query_cust_info);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $customer_info = $statement->fetch();
    $statement->closeCursor();
    return $customer_info;
}


function get_customer_info_by_email($email_address) {
     global $db;
     
     $query_cust_info = 'SELECT *
                         FROM customers
                         WHERE email_address = :email_address';
     
    $statement = $db->prepare($query_cust_info);
    $statement->bindValue(':email_address', $email_address);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}


function update_first_name($customer_id, $first_name) {
    global $db;
    
    $query_fname_change = 'UPDATE customers
                           SET first_name = :first_name
                           WHERE customer_id = :customer_id';
    
    $statement = $db->prepare($query_fname_change);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $statement->closeCursor();                       
}


function update_last_name($customer_id, $last_name) {
    global $db;
    
    $query_lname_change = 'UPDATE customers
                           SET last_name = :last_name
                           WHERE customer_id = :customer_id';
    
    $statement = $db->prepare($query_lname_change);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $statement->closeCursor();                       
}


function update_email_address($customer_id, $email_address) {
     global $db;
    
    $query_email_change = 'UPDATE customers
                           SET email_address = :email_address
                           WHERE customer_id = :customer_id';
    
    $statement = $db->prepare($query_email_change);
    $statement->bindValue(':email_address', $email_address);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $statement->closeCursor(); 
}


function update_password($customer_id, $password) {
     global $db;
    
    $query_password_change = 'UPDATE customers
                           SET password = :password
                           WHERE customer_id = :customer_id';
    
    $statement = $db->prepare($query_password_change);
    $statement->bindValue(':password ', $password);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $statement->closeCursor(); 
}

?>
