var count = 0;
var guess = 0;
var score = 0; // you get 1000 pts for each correct guess -200 for each wrong guess
var wrongLetter = 0;

function btnClicked(id) {

    //determine if button clicked is in word 
    for (let index = 0; index < 100; index++) {
        if(document.getElementById(id + index) != null) {
            var letter =document.getElementById(id + index);
            letter.value = id;
            count++;
            score += 1000;
        }
    }
    //disable but after selected
    var button = document.getElementById(id);
    button.disabled = true;
    if(guess != count){
        button.style.borderColor = 'green';
        guess = count;
        var x = document.getElementById("correct"); 
        x.play();

    }
    else{
        button.style.borderColor = 'red';
        score -= 200;
        if(wrongLetter != 12){
            var x = document.getElementById("wrong"); 
            x.play();
        }
        draw(wrongLetter++);
      
    }    
    
    //update score 
    document.getElementById('points').innerHTML = "Score: " + score +" points"; 
    
    var wordLength = parseInt(document.getElementById('wordLength').innerHTML);

    //game is over
    if(wrongLetter == 12 || count == wordLength){
       //disable all buttons
       char ='a';
       for (let index = 0; index < 26; index++) {
          var id = String.fromCharCode(char.charCodeAt(0) + index);
          var btn = document.getElementById(id);
          btn.disabled = true;
       }
       //put high score in form 
        document.getElementById('highscore').value = score;

        document.getElementById('ln').value = wordLength;
      
        document.getElementById('tries').value = wrongLetter;
        if(wrongLetter == 12){
            var x = document.getElementById("over"); 
            x.play();
        }
       
        //wait then submit the form
        setTimeout(showHighScores, 5000);
        
        
    }
    
}  
function showHighScores(){
    document.getElementById('showScores').click();
}

function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("hint").innerHTML = "";
        return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.getElementById("hint").innerHTML =
      this.responseText;
    }
    xhttp.open("GET", "hint.php?q=" + str);
    xhttp.send();

    var hint = document.getElementById('hint');
    setTimeout(function clear(){ 
        hint.innerHTML= "";
        document.getElementById('inputHint').value = "";
    },3000);
  }