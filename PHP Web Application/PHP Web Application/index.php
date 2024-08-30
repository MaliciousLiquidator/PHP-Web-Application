<!DOCTYPE html>
<html>
<head>
    <title>Polling Application</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/index_style.css">
</head>
<body>
    <h1>Polling Application</h1>
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
    <p>Welcome to our polling application, where you can create and vote on polls.</p>

    <h2>Current Polls</h2>
    <?php
    
    include 'data.php';
    ?>

    <h3>Open Polls</h3>
    <?php
    
    foreach ($polls as $poll) {
        $deadline = strtotime($poll['deadline']);
        $current_time = time();
        if ($current_time < $deadline) {
            echo "Poll " . $poll['id'] . ": " . $poll['question'] . "<br>";
            echo "Created at: " . $poll['createdAt'] . "<br>";
            echo "Deadline: " . $poll['deadline'] . "<br>";
            echo "<a href='vote.php?poll_id=" . $poll['id'] . "'>Vote</a> <br><br>";
        }
    }
    ?>

    <h3>Closed Polls</h3>
    <?php
    
    foreach ($polls as $poll) {
        $deadline = strtotime($poll['deadline']);
        $current_time = time();
        if ($current_time >= $deadline) {
            echo "Poll " . $poll['id'] . ": " . $poll['question'] . "<br>";
            echo "Created at: " . $poll['createdAt'] . "<br>";
            echo "Deadline: " . $poll['deadline'] . "<br>";
            echo "Results: " . implode(", ", array_map(function ($v, $k) { return $k . ':' . $v; }, $poll['answers'], array_keys($poll['answers']))) . "<br><br>";
        }
    }
    ?>

</body>
</html>
