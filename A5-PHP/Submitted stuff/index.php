<!DOCTYPE html>
<html>
<head>
    <title>Index</title>
</head>
<body>
    <?php
    $placeholder = 0;
    ?>
<fieldset>
    <form action="login.php" method="POST" >
        <h1>Authentication Form</h1>
		<h4>Album Login</h4>
        <label for="username">Username: </label>
        <input type="text" name="username"><br><br>
        <label for="pwd">Password: </label>
        <input type="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</fieldset>
</body>
</html>