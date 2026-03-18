<?php

session_start();

require_once('model/category_db.php');
require_once('model/product_db.php');
require_once('model/address_db.php');
require('model/customer_db.php');

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

if ($action == NULL) {
    $action = 'customer_login';
}

$email_regex = '/^(?!.*\.\.)[A-Za-z0-9](?:[A-Za-z0-9._%+-]{0,62}[A-Za-z0-9])?@[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?(?:\.[A-Za-z]{2,})+$/';

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
        $email_address = '';
        $login_error = false;
        include('customer/customer_login.php');
        break;

    case 'customer_page':
        $email_address = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if ($email_address === null) {
            $email_address = '';
        }

        if ($email_address === '' || !preg_match($email_regex, $email_address)) {
            $login_error = true;
            include('customer/customer_login.php');
            echo 'Not a valid email address!';
            break;
        }

        $customer = get_customer_info_by_email($email_address);

        if (!$customer) {
            $login_error = true;
            include('customer/customer_login.php');
            echo 'Not a listed customer!';
            break;
        }

        $customer_id = $customer['customer_id'];
        $billing_address = get_address($customer['billing_address_id']);
        $shipping_address = get_address($customer['shipping_address_id']);
        $states = get_states();
        $message = '';

        include('customer/customer.php');
        break;

    case 'update_customer_info':
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email_address = filter_input(INPUT_POST, 'email_address', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

        $customer = get_customer_info($customer_id);

        if ($customer['first_name'] !== $first_name) {
            update_first_name($customer_id, $first_name);
        }
        if ($customer['last_name'] !== $last_name) {
            update_last_name($customer_id, $last_name);
        }
        if ($customer['email_address'] !== $email_address) {
            update_email_address($customer_id, $email_address);
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        update_password($customer_id, $hashed_password);

        $billing_address = get_address($customer['billing_address_id']);
        $shipping_address = get_address($customer['shipping_address_id']);
        $states = get_states();
       

        include('customer/customer.php');
        break;

    case 'update_billing_address':
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $address_id = filter_input(INPUT_POST, 'billing_address_id', FILTER_VALIDATE_INT);

        $line1 = filter_input(INPUT_POST, 'bill_line1', FILTER_SANITIZE_SPECIAL_CHARS);
        $line2 = filter_input(INPUT_POST, 'bill_line2', FILTER_SANITIZE_SPECIAL_CHARS);
        $city = filter_input(INPUT_POST, 'bill_city', FILTER_SANITIZE_SPECIAL_CHARS);
        $state = filter_input(INPUT_POST, 'bill_state', FILTER_SANITIZE_SPECIAL_CHARS);
        $zip_code = filter_input(INPUT_POST, 'bill_zip_code', FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'bill_phone', FILTER_SANITIZE_SPECIAL_CHARS);

        update_address($address_id, $line1, $line2, $city, $state, $zip_code, $phone);

        $customer = get_customer_info($customer_id);
        $billing_address = get_address($customer['billing_address_id']);
        $shipping_address = get_address($customer['shipping_address_id']);
        $states = get_states();
        $message = 'Billing address updated';

        include('customer/customer.php');
        break;

    case 'update_shipping_address':
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $address_id = filter_input(INPUT_POST, 'shipping_address_id', FILTER_VALIDATE_INT);

        $line1 = filter_input(INPUT_POST, 'ship_line1', FILTER_SANITIZE_SPECIAL_CHARS);
        $line2 = filter_input(INPUT_POST, 'ship_line2', FILTER_SANITIZE_SPECIAL_CHARS);
        $city = filter_input(INPUT_POST, 'ship_city', FILTER_SANITIZE_SPECIAL_CHARS);
        $state = filter_input(INPUT_POST, 'ship_state', FILTER_SANITIZE_SPECIAL_CHARS);
        $zip_code = filter_input(INPUT_POST, 'ship_zip_code', FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'ship_phone', FILTER_SANITIZE_SPECIAL_CHARS);

        update_address($address_id, $line1, $line2, $city, $state, $zip_code, $phone);

        $customer = get_customer_info($customer_id);
        $billing_address = get_address($customer['billing_address_id']);
        $shipping_address = get_address($customer['shipping_address_id']);
        $states = get_states();
        $message = 'Shipping address updated';

        include('customer/customer.php');
        break;

    default:
        $email_address = '';
        $login_error = false;
        include('customer/customer_login.php');
        break;
}
?>


