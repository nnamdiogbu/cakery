<!DOCTYPE html>
<html>

<head>
    <title>Cakes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        <?php include_once 'css/index.css'; ?>
    </style>
</head>

<body>

    <?php include 'components/header.php'; ?>
    <div class="container mt-5">
        <h2>Our Cakes</h2>
        <div class="row">
            <?php foreach ($cakes as $cake): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($cake['CakeImage']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($cake['CakeName']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($cake['CakeName']); ?></h5>
                            <p class="card-text">$<?php echo htmlspecialchars($cake['Price']); ?></p>
                            <a href="/cakery/cake-details?id=<?php echo htmlspecialchars($cake['CakeId']); ?>" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
    <?php include 'scripts/scripts.php'; ?>
</body>

</html>