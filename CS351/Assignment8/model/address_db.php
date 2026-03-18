<?php
require('database.php');

function get_address($address_id) {
     global $db;
     
     $query_address =   'SELECT *
                         FROM customers
                         WHERE customer_id = :customer_id';
     
    $statement = $db->prepare($query_address);
    $statement->bindValue(':address_id', $address_id);
    $statement->execute();
    $customer_info = $statement->fetchAll();
    $statement->closeCursor();
    return $customer_info;
}