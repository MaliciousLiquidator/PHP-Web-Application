<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="CSS/All_style.css">
<head>
    <title>Voting Page</title>
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
        session_start();
        include 'data.php';
        
        if (!isset($_GET['poll_id'])) {
            echo "Poll id not found";
            exit;
        }
        $poll_id = $_GET['poll_id'];

        
        if (!isset($_SESSION['username'])) {
            header('Location: login.php');
            exit;
        }
        if(!isset($users[$_SESSION['username']])){
            echo "You are not authorized to vote";
            exit;
        }

        if(in_array($_SESSION['username'], $polls[$poll_id]['voted'])){
            echo "You already voted in this poll";
            exit;
        }

        
        $deadline = strtotime($polls[$poll_id]['deadline']);
        $current_time = time();
        if ($current_time >= $deadline) {
            echo "This poll's voting deadline has passed.";
            exit;
        }
    ?>
    <h1>Voting Page</h1>
    <p>Welcome to the voting page for poll "<?php echo $polls[$poll_id]['question']; ?>".</p>

    <p>Poll description: <?php echo $polls[$poll_id]['question']; ?></p>
    <p>Possible options:</p>
    <form action="submit_vote.php" method="post">
    <?php
        
        foreach ($polls[$poll_id]['options'] as $option) {
            echo "<input type='" .($polls[$poll_id]['isMultiple'] ? 'checkbox' : 'radio') . "' name='vote' value='$option'>" . $option . "<br>";
        }
    ?>
    <input type="hidden" name="poll_id" value="<?php echo $poll_id; ?>">
    <input type="submit" value="Submit">
    </form>
<p>Voting deadline: <?php echo $polls[$poll_id]['deadline']; ?></p>
<p>Time of creation: <?php echo $polls[$poll_id]['createdAt']; ?></p>
</body>
</html>