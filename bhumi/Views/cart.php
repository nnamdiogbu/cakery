<!-- cart.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 10 - Cakes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        <?php include_once 'css/index.css'; ?>
    </style>
</head>

<body>

    <?php include 'components/header.php'; ?>

<main class="container mt-4">
    <h1 class="mb-4">Your Cart</h1>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success_message']; ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (empty($cartItems)): ?>
        <div class="alert alert-info" role="alert">
            Your cart is empty.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($cartItems as $item): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['CakeName']); ?></h5>
                            <p class="card-text">Price: $<?php echo number_format($item['Price'], 2); ?></p>
                            <form action="/cakery/update-cart-item" method="POST" class="mb-3">
                                <input type="hidden" name="CartId" value="<?php echo $item['CartId']; ?>">
                                <div class="input-group">
                                    <span class="input-group-text">Quantity</span>
                                    <input type="number" class="form-control" name="Quantity" value="<?php echo $item['Quantity']; ?>" min="1">
                                    <button class="btn btn-outline-secondary" type="submit">Update</button>
                                </div>
                            </form>
                            <p class="card-text">Subtotal: $<?php echo number_format($item['Quantity'] * $item['Price'], 2); ?></p>
                            <form action="/cakery/remove-cart-item" method="POST">
                                <input type="hidden" name="CartId" value="<?php echo $item['CartId']; ?>">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Total: $<?php echo number_format(array_sum(array_map(function($item) { return $item['Quantity'] * $item['Price']; }, $cartItems)), 2); ?></h3>
            </div>
            <div class="col-md-6 text-md-end">
                <form action="/cakery/clear-cart" method="POST" class="d-inline-block">
                    <button type="submit" class="btn btn-warning">Clear Cart</button>
                </form>
                <a href="/cakery/checkout" class="btn btn-primary ms-2">Proceed to Checkout</a>
            </div>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="/cakery" class="btn btn-secondary">Continue Shopping</a>
    </div>
</main>

 <?php include 'components/footer.php'; ?>
</body>
</html>
