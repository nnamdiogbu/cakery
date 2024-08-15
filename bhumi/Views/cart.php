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
    <main class="container mt-4 mb-4">
        <h1 class="mb-4 text-center">Your Cart</h1>

        <?php include 'components/messages.php'; ?>

        <?php if (empty($cartItems)): ?>
            <div class="alert alert-info" role="alert">
                Your cart is empty.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($cartItems as $item): ?>
                    <div class="col-12 mb-4">
                        <div class="card custom-card">
                            <div class="row no-gutters">
                                <div class="col-md-4 d-flex justify-content-center">
                                    <img src="<?php echo htmlspecialchars($item['CakeImage']); ?>" class="card-img" alt="<?php echo htmlspecialchars($item['CakeName']); ?>">
                                </div>
                                <div class="col-md-8">
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
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <?php
                    $subTotal = array_sum(array_map(function ($item) {
                        return $item['Quantity'] * $item['Price'];
                    }, $cartItems));
                    ?>
                    <h3>SubTotal: $<?php echo number_format($subTotal, 2); ?></h3>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <form action="/cakery/clear-cart" method="POST" class="d-inline-block">
                        <button type="submit" class="btn btn-warning m-2">Clear Cart</button>
                    </form>
                    <a href="/cakery/checkout?subtotal=<?php echo number_format($subTotal, 2); ?>" class="btn btn-primary ms-2">Proceed to Checkout</a>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="/cakery" class="btn btn-secondary">Continue Shopping</a>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'components/scripts.php'; ?>
</body>

</html>
