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

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="cakery">
                <img src="/abhay/images/Logo.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy"> <!-- Replace with your logo -->
                Group 10 - Cakes
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="cakery">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cake">Cakes</a>
                    </li>
                    <?php
                    if (isset($_SESSION['customer_name'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="cart">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Welcome, <?php echo htmlspecialchars($_SESSION['customer_name']); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout">Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>