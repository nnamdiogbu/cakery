<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Group 10 Cakery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        <?php include_once 'css/index.css'; ?>
    </style>
</head>

<body>

    <?php include 'components/header.php'; ?>
    
    <main class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card custom-card">
                    <div class="card-body text-center">
                        <h1 class="card-title mb-4">Order Confirmation</h1>
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h2 class="text-success mb-4">Thank You for Your Order!</h2>
                        <p class="lead mb-4">Your order has been confirmed and is on its way.</p>
                        <p>We've sent a confirmation email with your order details.</p>
                        <p>If you have any questions about your order, please contact our customer service.</p>
                        <hr>
                        <p>Expected delivery time: 3-5 business days</p>
                        <div class="mt-4">
                            <a href="/cakery/orders" class="btn btn-primary">View Order History</a>
                            <a href="/cakery" class="btn btn-secondary ml-2">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/scripts.php'; ?>
</body>

</html>
