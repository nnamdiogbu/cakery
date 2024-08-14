<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>

    <h2>Login</h2>
    <form action="/cakery/login" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="Email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

</body>

</html>
