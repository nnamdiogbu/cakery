<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        <?php include_once APP_ROOT . '/bhumi/views/css/index.css'; ?>
    </style>
</head>

<body>

    <?php include APP_ROOT . '/bhumi/views/components/header.php'; ?>

    <div class="container mt-5 mb-5">
        <h2>Register</h2>
        <?php include APP_ROOT . '/bhumi/views/components/messages.php'; ?>
        <form action="/cakery/register" method="post">
            <div class="form-group">
                <label for="CustomerName">Name:</label>
                <input type="text" class="form-control" id="CustomerName" name="CustomerName" value="<?php echo isset($_POST['CustomerName']) ? htmlspecialchars($_POST['CustomerName']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="PhoneNumber">Phone Number:</label>
                <input type="tel" class="form-control" id="PhoneNumber" name="PhoneNumber" value="<?php echo isset($_POST['PhoneNumber']) ? htmlspecialchars($_POST['PhoneNumber']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="Password">Password:</label>
                <input type="password" class="form-control" id="Password" name="Password" required>
            </div>
            <div class="form-group">
                <label for="ConfirmPassword">Confirm Password:</label>
                <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <?php include APP_ROOT . '/bhumi/views/components/footer.php'; ?>
    <?php include APP_ROOT . '/bhumi/views/scripts/scripts.php'; ?>
</body>

</html>