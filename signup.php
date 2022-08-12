<?php
session_start();
include_once 'header.html';
include_once 'connection-info.php';

$username = "";
$password = "";
$password2 ="";
$msg = "";

if(isset($_POST['signup'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    if($username == "" || $password == "" || $password2 == "")
    {
        $msg = "All fields required";
    }
    else{
        if(passwordsMatch($password, $password2)){
            if(createNewUser($username, $password, $conn)){
                header("Location: hangman-game.php");
                $_SESSION = $_POST;
                $_SESSION['login'] ='login';
            }
            else{
                $msg = "Username is alreay taken";
            }
        }
        else{
            $msg="Your passwords don't match";
            $password = "";
            $password2 ="";
        }
    } 
}
function passwordsMatch($pwd, $pwd2){
    if($pwd === $pwd2) return true;
    else return false;
}
function createNewUser($username, $password, $conn){
    $sql = "SELECT * FROM user WHERE username='$username'";
    //check database to verify if username already is taken if it is return false
    $results = $conn->query($sql);
    if($results->num_rows != 0){
        $results->free_result();
        $conn->close();
        return false;
    }

    //salt is auto gernerated if you don't supply it with password_hash()
    $pwd = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (username, pwd)
    VALUES ('$username', '$pwd')";
    $conn->query($sql);



    return true;
}
?>



<body>
<div class="container mt-4"> 
       
    <div class="row"> 
        <div class="col"></div>
        <div class="col bg-light p-4 shadow border border-success rounded">  
            <div>
                <h1>Sign up for an Account</h1>
            </div>

            <form action="" method="post" >
                Username: <input type="text" class="form-control" name="username" 
                <?php 
                if($username != ""){
                    echo "value='$username'";
                }?>>
                Password: <input type="password" class="form-control" name="password" 
                <?php 
                if($password != ""){
                    echo "value='$password'";
                }?>>
                Confirm password: <input type="password" class="form-control" name="password2" 
                <?php 
                if($password != ""){
                    echo "value='$password2'";
                }?>>
                <div class="form-group">
                    <button type="submit" name ="signup" class="btn btn-primary btn-lg mt-3">Sign up</button>
                </div>
            </form>
            <div class="alert alert-danger mt-4" <?php if($msg == "") echo "hidden"?>>
                <?php echo "$msg";?>
            </div>
        	<div class="bottom-text mt-3">Already have an account? <a href="login.php">Login</a></div>
        </div>
        <div class="col"></div>
    </div>
</div>
</body>
</html> 