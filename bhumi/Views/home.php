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
    <main>
        <div class="hero">
            <div>
                <h1>Made with Love</h1>
                <p>Delicious cakes for every occasion. Browse our selection and find your perfect cake today!</p>
                <a href="#" class="btn btn-warning">Explore</a>
            </div>

        </div>

        <div class="container my-5 cake-instructions">
            <h2 class="text-center mb-4">Cake Making Instructions</h2>
            <div class="row">
                <div class="col-md-4">
                    <img src="https://images.pexels.com/photos/1702373/pexels-photo-1702373.jpeg" class="img-fluid" alt="Cake 1">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Best Ingredients</h3>
                            <p>We use only the finest, freshest ingredients, including farm-fresh eggs, premium flour, real butter,
                                high-quality chocolate, and fresh fruits, ensuring every cake is delicious and wholesome.</p>
                        </div>
                        <div class="col-md-6">
                            <h3>Our Process</h3>
                            <p>Our baking process blends traditional techniques with modern innovations,
                                ensuring each cake is crafted with care and precision, resulting in a moist, flavorful, and beautifully presented cake.</p>
                        </div>
                        <div class="col-md-6">
                            <h3>Farming Practices</h3>
                            <p>We source ingredients from farms that prioritize sustainable and ethical practices,
                                supporting eco-friendly methods and animal welfare to ensure superior quality and taste.</p>
                        </div>
                        <div class="col-md-6">
                            <h3>Story Behind</h3>
                            <p>Every cake has a story, inspired by family recipes and baking traditions,
                                crafted with passion and dedication by our skilled bakers to bring joy and delight to our customers.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container stats-section my-5">
            <h2 class="text-center mb-4">Our Shop</h2>
            <div class="row">
                <div class="col-md-3 stat">
                    <h3>5</h3>
                    <p>Shops</p>
                </div>
                <div class="col-md-3 stat">
                    <h3>10,000+</h3>
                    <p>Happy Customers</p>
                </div>
                <div class="col-md-3 stat">
                    <h3>50,000+</h3>
                    <p>Cakes Sold</p>
                </div>
                <div class="col-md-3 stat">
                    <h3>4.8/5</h3>
                    <p>Customer Reviews</p>
                </div>
            </div>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'scripts/scripts.php'; ?>

</body>

</html>
