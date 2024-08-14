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
                        <a href="/add-to-cart.php?id=<?php echo htmlspecialchars($cake['CakeId']); ?>" class="btn btn-primary">Add to Cart</a>
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