<?php
session_start();

require_once('data.php');

if (!isset($_SESSION['username']) || !isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    echo "You do not have permission to view this page";
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $options = $_POST["options"];
    $isMultiple = $_POST["isMultiple"] == "true";
    $deadline = $_POST["deadline"];
    $createdAt = $_POST["createdAt"];

    if (empty($question) || empty($options) || empty($deadline)) {
        $error = "All fields are required.";
    } else {
        $deadline = strtotime($deadline);
        $current_time = time();
        if ($deadline <= $current_time) {
            $error = "Deadline must be in the future.";
        } else {
            $id = count($polls) + 1;
            $options = explode("\n", $options);
            $options = array_map('trim', $options);
            $polls[$id] = [
                'id' => $id,
                'question' => $question,
                'options' => $options,
                'isMultiple' => $isMultiple,
                'deadline' => date("Y-m-d H:i:s", $deadline),
                'createdAt' => $createdAt,
                'answers' => array_fill_keys($options, 0),
                'voted' => [],
            ];
            file_put_contents('data.php', '<?php $polls = ' . var_export($polls, true) . '; $users = ' . var_export($users, true) . ';');
        }
    }
}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="CSS/Form_style.css">
<link rel="stylesheet" type="text/css" href="CSS/All_style.css">
<head>
    <title>Create Poll</title>
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
<h1>Create Poll</h1>

<form action="createpoll.php" method="post">
    <label for="question">Poll Question:</label>
    <input type="text" id="question" name="question" required>

    <label for="options">Poll Options:</label>
    <textarea id="options" name="options" required></textarea>

    <label for="isMultiple">Allow multiple options to be selected:</label>
    <input type="radio" id="isMultiple" name="isMultiple" value="true" required>Yes
    <input type="radio" id="isMultiple" name="isMultiple" value="false" required>No

    <label for="deadline">Voting Deadline:</label>
    <input type="date" id="deadline" name="deadline" required>

    <label for="createdAt">Time of Creation:</label>
    <input type="date" id="createdAt" name="createdAt">

    <input type="submit" value="Create Poll">
</form>
    </body>
</html>
                
