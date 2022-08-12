<?php
session_start();
include 'header.html';
include_once 'connection-info.php';

$username = "";
$password = "";
$msg = "";
$_SESSION['true']='true';

if(isset($_POST['login']))
{
    //grab these two values to prefill data in form if user left one blank
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Verify both fields have data
    if($username != "" && $password != ""){
        //check if password and username match
        if(userExistsPwd($username, $password, $conn)){
            header("Location: hangman-game.php");
            $_SESSION  = $_POST;
        }
        else{
            $msg = "That combination of username and password doesn't exist";
        }
    }
    else    
        $msg = "All fields are required";

}
function userExistsPwd($username, $password, $conn){
    $sql = "SELECT pwd FROM user WHERE username='$username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(isset($row['pwd']) && password_verify($password, $row['pwd']))
        {
            return true;
        } 
    }
    return false;
}
?>

    <body>
    <div class="container mt-4"> 
        <div class="row"> 
            <div class="col"></div>
            <div class="col bg-light p-4 shadow border border-success rounded">
                <div>
                    <h1>Login to Your Account</h1>
                </div>

                <form action="" method="post" class="form-horizontal mt-4">
                    Username: <input type="text" class="form-control" name="username" 
                    <?php 
                    if($username != ""){
                        echo "value='$username'";
                    }
                    ?>>
                    Password: <input type="password" class="form-control" name="password" 
                    <?php 
                    if($password != ""){
                        echo "value='$password'";
                    }         
                    ?>>
                    <div class="form-group">
                        <button type="submit" name ="login" class="btn btn-primary btn-lg mt-3">Log In</button>
                    </div>
                </form>
                
                <div class="alert alert-danger mt-4" <?php if($msg == "") echo "hidden"?>>
                    <?php echo "$msg";?>
                </div>
                            
                <div class="bottom-text mt-3">Don't have an account? <a href="signup.php">Sign up</a></div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    </body>
</html> 

