var canvas = document.getElementById("canvas");
context = canvas.getContext("2d"); 

function draw(num) {
   
    if(num == 0){
        //base
        context.clearRect(0, 0, window.innerWidth, window.innerHeight);
        context.rect(0, 190, 100, 10);
        context.fill();
    }
    if(num == 1){
        //pole
        context.rect(50,0,10,200);
        context.fill();
    }
    if(num == 2){
        //top of pole
        context.rect(50,0,50,10);
        context.fill();
    }
    if(num == 3){
        //down part of pole
        context.rect(95,0,10,20);
        context.fill();
    }
    if(num == 4){
    //head
        context.strokeStyle = 'blue';
        context.beginPath();
        context.lineWidth = 3;
        context.arc(100, 40, 15, 0, Math.PI * 2, true);
        context.stroke(); 
    }
    if(num == 5){
        //mouth and eyes
        context.beginPath();
        context.lineWidth = 1;
        context.arc(95, 37.5, 2.5, 0, Math.PI * 2, true);
        context.stroke();
        context.beginPath();
        context.arc(105, 37.5, 2.5, 0, Math.PI * 2, true);
        context.stroke() 
        context.beginPath();
        context.arc(100, 47.5, 4, 0, Math.PI, true);
        context.stroke(); 
    }
    if(num == 6){
        //body
        context.lineWidth = 3;
        context.beginPath();
        context.moveTo(100, 55);
        context.lineTo(100, 90);
        context.stroke();
    }
    if(num == 7){
        //arm
        context.beginPath();
        //left up
        context.moveTo(100, 70);
        context.lineTo(75, 65);
    }
    if(num == 8){
    // arm right up
    context.moveTo(100, 70);
    context.lineTo(125, 65);
    }
    context.stroke();
    //left leg
    if(num == 9){
        context.beginPath();
        context.moveTo(100, 90);
        context.lineTo(75, 140);
    }
    //rigth leg
    if(num == 10){
        context.moveTo(100, 90);
        context.lineTo(125, 140);
    }
    //shift everything down and add rope
    context.stroke();
    if(num == 11){
       //rope
       context.clearRect(0, 0, window.innerWidth, window.innerHeight);
       context.strokeStyle='black';
       context.clearRect(0, 0, window.innerWidth, window.innerHeight);
       context.rect(0, 190, 100, 10);
       context.fill();
       //pole
       context.rect(50,0,10,200);
       context.fill();
       //top of pole
       context.rect(50,0,50,10);
       context.fill();
       context.lineWidth = 1.5;
       context.beginPath();
       context.moveTo(100, 0);
       context.lineTo(100, 50);
       context.stroke();
       //down part of pole
       context.rect(95,0,10,20);
       context.fill();
       //head
       context.beginPath();
       context.arc(100, 60, 15, 0, Math.PI * 2, true);
       context.fill(); 
       //body
       context.lineWidth = 3;
       context.beginPath();
       context.moveTo(100, 75);
       context.lineTo(100, 110);
       context.stroke();
 
       //arm
       context.beginPath();
       //left down
       context.moveTo(100, 90);
       context.lineTo(75, 100);
  
       // arm down
       context.moveTo(100, 90);
       context.lineTo(125, 65);

       context.stroke();
       //left leg
  
       context.beginPath();
       context.moveTo(100, 90);
       context.lineTo(95, 140);
         
       //rigth leg
  
       context.moveTo(100, 90);
       context.lineTo(105, 140);
       context.stroke();
       document.getElementById('gOver').innerHTML = "GAME OVER!"
    }
   
}