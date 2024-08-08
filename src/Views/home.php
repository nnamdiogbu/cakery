<?php 
namespace EcommerceGroup10\Cakery\Views;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 10 - Cakes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hero {
            background-image: url('image/slider1.jpg');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero h1 {
            font-size: 4rem;
        }

        .hero p {
            font-size: 1.5rem;
        }

        .stats-section {
            padding: 2rem 0;
            background-color: #f8f9fa;
        }

        .stats-section .stat {
            text-align: center;
            padding: 1rem;
        }

        .stats-section .stat h3 {
            font-size: 2rem;
            margin: 0.5rem 0;
        }

        .stats-section .stat p {
            margin: 0;
            font-size: 1.2rem;
        }

        footer {
            background: #333;
            color: white;
            padding: 2rem 0;
        }

        footer .footer-links a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }

        footer .footer-links a:hover {
            text-decoration: underline;
        }

        .contact-map {
            height: 300px;
            width: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy"> <!-- Replace with your logo -->
            Group 10 - Cakes
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php 
if (isset($_SESSION['customer_name'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome, <?php echo htmlspecialchars($_SESSION['customer_name']); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/logout.php">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login">Login</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
            </ul>
        </div>
    </nav>

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
                <img src="image/cake1.jpg" class="img-fluid" alt="Cake 1">
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

    <!-- Statistics Section -->
    <div class="container stats-section my-5">
        <h2 class="text-center mb-4">Our Shop</h2>
        <div class="row">
            <div class="col-md-3 stat">
                <h3>5</h3>
                <p>Shops</p>
            </div>
            <div class="col-md-3 stat">
                <h3>10,000+</< /h3>
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

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Bakers</h5>
                    <p>At Group 10 - Cakes, we blend passion with expertise to create delightful cakes. Our skilled
                        bakers use the finest ingredients and traditional techniques to craft cakes that bring joy to every occasion.</p>
                </div>
                <div class="col-md-4">
                    <h5>Latest Posts</h5>
                    <p>Welcome to the Best Cakes</p>
                    <p>How to Make the Best Cakes</p>
                    <p>Cake Decorating Tips</p>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <p>123 Cake Lane, Sweet City, CA 90210</p>
                    <p>Email: info@group10cakes.com</p>
                    <p>Phone: (123) 456-7890</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.5691552903225!2d-74.00601568459314!3d40.7127759793307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDQyJzQ1LjciTiA3NMKwMDAnMjguMSJX!5e0!3m2!1sen!2sus!4v1598912769075!5m2!1sen!2sus" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="text-center mt-3">
                <p>&copy; 2024 Group 10 - Cakes. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>
