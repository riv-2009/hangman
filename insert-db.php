<?php
//insert-db.php was just used to initialize my database with words from word.txt
require_once 'connection-info.php';

insertAnimalsDB($conn);


function insertAnimalsDB($conn){
    //get words from word.txt file
    $fh = fopen('word.txt', 'r') or die ("could not open file.");
    while(! feof($fh)){
        $words[] = fgets($fh);
    }
    fclose($fh);
 
    foreach ($words as $word) {
        $str = str_replace(' ', '', $word); 
        $length = strlen($str)-2; 
        $sql = "INSERT INTO animals (name, length) VALUES ('$word', '$length')";
        $conn->query($sql);
    }
    $conn->close();
}