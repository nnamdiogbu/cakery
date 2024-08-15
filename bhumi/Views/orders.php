<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Group 10 Cakery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        <?php include_once 'css/index.css'; ?>
    </style>
</head>

<body>

    <?php include 'components/header.php'; ?>

    <main class="container mt-4 mb-4">
        <h1 class="mb-4 text-center">You Order History</h1>

        <?php if (empty($orders)): ?>
            <div class="alert alert-info" role="alert">
                You haven't placed any orders yet.
            </div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="card custom-card mb-4">
                    <div class="card-header">
                        <h2 class="h4">Order #<?php echo htmlspecialchars($order['OrderId']); ?></h2>
                        <p class="mb-0">Date: <?php echo date('F j, Y g:i A', strtotime($order['OrderDate'])); ?></p>
                    </div>
                    <div class="card-body">
                        <h3 class="h5 mb-3">Order Details</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Cake</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order['OrderDetails'] as $detail): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($detail['CakeName']); ?></td>
                                        <td>$<?php echo number_format($detail['Price'], 2); ?></td>
                                        <td><?php echo $detail['Quantity']; ?></td>
                                        <td>$<?php echo number_format($detail['Price'] * $detail['Quantity'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Total (after tax):</th>
                                    <th>$<?php echo number_format($order['TotalAmount'], 2); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="mt-4 text-center">
            <a href="cake" class="btn btn-primary">Continue Shopping</a>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/scripts.php'; ?>
</body>

</html>