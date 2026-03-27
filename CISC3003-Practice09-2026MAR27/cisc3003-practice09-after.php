<?php
include 'data.inc.php';
include 'functions.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CISC3003 Practice 09</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php include 'header.inc.php'; ?>
<?php include 'left.inc.php'; ?>

<main>
    <header class="main-header">
        <h2>Order Summaries</h2>
        <p>Examine your customer orders</p>
    </header>

    <section>
        <div class="orders-container">
            <!-- My Orders -->
            <div class="my-orders">
                <div><h3>My Orders</h3></div>
                <div>
                    <ul>
                        <?php foreach ($orders as $order): ?>
                            <li><a href="#"><?php echo $order; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Selected Order -->
            <div class="selected-order">
                <div><h3>Selected Order: #520</h3></div>
                <div>
                    <table>
                        <caption>Customer: <strong>Mount Royal University</strong></caption>
                        <thead>
                            <tr>
                                <th>Cover</th>
                                <th>Title</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                outputOrderRow($file1, $product1, $quantity1, $price1);
                                outputOrderRow($file2, $product2, $quantity2, $price2);
                                outputOrderRow($file3, $product3, $quantity3, $price3);
                                outputOrderRow($file4, $product4, $quantity4, $price4);
                            ?>
                        </tbody>
                        <tfoot>
                            <?php
                            $subtotal = $quantity1*$price1 + $quantity2*$price2 + $quantity3*$price3 + $quantity4*$price4;
                            $shipping = ($subtotal > 10000) ? 100 : 200;
                            $grandtotal = $subtotal + $shipping;
                            ?>
                            <tr class="totals">
                                <td colspan="4">Subtotal</td>
                                <td>$<?php echo number_format($subtotal,2); ?></td>
                            </tr>
                            <tr class="totals">
                                <td colspan="4">Shipping</td>
                                <td>$<?php echo number_format($shipping,2); ?></td>
                            </tr>
                            <tr class="grandtotals">
                                <td colspan="4">Grand Total</td>
                                <td>$<?php echo number_format($grandtotal,2); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

</body>
</html>