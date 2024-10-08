<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    <?php include_once APP_ROOT . '/bhumi/views/css/index.css'; ?>
</style>

<body>

    <?php include APP_ROOT . '/bhumi/views/components/header.php'; ?>
    <div class="container mt-5 mb-5">
        <h2>Login</h2>
        <?php include APP_ROOT . '/bhumi/views/components/messages.php'; ?>
        <form action="/cakery/login" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="Email" value="<?php echo isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="/cakery/register">Register here</a></p>
    </div>
    <?php include APP_ROOT . '/bhumi/views/components/footer.php'; ?>
    <?php include APP_ROOT . '/bhumi/views/scripts/scripts.php'; ?>
</body>

</html>