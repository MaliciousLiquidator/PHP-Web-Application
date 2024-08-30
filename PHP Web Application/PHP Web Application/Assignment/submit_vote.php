<?php
session_start();
include 'data.php';
$poll_id = $_POST['poll_id'];
$vote = $_POST['vote'];


if(!isset($vote)){
echo "Please select an option before submitting";
exit;
}
if(is_array($vote)){
foreach($vote as $v){
if(!in_array($v, $polls[$poll_id]['options'])){
echo "Invalid vote: $v is not a valid option";
exit;
}
}
}else{
if(!in_array($vote, $polls[$poll_id]['options'])){
echo "Invalid vote: $vote is not a valid option";
exit;
}
}


if(is_array($vote)){
foreach($vote as $v){
$polls[$poll_id]['answers'][$v]++;
}
}else{
$polls[$poll_id]['answers'][$vote]++;
}


$polls[$poll_id]['voted'][] = $_SESSION['username'];


$serialized = var_export($polls, true);
file_put_contents('data.php', '<?php $polls = ' . var_export($polls, true) . '; $users = ' . var_export($users, true) . ';');
echo "Your vote has been successfully submitted.";
?>