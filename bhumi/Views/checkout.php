<?php
session_start();

if (!isset($_SESSION['customer_name'])) {
    header("Location: /login.php");
    exit();
}

$errors = [];
$name = $address = $city = $zip = $cardNumber = $expiryDate = $cvv = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $zip = trim($_POST['zip']);
    $cardNumber = trim($_POST['cardNumber']);
    $expiryDate = trim($_POST['expiryDate']);
    $cvv = trim($_POST['cvv']);

    if (empty($name)) $errors['name'] = 'Name is required';
    if (empty($address)) $errors['address'] = 'Address is required';
    if (empty($city)) $errors['city'] = 'City is required';
    if (empty($zip) || !preg_match('/^\d{5}$/', $zip)) $errors['zip'] = 'Valid Zip Code is required';
    if (empty($cardNumber) || !preg_match('/^\d{16}$/', $cardNumber)) $errors['cardNumber'] = 'Valid Card Number is required';
    if (empty($expiryDate) || !preg_match('/^\d{2}\/\d{2}$/', $expiryDate)) $errors['expiryDate'] = 'Valid Expiry Date (MM/YY) is required';
    if (empty($cvv) || !preg_match('/^\d{3}$/', $cvv)) $errors['cvv'] = 'Valid CVV is required';

    if (empty($errors)) {
        header("Location: /order-confirmation.php?subtotal=$subtotal&name=" . urlencode($name));
        exit();
    }
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


                    <form action="checkout.php?subtotal=<?php echo $subtotal; ?>" method="post">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                            <span class="error-message"><?php echo $errors['name'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>">
                            <span class="error-message"><?php echo $errors['address'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($city); ?>">
                            <span class="error-message"><?php echo $errors['city'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="zip">Zip Code</label>
                            <input type="text" class="form-control" id="zip" name="zip" value="<?php echo htmlspecialchars($zip); ?>">
                            <span class="error-message"><?php echo $errors['zip'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="cardNumber">Credit Card Number</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="<?php echo htmlspecialchars($cardNumber); ?>">
                            <span class="error-message"><?php echo $errors['cardNumber'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="expiryDate">Expiry Date (MM/YY)</label>
                            <input type="text" class="form-control" id="expiryDate" name="expiryDate" value="<?php echo htmlspecialchars($expiryDate); ?>">
                            <span class="error-message"><?php echo $errors['expiryDate'] ?? ''; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" value="<?php echo htmlspecialchars($cvv); ?>">
                            <span class="error-message"><?php echo $errors['cvv'] ?? ''; ?></span>
                        </div>

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
