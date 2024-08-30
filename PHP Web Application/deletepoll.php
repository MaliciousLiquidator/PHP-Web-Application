<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="CSS/All_style.css">
<head>
    <title>Delete Poll</title>
    <meta charset="UTF-8">
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
    <?php
    if(!isset($_SESSION)) {
        session_start();
    }
    include 'data.php';
    
    if (!isset($_SESSION['username']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
        echo "You do not have permission to view this page";
        exit;
    }
    $error = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $poll_id = $_POST["poll_id"];
        if (empty($poll_id)) {
            $error = "Please select a poll to delete.";
        } else {
            if (array_key_exists($poll_id, $polls)) {
                unset($polls[$poll_id]);
                file_put_contents('data.php', '<?php $polls = ' . var_export($polls, true) . '; $users = ' . var_export($users, true) . ';');
                echo "The poll has been successfully deleted.";
            } else {
                $error = "Invalid poll id.";
            }
        }
    }
    ?>
    <h1>Delete Poll</h1>
    <form action="deletepoll.php" method="post">
        <label for="poll_id">Select a poll to delete:</label>
        <select name="poll_id" id="poll_id">
            <?php
            foreach ($polls as $poll) {
                echo "<option value='" . $poll['id'] . "'>" . $poll['question'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Delete">
        <span class="error"><?php echo $error; ?></span>
    </form>
</body>
</html>


