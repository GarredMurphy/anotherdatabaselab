
<!DOCTYPE html>
<?php


session_start();
function loginProcess() {
    if (isset($_POST['loginForm'])) 
     {
         
     
    
    include 'database.php';
    $dbConn = getDatabaseConnection();
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
  //  $password = $_POST['password'];
    
    $sql = "SELECT * from heroku_e746fa7e355c8e7.admin WHERE userName = :username AND password = :password";
//    $sql = "SELECT * from heroku_e746fa7e355c8e7.admin WHERE 1";
    $named_parameters = array();
    $named_parameters[':username'] = $username;
    $named_parameters[':password'] = $password;
    $statement = $dbConn->prepare($sql);
    
    
    
    $statement->execute($named_parameters);
    
        $record = $statement->fetch();
    //    $record = $statement->fetchALL();
        if (empty($record)) {
            echo "Wrong username or password <br /> ";
            //print_r($record);
        }
        else
        {
            //echo "userName and password correct";
            $_SESSION['username'] = $record['userName'];
            $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
            //print_r($record);
            header("Location: admin.php");
        }
     }    
}
    
?>
<html>
    <link href="css/styles.css" rel ="stylesheet" type="text/css" />
    <title> Admin Login </title>
    <body>
        <h1> Admin Login </h1>
        <form method="post">
            Username: <input type="text" name = "username"/>
            
            <br />
            
            Password: <input type="password" name = "password"/>
            
            <br />
            <input type="submit" name="loginForm" value ="Login!">
        
        </form>
        <?=loginProcess()?>
    </body>
</html>