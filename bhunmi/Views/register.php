<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <h2>Register</h2>
    <form action="/cakery/register" method="post">
        <label for="CustomerName">Name:</label>
        <input type="text" id="CustomerName" name="CustomerName" required><br><br>
        <label for="Email">Email:</label>
        <input type="email" id="Email" name="Email" required><br><br>
        <label for="PhoneNumber">Phone Number:</label>
        <input type="tel" id="PhoneNumber" name="PhoneNumber"><br><br>
        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password" required><br><br>
        <label for="cfm-Password"> Confirm Password:</label>
        <input type="password" id="ConfirmPassword" name="ConfirmPassword" required><br><br>
        <button type="submit">Register</button>
    </form>

</body>

</html>
