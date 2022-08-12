<?php
session_start();
$q = intval($_REQUEST['q']);
$word = $_SESSION['word'];
$letter = $word[$q-1];
if($q <= strlen($word) && $q > 0){
    echo "Try the letter: $letter";
}
else
    echo "";
?>