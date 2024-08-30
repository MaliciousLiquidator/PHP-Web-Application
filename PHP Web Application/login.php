<?php
session_start();

require_once('data.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (isset($users[$username]) && ($users[$username]['password'] == $password) || ($username == 'admin' && $password == 'admin')) {
        
        $_SESSION['username'] = $username;
        if($username == 'admin'){
            $_SESSION['isAdmin'] = true;
        }else{
            $_SESSION['isAdmin'] = $users[$username]['isAdmin'];
        }
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="CSS/All_style.css">
<link rel="stylesheet" type="text/css" href="CSS/Form_style.css">
<head>
    <title>Login</title>
</head>
<body>
<nav>
        <ul>
            <li><a href="index.php">Main</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="registration.php">Registration</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php
    if(!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true){
        echo '<li><a href="createpoll.php">Create Poll</a></li>';
        echo '<li><a href="deletepoll.php">Delete Poll</a></li>';
    }   
?>
        </ul>
    </nav>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <input type="submit" value="Login">
    </form>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>