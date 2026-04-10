<?php
// Enable error reporting (remove or comment out for production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'includes/book-utilities.inc.php';

// Set file paths
$customerFile = 'data/customers.txt';
$orderFile = 'data/orders.txt';

// Read customer data into an array
$customers = readCustomers($customerFile);

// Check if a customer is selected via the query string
$selectedCustomer = null;
$customerOrders = [];

if (isset($_GET['customer_id'])) {
    $id = $_GET['customer_id'];
    foreach ($customers as $cust) {
        if ($cust['id'] == $id) {
            $selectedCustomer = $cust;
            // Read matching order data for the selected customer[cite: 1, 3]
            $customerOrders = readOrders($id, $orderFile);
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CISC3003 Suggested Exercise 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">
    <link rel="stylesheet" href="css/material.min.css">
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            <div class="mdl-grid">

              <!-- Left Side: Customers List Card -->
              <div class="mdl-cell mdl-cell--7-col card-lesson mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Customers</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table mdl-shadow--2dp">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">Name</th>
                          <th class="mdl-data-table__cell--non-numeric">University</th>
                          <th class="mdl-data-table__cell--non-numeric">City</th>
                          <th>Sales</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Loop through the customers array[cite: 1] -->
                        <?php foreach ($customers as $c): ?>
                        <tr>
                          <td class="mdl-data-table__cell--non-numeric">
                            <!-- Link back to the page with the customer id as a query string[cite: 1] -->
                            <a href="cisc3003-sugex10-after.php?customer_id=<?php echo $c['id']; ?>">
                                <?php echo $c['first'] . " " . $c['last']; ?>
                            </a>
                          </td>
                          <td class="mdl-data-table__cell--non-numeric"><?php echo $c['university']; ?></td>
                          <td class="mdl-data-table__cell--non-numeric"><?php echo $c['city']; ?></td>
                          <!-- Apply the class for the sparklines inline bar chart[cite: 1] -->
                          <td><span class="inlinesparkline"><?php echo $c['sales']; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                </div>
              </div> 

              <!-- Right Side Grid: Customer Details and Orders -->
              <div class="mdl-grid mdl-cell--5-col">
    
                  <!-- Customer Details Card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Customer Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <?php if ($selectedCustomer): ?>
                            <h4><?php echo $selectedCustomer['first'] . " " . $selectedCustomer['last']; ?></h4>
                            <p><?php echo $selectedCustomer['email']; ?></p>
                            <p><?php echo $selectedCustomer['university']; ?></p>
                            <p><?php echo $selectedCustomer['address'].', '.$selectedCustomer['city'].', '.$selectedCustomer['country']; ?></p>
                        <?php else: ?>
                            <h4>Select a customer to view details.</h4>
                        <?php endif; ?>
                    </div>    
                  </div>

                  <!-- Order Details Card -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Order Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">       
                        <?php if ($selectedCustomer): ?>
                            <?php if (count($customerOrders) > 0): ?>
                                <!-- Display orders if they exist for the requested customer[cite: 1] -->
                                <table class="mdl-data-table mdl-shadow--2dp">
                                  <thead>
                                    <tr>
                                      <th class="mdl-data-table__cell--non-numeric">Cover</th>
                                      <th class="mdl-data-table__cell--non-numeric">ISBN</th>
                                      <th class="mdl-data-table__cell--non-numeric">Title</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($customerOrders as $order): ?>
                                    <tr>
                                      <td class="mdl-data-table__cell--non-numeric">
                                          <img src="images/tinysquare/<?php echo $order['isbn']; ?>.jpg" alt="cover">
                                      </td>
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo $order['isbn']; ?></td>
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo $order['title']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                            <?php else: ?>
                                <!-- Display message when there is no order information[cite: 1] -->
                                <p>No orders for this customer.</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>    
                   </div>             
               </div>   
            </div>    
        </section>
    </main>    
</div>

<script>
$(function() {
    // Generate the inline bar chart using sparklines.js
    $('.inlinesparkline').sparkline('html', {
        type: 'bar', 
        barColor: '#1976D2', 
        height: '24px',
        barWidth: 4
    });
});
</script>
<footer>
        <p>CISC3003 Web Programming: DC227352 URIEL WULI 2026</p>
    </footer>
</body>
</html>