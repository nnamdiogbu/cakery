<!-- navbar.php -->
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .hero {
        background-image: url("image/slider1.jpg");
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/cakery">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo" loading="lazy"> <!-- Replace with your logo -->
        Group 10 - Cakes
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/cakery">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if (isset($_SESSION['customer_name'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome, <?php echo htmlspecialchars($_SESSION['customer_name']); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cakery/logout">Logout</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/cakery/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cakery/register">Register</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="/cakery/services">Services</a>
            </li>
        </ul>
    </div>
</nav>