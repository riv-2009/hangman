<? 
session_start();
include_once 'header.html';
include_once 'connection-info.php';

$user = $_SESSION['username'];


//validate user logged in
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

//put letters a-z in an array for UI
$letters = array();
$a = 'a';
for ($i=0; $i < 26; $i++) {
    $letters[$i] = $a++;
}

//get random word from database returns array( word and length)
if(!isset($_POST['showScores'])){
  $word = getWordsDB($conn);
  $length = $word[1];
  $hangmanWord = $word[0];
  $_SESSION['word'] = $hangmanWord;
}
// update high score table
if(isset($_POST['showScores'])){
  $_SESSION['attempts'] =$_POST['attempts'];
  $highScore = intval($_POST['highscore']);
  $_SESSION['score'] = $highScore;
  $ln = $_POST['ln'];
  $sql = "INSERT INTO highscore (id, name, score, ln ) VALUES (NULL, '$user', '$highScore', '$ln')";
  $conn->query($sql);
  $_SESSION['ln'] = $_POST['ln'];
  header("Location: high-scores.php"); 
}



//logout
if(isset($_POST['Logout'])){
    unset($_SESSION);
    $conn->close();
}

function getWordsDB($conn){
  $sql = "SELECT * FROM animals";
  $results = $conn->query($sql);
  if($results->num_rows>0){
      while($row = $results->fetch_assoc()){
          $line[] = $row['name'];
          $length[] = $row['length'];
      }
  }
  $index = rand(0,count($line));
  $word = $line[$index];
  return array($word, $length[$index]);
}
?>
<body>
<!-- navbar -->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="">HANGMAN</a>
  
    <div class="navbar " id="mynavbar">
      <form class="d-flex" method="post" action="login.php">
        <button class="btn btn-primary" type="submit" name="Logout">Logout</button>
      </form>
    </div>
  </div>
</nav>
<!-- Welcome user -->
<div class='container-fluid'>
  <div class='row'>
    <div class='col'>
      <h3><?php $name = ucfirst($user); echo "Welcome, $name! <span class='float-end' id='points'>
      Score: 0 points</span>"; ?></h3>
    </div>
 
  </div>
</div>

<div class='container mb-4'>
  <div class='row mt-4'>
    <!-- image section -->
   <div class="col-sm-4">
   <canvas class="float-end" id="canvas" width="200px" height="200px" ></canvas>
   <h1 id='gOver' class='m-2 float-end'></h1>
   </div>
<!-- underscore of word section -->
   <div class="col-sm -8">
   <div class='text-center'>
      <h1>Category: <i class='text-primary'>Animals</i></h1>
      <div class='mar'>
      <?php

      for ($i = 0; $i < $length; $i++) {
          $id = $hangmanWord[$i]. $i;
          echo "<input id='$id' value=' ' type='button' 
          class='wBtn wl' name='$id'>";
      }

      ?> 
      <h6 class='m-1'>Need a hint, what space do you want to see?
      <input id='inputHint' type='test' class='hint' onkeyup='showHint(this.value)' maxlength="1"></h6>
      <p id='hint'></p>
        </div>
    </div>
   </div>
  </div>
  <div class='row'>
    <div class='col-sm-3'>
  

    </div>
    <!-- a-z buttons -->
    <div class='col-sm-6' >
      <div id='btnGp'>
        <?php
        foreach($letters as $letter){
          echo "<button class='btn gBtn  m-1' type='button' id='$letter' 
          onclick='btnClicked(this.id)' name='$letter'>$letter</button>";
        }?>

     <form class='mt-4' id='form' action ='' method ='post' hidden>
        <input type='text' id='ln' name='ln' hidden>
        <input type="text" id='tries' name='attempts' hidden>
        <input type='text' id='highscore' name='highscore' hidden>
        <button class="btn btn-primary" type="submit" name="showScores" id="showScores">Show High Scores</button>
      </form>
    <div class='col-sm-3'>
      <p id='wordLength' hidden> <?php echo $length; ?> </p>
    </div>
  </div>
</div>
<audio id="over">
  <source id='over' src="audio\game-over.mp3" type="audio/mpeg">
</audio>
<audio id="correct">
  <source id='correct' src="audio\correct.mp3" type="audio/mpeg">
</audio>
<audio id="wrong">
  <source id='wrong' src="audio\wrong.mp3" type="audio/mpeg">
</audio>

<script src="scripts\stickfigure.js"></script>
</body>
</html>

