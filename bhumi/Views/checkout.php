<?php

if (!isset($_SESSION['customer_name'])) {
    header("Location: /login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        <?php include_once 'css/index.css'; ?>
    </style>
</head>

<body>

    <?php include 'components/header.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="checkout-container">

                    <h2 class="form-header mb-4">Checkout</h2>

                    <div class="order-summary mb-4">
                        <h4>Order Summary</h4>
                        <p><strong>Subtotal:</strong> $<?php echo number_format($subTotal, 2); ?></p>
                        <p><strong>Tax (<?php echo $taxRate * 100; ?>%):</strong> $<?php echo number_format($subTotal * $taxRate, 2); ?></p>
                        <p><strong>Total:</strong> $<?php echo number_format($total, 2); ?></p>
                    </div>


                    <form action="/cakery/create-order" method="post">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <span class="error-message"><?php echo $errors['name'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                            <span class="error-message"><?php echo $errors['address'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                            <span class="error-message"><?php echo $errors['city'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="zip">Zip Code</label>
                            <input type="text" class="form-control" id="zip" name="zip">
                            <span class="error-message"><?php echo $errors['zip'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="cardNumber">Credit Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber">
                            <span class="error-message"><?php echo $errors['cardNumber'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="expiryDate">Expiry Date (MM/YY)</label>
                            <input type="text" class="form-control" id="expiryDate" name="expiryDate">
                            <span class="error-message"><?php echo $errors['expiryDate'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv">
                            <span class="error-message"><?php echo $errors['cvv'] ?? ''; ?></span>
                        </div>

                        <input type="hidden" id="subTotal" name="subTotal" value=<?php echo htmlspecialchars($subTotal); ?> />
                        <input type="hidden" id="taxRate" name="taxRate" value=<?php echo htmlspecialchars($taxRate); ?> />
                        <input type="hidden" id="total" name="total" value=<?php echo htmlspecialchars($total); ?> />

                        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
    <?php include 'scripts/scripts.php'; ?>

</body>

</html>