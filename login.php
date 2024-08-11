<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="biggest">

<h1>LOG IN</h1>
<i>it is very easy</i>

<br>

<form action="login.php" method="POST">

<?php if(isset($username_error)){
    echo $username_error;
 }
?>

<input type="text" name="Username" id="Username" placeholder="Username"><br>

<?php if(isset($password_error)){
    echo $password_error;
 }
?>

<input type="password" name="password" id=" password" placeholder="password"><br>
<input type="submit" name="submit" id="submit" value="LOG IN"><br>
</form>
<?php
if (isset($_POST['submit'])) {
    header('Location:mp.html');
    exit;
}
?>
<form action="" method="post">
    <input type="submit" name="submit" value="LOG IN" id="submit">
</form>

    <h3 id="or"> Or </h3>
    <a id="login" href="register.php">Register</a>

</div>

</body>

</html>