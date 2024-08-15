<?php
$isLoggedIn = isset($_SESSION['customer_name']);
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo htmlspecialchars($cake['CakeName']); ?> Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        <?php include_once 'css/index.css'; ?>
    </style>
</head>

<body>

    <?php include 'components/header.php'; ?>
    <div class="container mt-5 mb-5">
    <?php include 'components/messages.php'; ?>
        <?php if ($cake): ?>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo htmlspecialchars($cake['CakeImage']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($cake['CakeName']); ?>">
                </div>
                <div class="col-md-6">
                    <h1><?php echo htmlspecialchars($cake['CakeName']); ?></h1>
                    <h3>Price: $<?php echo htmlspecialchars($cake['Price']); ?></h3>
                    <p>Description: <?php echo htmlspecialchars($cake['Description']); ?></p>
                    <?php if ($isLoggedIn): ?>
                        <form action="/cakery/add-to-cart" method="POST">
                            <input type="hidden" name="CakeId" value="<?php echo htmlspecialchars($cake['CakeId']); ?>">
                            <button class="btn btn-primary" type="submit">Add to Cart</button>
                        </form>
                    <?php else: ?>
                        <a href="login" class="btn btn-primary">Login to Add to Cart</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <p>Sorry, the cake details could not be found.</p>
        <?php endif; ?>
    </div>

    <?php include 'components/footer.php'; ?>
    <?php include 'scripts/scripts.php'; ?>
</body>

</html>