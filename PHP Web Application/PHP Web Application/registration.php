<?php
session_start();


require_once('data.php');

$error = "";
$username = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    
    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        $error = "All fields are required.";
    } else {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            
            if ($password != $password2) {
                $error = "Passwords do not match.";
            } else {
                
                if (isset($users[$username])) {
                    $error = "Username already exists.";
                } else {
                    
$users[$username] = [
    'email' => $email,
    'password' => $password,
    'isAdmin' => false
];


require_once('data.php');


$users[$username] = [
    'email' => $email,
    'password' => $password,
    'isAdmin' => false
];


file_put_contents('data.php', '<?php $polls = ' . var_export($polls, true) . '; $users = ' . var_export($users, true) . ';');
                    header('Location: login.php');
                    exit;
                }
            }
        }
    }
}
?>
    
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="CSS/All_style.css">
<link rel="stylesheet" type="text/css" href="CSS/Form_style.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<h1>Registration Page</h1>
    <form action="registration.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password">
        <br>
        <label for="password2">Confirm Password:</label>
        <input type="password" name="password2" id="password2" required>
        <br><br>
        <input type="submit" value="Register">
    </form>
    <?php
        if (!empty($error)) {
            echo "<p style='color:red'>$error</p>";
        }
    ?>
</body>
</html>