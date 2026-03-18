<?php
require_once('model/category_db.php');
require_once('model/product_db.php');

if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}

$categories = get_categories();

$current_category = get_category_name($category_id);

$products = get_products_by_category($category_id);

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
}

switch ($action) {
    case 'products':        
        include('products/product_list.php');
        break;
    case 'shipping':
        include('shipping.php');
        break;
    case 'support':
        include('support.php');
        break;
    case 'guitars':
        include('products/guitars.php');
        break;
    case 'customer_login':
        include('customer/customer_login.php');
        break;
    case 'customer_page':
        //if(emailvalid) {
        include('customer/customer.php');
        // }else{
        // include('customer/customer_login.php');
    case 'update_customer_info':
        // TODO Hash Password
        // TODO Update customer information that changed
        include('customer/customer.php');
    case 'update_billing_address':
        // TODO Update Complete billing address
        include('customer/customer.php');
    case 'update_shipping_address':
        // TODO Update Complete shipping address
        include('customer/customer.php');
    default:
        include('home.php');
        break;
}



?>


