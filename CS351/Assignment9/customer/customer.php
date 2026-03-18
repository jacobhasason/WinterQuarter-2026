<?php 

?>

<html lang="en">
    <head>
        <title> The Guitar Store </title>
        <link rel = "stylesheet" href ="./styles/customer.css">
        <link rel = "stylesheet" href ="./styles/main.css">
    </head>

    <body>
        <!-- Header -->
        <?php include('./view/header.php'); ?>

        <!-- Horizontal Navigation -->
        <?php include('./view/horizontal_nav_bar.php'); ?>


        <main>
            <section>
                <table>
                    <tr>
                        <td colspan="2">
                            <!-- Customer -->
                            <fieldset id="customer_field">
                                <legend> Customer Information </legend>
                                <form method="post">
                                    <input type="hidden" name="customer_id" value="<?php echo $customer['customer_id']; ?>">
                                    <p> First Name: <input type="text" id="first_name" name="first_name"> </p>
                                    <p> Last Name: <input type="text" id="last_name" name="last_name"> </p>
                                    <p> Email: <input type="text" id="email_address" name="email_address"> </p>
                                    <p> Password: <input type="password" id="password" name="password"> </p>
                                    <p> Confirm Password: <input type="password" id="confirm_password" name="confirm_password"> </p>
                                    <input type="button" id="update_cust" name="update_cust" value ="Update Customer Information" action="update_customer_info">
                                </form>
                            </fieldset>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <!-- Billing -->
                            <fieldset id="billing_field">
                                <legend> Billing Address </legend>
                                <form method="post">
                                    <input type="hidden" name="customer_id" value=""<?php echo $customer['customer_id']; ?>">
                                    <p> Address Line 1: <input type="text" id="bill_line1" name="bill_addr1" > </p>
                                    <p> Address Line 2: <input type="text" id="bill_line2" name="bill_addr2" > </p>
                                    <p> City: <input type="text" id="bill_city" name="bill_city" > </p>
                                    <p> State: <select name = "bill_state" id="bill_state">
                                            <?php
                                            foreach ($states as $state) : ?>
                                                <option value="<?php echo $state['state']; ?>"
                                                <?php if ($state == $state['state']) {
                                                    echo 'selected'; 
                                                } ?>>
                                                <?php echo $state['state']; ?>
                                                </option> 
                                        <?php endforeach; ?>
                                        </select> </p>
                                    <p> Zip Code: <input type="text" id="bill_zip" name="bill_zip"> </p>
                                    <p> Phone: <input type="text" id="bill_phone" name="bill_phone"> </p>
                                    <input type="submit" id="update_bill" name="update_bill" value ="Update Billing Address" action="update_billing_address">
                                </form>
                            </fieldset>
                        </td>

                        <td>
                            <!-- Shipping -->
                            <fieldset id="shipping_field">
                                <legend> Shipping Address </legend>
                                <form method="post">
                                    <p> Address Line 1: <input type="text" id="ship_line1" name="ship_addr1"> </p>
                                    <p> Address Line 2: <input type="text" id="ship_line2" name="ship_addr2" > </p>
                                    <p> City: <input type="text" id="ship_city" name="ship_city"> </p>
                                    <p> State: <select name = "ship_state" id="ship_state">
                                            <?php
                                            foreach ($states as $state) : ?>
                                                <option value="<?php echo $state['state']; ?>"
                                                <?php if ($state == $state['state']) {
                                                    echo 'selected'; 
                                                } ?>>
                                                <?php echo $state['state']; ?>
                                                </option> 
                                        <?php endforeach; ?>
                                        </select> </p>
                                    <p> Zip Code: <input type="text" id="ship_zip" name="ship_zip"> </p>
                                    <p> Phone:<input type="text" id="ship_phone" name="ship_phone"> </p>
                                    <input type="submit" id="update_ship" name="update_ship" value ="Update Billing Address" action="update_shipping_address">
                                </form>
                            </fieldset>
                        </td>
                    </tr>
                </table>
            </section>
            <!-- Vertical Navigation -->
<?php include('./view/aside.php'); ?>

        </main>

<?php include('./view/footer.php'); ?>

        <script src="./scripts/customers.js"></script> 
    </body>

