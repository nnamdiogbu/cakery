<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <h2>Register</h2>
    <form action="./php/register.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>

</body>

</html>